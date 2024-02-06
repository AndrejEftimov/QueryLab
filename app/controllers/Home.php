<?php

/**
 * home class
 */
class Home
{
	use Controller;

	public function index()
	{
		if (empty($_SESSION['USER'])) {
			redirect('login');
		}

		$data = [];
		$data['rows'] = [];

		$t = new Tag;
		$data['tags'] = $t->findAll();
		$data['selected_tags'] = [];

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$post = new Post;
			$tags = $t->get_tag_ids($_POST['tags']);
			$posts = $post->get_posts_for_tags($tags);
			
			$rows = [];
			foreach ($posts as $p) {
				$tags = $post->get_tags($p->id);
				array_push($rows, array($p, $tags));
			}

			$data['rows'] = $rows;

			$data['selected_tags'] = $_POST['tags'];
		}

		$this->view('home', $data);
	}

}
