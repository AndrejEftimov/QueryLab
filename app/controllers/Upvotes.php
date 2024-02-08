<?php

class Upvotes
{
	use Controller;

	public function index()
	{
	}

	public function increment()
	{
		if (empty($_SESSION['USER'])) {
			redirect('login');
		}

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$user_id = $_POST['user_id'];

			// post upvoting
			if (isset($_POST['post_id']) and !empty($_POST['post_id'])) {
				$post_id = $_POST['post_id'];
				$u = new User;
				$p = new Post;
				$upvote = new PostUpvote;

				$upvote->insert($_POST);

				$user = $u->first(array('id' => $user_id));
				$credits = $user->credits + 1;
				$u->update($user_id, array('credits' => $credits));

				$post = $p->first(array('id' => $post_id));
				$upvote_count = $post->upvote_count + 1;
				$p->update($post_id, array('upvote_count' => $upvote_count));

				echo ($upvote_count);
			}

			// reply upvoting
			else if (isset($_POST['reply_id']) and !empty($_POST['reply_id'])) {
				$reply_id = $_POST['reply_id'];
				$u = new User;
				$r = new Reply;
				$upvote = new ReplyUpvote;

				$upvote->insert($_POST);

				$user = $u->first(array('id' => $user_id));
				$credits = $user->credits + 1;
				$u->update($user_id, array('credits' => $credits));

				$reply = $r->first(array('id' => $reply_id));
				$upvote_count = $reply->upvote_count + 1;
				$r->update($reply_id, array('upvote_count' => $upvote_count));

				echo ($upvote_count);
			}
		}
	}

	public function decrement()
	{
		if (empty($_SESSION['USER'])) {
			redirect('login');
		}

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$user_id = $_POST['user_id'];

			// post downvoting
			if (isset($_POST['post_id']) and !empty($_POST['post_id'])) {
				$post_id = $_POST['post_id'];
				$u = new User;
				$p = new Post;
				$upvote = new PostUpvote;

				$upvote->delete($_SESSION['USER']->id, $post_id);

				$user = $u->first(array('id' => $user_id));
				$credits = $user->credits - 1;
				$u->update($user_id, array('credits' => $credits));

				$post = $p->first(array('id' => $post_id));
				$upvote_count = $post->upvote_count - 1;
				$p->update($post_id, array('upvote_count' => $upvote_count));

				echo ($upvote_count);
			}

			// reply downvoting
			else if (isset($_POST['reply_id']) and !empty($_POST['reply_id'])) {
				$reply_id = $_POST['reply_id'];
				$u = new User;
				$r = new Reply;
				$upvote = new ReplyUpvote;

				$upvote->delete($_SESSION['USER']->id, $reply_id);

				$user = $u->first(array('id' => $user_id));
				$credits = $user->credits - 1;
				$u->update($user_id, array('credits' => $credits));

				$reply = $r->first(array('id' => $reply_id));
				$upvote_count = $reply->upvote_count - 1;
				$r->update($reply_id, array('upvote_count' => $upvote_count));

				echo ($upvote_count);
			}
		}
	}

}
