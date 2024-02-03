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

		$this->view('home',$data);
	}

}
