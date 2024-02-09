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
		$rows = [];

		$t = new Tag;
		$data['tags'] = $t->findAll();
		$data['selected_tags'] = [];

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$post = new Post;
			$tags = $t->get_tag_ids($_POST['tags']);
			$posts = $post->get_posts_for_tags($tags);

			if (!empty($posts)) {
				$up = new PostUpvote;
				foreach ($posts as $p) {
					$tags = $post->get_tags($p->id);
					$upvoted = $up->first(array('user_id' => $_SESSION['USER']->id, 'post_id' => $p->id));
					if ($upvoted != false) {
						$upvoted = true;
					}
					array_push($rows, array($p, $tags, $upvoted));
				}
			}

			$data['rows'] = $rows;
			$data['selected_tags'] = $_POST['tags'];
		}

		$this->view('home', $data);
	}

}
