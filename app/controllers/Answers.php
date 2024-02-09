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

		$data['post_data'] = [];
		$data['replies_data'] = [];

		// get post and tags for post
		$p = new Post;
		$post = $p->get_post($post_id);
		$tags = $p->get_tags($post_id);

		// check if post is upvoted by user
		$up = new PostUpvote;
		$upvote = $up->first(array('user_id' => $_SESSION['USER']->id, 'post_id' => $post_id));
		$upvote = empty($upvote) ? false : true; // double check

		$data['post_data'] = array($post, $tags, $upvote);

		// get replies for post and check if each reply has an upvote from the user
		$r = new Reply;
		$replies = $r->get_replies_for_post($post_id);
		if (!empty($replies)) {
			$up = new ReplyUpvote;
			foreach ($replies as $reply) {
				$upvote = $up->first(array('user_id' => $_SESSION['USER']->id, 'reply_id' => $reply->id));
				$upvote = empty($upvote) ? false : true; // double check

				array_push($data['replies_data'], array($reply, $upvote));
			}
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

		if ($user_id != $_SESSION['USER']->id) {
			redirect('404'); // should be ACCESS DENIED
		}

		$data = [];

		$rows = [];
		$r = new Reply;
		$replies = $r->get_replies_for_user($user_id);
		if (!empty($replies)) {
			$up = new ReplyUpvote;
			foreach ($replies as $reply) {
				$upvote = $up->first(array('user_id' => $_SESSION['USER']->id, 'reply_id' => $reply->id));
				$upvote = empty($upvote) ? false : true; // double check

				array_push($rows, array($reply, $upvote));
			}
		}

		$data['rows'] = $rows;

		$this->view('replies_all', $data);
	}
}
