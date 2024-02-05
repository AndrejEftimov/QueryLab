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

		if(empty($posts)){
			$posts = [];
		}

		$rows = [];
		foreach($posts as $p){
			$tags = $post->get_tags($p->id);
			array_push($rows, array($p, $tags));
		}

		$data['rows'] = $rows;

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
				$tags = $_POST['tags'];
				unset($_POST['tags']);
				$row = $post->first($_POST);
				$post_id = $row->id;

				$pt = new PostTag;
				foreach($tags as $tag_name){
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

}
