<?php 

class Queries
{
	use Controller;

    public function index()
	{
		if(empty($_SESSION['USER'])){
			redirect('login');
		}

		$data = [];

		$user_id = $_SESSION['USER']->id;
		$post = new Post;
		$posts = $post->where(array('user_id' => $user_id));
		$data['posts'] = $posts;

		$this->view('queries', $data);
	}

    public function add()
	{
		if(empty($_SESSION['USER'])){
			redirect('login');
		}

		$data = [];

		if($_SERVER['REQUEST_METHOD'] == "POST")
		{
			$post = new Post;
			if($post->insert_post($_POST))
			{
				redirect('queries');
			}

			$data['errors'] = $post->errors;
		}


		$this->view('add_query', $data);
	}

}
