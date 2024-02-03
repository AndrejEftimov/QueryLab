<?php 

if($_SERVER['SERVER_NAME'] == 'localhost')
{
	/** database config **/
	define('DBNAME', 'QueryLabDB');
	define('DBHOST', 'localhost');
	define('DBUSER', 'root');
	define('DBPASS', '');
	define('DBDRIVER', '');
	
	define('ROOT', 'http://localhost/QueryLab/public');

}else
{
	/** database config **/
	define('DBNAME', 'QueryLabDB');
	define('DBHOST', 'localhost');
	define('DBUSER', 'root');
	define('DBPASS', '');
	define('DBDRIVER', '');

	define('ROOT', 'https://www.QueryLab.com');

}

define('APP_NAME', "Query Lab");
define('APP_DESC', "App description");

$tags = array('Music', 'Gaming', 'Computers', 'Software', 
'Hardware', 'Computer Science', 'Art', 'Movies', 'Sport', 'Cuisine', 
'Architecture', 'Medicine', 'Economy', 'Law', 'Psychology', 'Books', 
'Programming', 'Engineering', 'Physics', 'Mathematics', 'Electronics', 
'Travel', 'Nature', 'Meditation', 'Coffee', 'Journalism', 'Anime', 
'University', 'Studying', 'Cooking');

sort($tags);
define('TAGS', $tags);

/** true means show errors **/
define('DEBUG', true);
