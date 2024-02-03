<?php 

/**
 * signup class
 */
class Signup
{
	use Controller;

	public function index()
	{
		$data = [];
		
		if($_SERVER['REQUEST_METHOD'] == "POST")
		{
			$user = new User;
			if($user->validate_signup($_POST))
			{
				if($user->create_user($_POST)){
					redirect('login');
				}
			}

			$data['errors'] = $user->errors;			
		}


		$this->view('signup',$data);
	}

}