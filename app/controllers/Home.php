<?php 

/**
 * home class
 */
class Home
{
	use Controller;

	public function index()
	{
		if(empty($_SESSION['USER'])){
			redirect('login');
		}

		$data = [];

		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$post = new Post;

			$posts = $post->get_posts($_POST['tags']);
			$data['posts'] = $posts;
		}

		$this->view('home',$data);
	}

}
