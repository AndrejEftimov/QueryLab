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
		'credits',
		'type'
	];

	public function create_user($data)
	{
		if ($this->where(array('username' => $data['username']))) {
			$this->errors['username'] = "Username already exists!";
			return false;
		}

		if ($this->where(array('email' => $data['email']))) {
			$this->errors['email'] = "Account with that Email already exists!";
			return false;
		}

		$data['description'] = "";
		$data['profile_image'] = "_default_profile_picture.png";
		$data['credits'] = 0;
		$data['type'] = 'user';

		$this->insert($data);
		return true;
	}

	public function update($id, $data, $id_column = 'id')
	{
		if (isset($data['username'])) {
			$query = "SELECT * FROM user WHERE username = '{$data['username']}' AND id != '$id'";
			$result = $this->query($query);
			if (!empty($result)) {
				return false;
			}
		}

		/** remove unwanted data **/
		if (!empty($this->allowedColumns)) {
			foreach ($data as $key => $value) {

				if (!in_array($key, $this->allowedColumns)) {
					unset($data[$key]);
				}
			}
		}

		$keys = array_keys($data);
		$query = "update $this->table set ";

		foreach ($keys as $key) {
			$query .= $key . " = :" . $key . ", ";
		}

		$query = trim($query, ", ");

		$query .= " where $id_column = :$id_column ";

		$data[$id_column] = $id;

		$this->query($query, $data);

		return true;

	}

	public function validate_signup($data)
	{
		$this->errors = [];

		if (empty($data['email'])) {
			$this->errors['email'] = "Email is required";
		} else
			if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
				$this->errors['email'] = "Email is not valid";
			}

		if (empty($data['username'])) {
			$this->errors['username'] = "Username is required";
		}

		if (empty($data['password'])) {
			$this->errors['password'] = "Password is required";
		}

		if (empty($this->errors)) {
			return true;
		}

		return false;
	}

	public function validate_login($data)
	{
		$this->errors = [];

		if (empty($data['username'])) {
			$this->errors['username'] = "Username is required";
		}

		if (empty($data['password'])) {
			$this->errors['password'] = "Password is required";
		}

		if (empty($this->errors)) {
			return true;
		}

		return false;
	}
}