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

            if (isset($_FILES['fileToUpload']) and !empty($_FILES['fileToUpload']['name'])) {
                $arr['profile_image'] = $this->upload_file($_FILES['fileToUpload']);
            }

            if ($u->update($user_id, $arr) == true) {
                $_SESSION['USER'] = $u->first(array('id' => $user_id));
                redirect("profile/index/$user_id");
            }

            $data['errors'] = $u->errors;
        }

        $u = new User;
        $user = $u->first(array('id' => $user_id));
        $data['user'] = $user;

        $this->view('edit_profile', $data);
    }

    private function upload_file($fileToUpload)
    {
        if (empty($fileToUpload['name'])) {
            return "";
        }
        $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/QueryLab/public/assets/images/";
        $target_file = $target_dir . basename($fileToUpload["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $uploadOk = 1;

        // Check if image file is a actual image or fake image
        $check = getimagesize($fileToUpload["tmp_name"]);
        if ($check !== false) {
            //echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            //echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            //echo "Sorry, file already exists.";
            return $fileToUpload['name'];
            $uploadOk = 0;
        }

        // Check file size
        //if ($fileToUpload["size"] > 500000) {
        //echo "Sorry, your file is too large.";
        //$uploadOk = 0;
        //}

        // Allow certain file formats
        $allowedfileExtensions = array('jpg', 'png', 'jpeg', 'gif');
        if (!in_array($imageFileType, $allowedfileExtensions)) {
            //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            //echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($fileToUpload["tmp_name"], $target_file)) {
                //echo "The file " . htmlspecialchars(basename($fileToUpload["name"])) . " has been uploaded.";
                return $fileToUpload['name'];
            } else {
                //echo "Sorry, there was an error uploading your file.";
            }
        }

        return "";
    }

}
