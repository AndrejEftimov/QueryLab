<?php

function show($stuff)
{
	echo "<pre>";
	print_r($stuff);
	echo "</pre>";
}

function esc($str)
{
	return htmlspecialchars($str);
}

function redirect($path)
{
	header("Location: " . ROOT . "/" . $path);
	die;
}

// decides if page is active
function active($current_page)
{
	$url_array = explode('/', $_SERVER['REQUEST_URI']);
	$url1 = lcfirst(end($url_array));
	$url2 = lcfirst(prev($url_array));
	if ($current_page == $url1 or $current_page == $url2) {
		echo 'active'; //class name in css 
	}
}

function create_database()
{
	$string = "mysql:hostname=" . DBHOST;

	$pdo = new PDO($string, DBUSER, DBPASS);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$dbname = "`" . str_replace("`", "``", DBNAME) . "`";
	$pdo->query("CREATE DATABASE IF NOT EXISTS $dbname");
	$pdo->query("CREATE TABLE IF NOT EXISTS `querylabdb`.`user` (
			`id` INT NOT NULL AUTO_INCREMENT , 
			`email` VARCHAR(100) NOT NULL , 
			`password` VARCHAR(100) NOT NULL , 
			`username` VARCHAR(50) NOT NULL , 
			`description` VARCHAR(256) NOT NULL , 
			`profile_image` VARCHAR(100) NOT NULL , 
			`date_joined` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , 
			`credits` INT NOT NULL , 
			`type` VARCHAR(20) NOT NULL , 
			PRIMARY KEY (`id`)) 
			ENGINE = InnoDB;");

	$pdo->query("CREATE TABLE IF NOT EXISTS `querylabdb`.`post` (
			`id` INT NOT NULL AUTO_INCREMENT , 
			`title` VARCHAR(100) NOT NULL , 
			`text` TEXT NOT NULL , 
			`image` VARCHAR(100) NOT NULL , 
			`date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , 
			`upvote_count` INT NOT NULL , 
			`reply_count` INT NOT NULL , 
			`tags` VARCHAR(100) NOT NULL , 
			`user_id` INT NOT NULL , 
			PRIMARY KEY (`id`),
			FOREIGN KEY (`user_id`) REFERENCES `user`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT) 
			ENGINE = InnoDB;");

	$pdo->query("CREATE TABLE IF NOT EXISTS `querylabdb`.`reply` (
			`id` INT NOT NULL AUTO_INCREMENT , 
			`text` TEXT NOT NULL , 
			`date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , 
			`upvote_count` INT NOT NULL , 
			`post_id` INT NOT NULL , 
			`user_id` INT NOT NULL , 
			PRIMARY KEY (`id`),
			FOREIGN KEY (`post_id`) REFERENCES `post`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
			FOREIGN KEY (`user_id`) REFERENCES `user`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT) 
			ENGINE = InnoDB;");

	$pdo->query("CREATE TABLE IF NOT EXISTS `querylabdb`.`upvote` (
			`id` INT NOT NULL AUTO_INCREMENT , 
			`user_id` INT NOT NULL , 
			`post_id` INT NOT NULL , 
			`reply_id` INT NOT NULL ,
			PRIMARY KEY (`id`),
			FOREIGN KEY (`user_id`) REFERENCES `user`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
			FOREIGN KEY (`post_id`) REFERENCES `post`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
			FOREIGN KEY (`reply_id`) REFERENCES `reply`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT) 
			ENGINE = InnoDB;");

	$pdo->query("CREATE TABLE IF NOT EXISTS `querylabdb`.`tag` (
			`id` INT NOT NULL AUTO_INCREMENT , 
			`name` VARCHAR(50) NOT NULL,
			PRIMARY KEY (`id`)) 
			ENGINE = InnoDB;");

	$pdo->query("CREATE TABLE IF NOT EXISTS `querylabdb`.`post_tag` (
			`post_id` INT NOT NULL , 
			`tag_id` INT NOT NULL , 
			PRIMARY KEY (`post_id`, `tag_id`),
			FOREIGN KEY (`post_id`) REFERENCES `post`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
			FOREIGN KEY (`tag_id`) REFERENCES `tag`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT) 
			ENGINE = InnoDB;");

	//add admin user (if not exists)
	$string = "mysql:hostname=" . DBHOST . ";dbname=" . DBNAME;
	$pdo = new PDO($string, DBUSER, DBPASS);

	$statement = $pdo->query("SELECT * FROM user WHERE username = 'Admin'");
	$rows = $statement->fetchAll(PDO::FETCH_OBJ);
	if (count($rows) == 0) {
		$pdo->query("INSERT INTO user (email, password, username, description, profile_image, credits, type) " .
			"values ('admin@querylab.com', 'admin123', 'Admin', '', '_default_profile_picture.png', 0, 'admin');");
	}

	//add tags in tag table (but first check if they exist)
	$statement = $pdo->query("SELECT name FROM tag");
	$rows = $statement->fetchAll(PDO::FETCH_ASSOC);

	foreach (TAGS as $tag) {
		$exists = false;
		foreach ($rows as $row) {
			foreach ($row as $key => $value) {
				if ($tag == $value) {
					$exists = true;
					break;
				}
			}
			if ($exists == true) {
				break;
			}
		}

		if ($exists == false) {
			$pdo->query("INSERT INTO tag (name) values ('$tag');");
		}
	}
}