<?php

class Queries
{
	use Controller;

	public function index()
	{
		if (empty($_SESSION['USER'])) {
			redirect('login');
		}

		$data = [];

		$user_id = $_SESSION['USER']->id;
		$post = new Post;
		$posts = $post->where(array('user_id' => $user_id));

		if (empty($posts)) {
			$posts = [];
		}

		$up = new PostUpvote;
		$rows = [];
		foreach ($posts as $p) {
			$tags = $post->get_tags($p->id);
			$upvoted = $up->first(array('user_id' => $_SESSION['USER']->id, 'post_id' => $p->id));
			if ($upvoted != false) {
				$upvoted = true;
			}
			array_push($rows, array($p, $tags, $upvoted));
		}

		$data['rows'] = $rows;

		$this->view('queries', $data);
	}

	public function add()
	{
		if (empty($_SESSION['USER'])) {
			redirect('login');
		}

		$data = [];

		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			$post = new Post;
			$data = $_POST;
			$data['image'] = $this->upload_file($_FILES['fileToUpload']);
			if ($post->insert_post($data)) {
				$tags = $data['tags'];
				unset($data['tags']);
				$row = $post->first($data);
				$post_id = $row->id;

				$pt = new PostTag;
				foreach ($tags as $tag_name) {
					$pt->insert_post_tag($post_id, $tag_name);
				}

				redirect('queries');
			}

			$data['errors'] = $post->errors;
		}

		$t = new Tag;
		$data['tags'] = $t->findAll();

		$this->view('add_query', $data);
	}

	private function upload_file($fileToUpload)
	{
		if (empty($fileToUpload['name'])) {
			return "";
		}
		$target_dir = $_SERVER['DOCUMENT_ROOT'] . "/QueryLab/public/assets/images/";
		$target_file = $target_dir . basename($fileToUpload["name"]);
		$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
		$uploadOk = 1;

		// Check if image file is a actual image or fake image
		$check = getimagesize($fileToUpload["tmp_name"]);
		if ($check !== false) {
			//echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
		} else {
			//echo "File is not an image.";
			$uploadOk = 0;
		}

		// Check if file already exists
		if (file_exists($target_file)) {
			//echo "Sorry, file already exists.";
			return $fileToUpload['name'];
			$uploadOk = 0;
		}

		// Check file size
		//if ($fileToUpload["size"] > 500000) {
		//echo "Sorry, your file is too large.";
		//$uploadOk = 0;
		//}

		// Allow certain file formats
		$allowedfileExtensions = array('jpg', 'png', 'jpeg', 'gif');
		if (!in_array($imageFileType, $allowedfileExtensions)) {
			//echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$uploadOk = 0;
		}

		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			//echo "Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($fileToUpload["tmp_name"], $target_file)) {
				//echo "The file " . htmlspecialchars(basename($fileToUpload["name"])) . " has been uploaded.";
				return $fileToUpload['name'];
			} else {
				//echo "Sorry, there was an error uploading your file.";
			}
		}

		return "";
	}

}
