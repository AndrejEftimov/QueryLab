<?php

class Answers
{
	use Controller;

	public function index($post_id = 0)
	{
		if (empty($_SESSION['USER'])) {
			redirect('login');
		}

		$data = [];

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			if ($_POST['user_id'] == $_SESSION['USER']->id) {
				$r = new Reply;
				$data = $_POST;
				$data['upvote_count'] = 0;

				$r->insert($data);
				$post_id = $_POST['post_id'];
			}
		}

		if (empty($post_id)) {
			redirect('404');
		}

		$p = new Post;
		$data['post'] = $p->get_post($post_id);

		$data['tags'] = $p->get_tags($post_id);

		$r = new Reply;
		$data['replies'] = $r->get_replies_for_post($post_id);
		if (empty($data['replies'])) {
			$data['replies'] = [];
		}

		$this->view('replies', $data);
	}

	public function all($user_id = 0)
	{
		if (empty($_SESSION['USER'])) {
			redirect('login');
		}

		if (empty($user_id)) {
			redirect('404');
		}

		if($user_id != $_SESSION['USER']->id){
			redirect('404'); // should be ACCESS DENIED
		}

		$data = [];

		$r = new Reply;
		$data['replies'] = $r->get_replies_for_user($user_id);
		if (empty($data['replies'])) {
			$data['replies'] = [];
		}

		$this->view('replies_all', $data);
	}
}
