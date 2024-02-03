<?php 


/**
 * User class
 */
class User
{
	
	use Model;

	protected $table = 'user';

	protected $allowedColumns = [

		'email',
		'password',
		'username',
		'description',
		'profile_image',
		'date_joined',
		'credits'
	];

	public function create_user($data){
		if($this->where(array('username' => $data['username']))){
			$this->errors['username'] = "Username already exists!";
			return false;
		}

		if($this->where(array('email' => $data['email']))){
			$this->errors['email'] = "Account with that Email already exists!";
			return false;
		}

		$data['description'] = "";
		$data['profile_image'] = "_default_profile_picture.png";
		$data['credits'] = 0;

		$this->insert($data);
		return true;
	}

	public function validate_signup($data)
	{
		$this->errors = [];

		if(empty($data['email']))
		{
			$this->errors['email'] = "Email is required";
		}else
		if(!filter_var($data['email'],FILTER_VALIDATE_EMAIL))
		{
			$this->errors['email'] = "Email is not valid";
		}

		if(empty($data['username']))
		{
			$this->errors['username'] = "Username is required";
		}
		
		if(empty($data['password']))
		{
			$this->errors['password'] = "Password is required";
		}

		if(empty($this->errors))
		{
			return true;
		}

		return false;
	}

	public function validate_login($data)
	{
		$this->errors = [];

		if(empty($data['username']))
		{
			$this->errors['username'] = "Username is required";
		}
		
		if(empty($data['password']))
		{
			$this->errors['password'] = "Password is required";
		}

		if(empty($this->errors))
		{
			return true;
		}

		return false;
	}
}