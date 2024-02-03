<?php 

class Admin
{
	use Controller;

	public function index()
	{
		if(empty($_SESSION['USER'])){
			redirect('login');
		}

		$data = [];

		$this->view('admin', $data);
	}

}
