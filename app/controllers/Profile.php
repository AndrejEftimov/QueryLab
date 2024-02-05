<?php

class Profile
{
    use Controller;

    public function index($user_id)
    {
        if (empty($_SESSION['USER'])) {
            redirect('login');
        }

        $data = [];

        $user_id = (int) $user_id;
        $u = new User;
        $user = $u->first(array('id' => $user_id));
        $data['user'] = $user;

        $this->view('profile', $data);
    }

    public function edit($user_id)
    {
        if (empty($_SESSION['USER'])) {
            redirect('login');
        }

        $user_id = (int) $user_id;

        if ($user_id != $_SESSION['USER']->id) {
            redirect('404'); // should be ACCESS DENIED
        }

        $data = [];

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $u = new User;
            $username = $_POST['username'];
            $description = $_POST['description'];
            if (empty($description)) {
                $description = "";
            }

            $arr = array('username' => $username, 'description' => $description);
            if($u->update($user_id, $arr) == true){
                redirect("profile/index/$user_id");
            }

            $data['errors'] = $u->errors;
        }

        $u = new User;
        $user = $u->first(array('id' => $user_id));
        $data['user'] = $user;

        $this->view('edit_profile', $data);
    }

}
