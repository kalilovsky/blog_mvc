<?php
namespace controller;


class usersController extends controller{

    protected $modelName = "users";
    public function showEditUsersAdmin(){
        $users = $this->model->getAllUsers();
        $title = "Tableau de bord";
        \Renderer::render("backend/edit_users_admin", compact("users","title"));
    }
    public function login(){
        $this->model->loginUser($_GET);
        \Http::redirect("index.php");
    }
    public function register(){
        $this->model->registerUser($_POST);
        \Http::redirect("?controller=articlecontroller&action=showRegisterPage");
    }

    public function updateUser(){
        // https://espritweb.fr/comment-uploader-une-image-en-php/
        $file = $_FILES;
        $userInfo = $_POST;
        if ($file["file"]["error"] == 0) {
            $tmpName = $file["file"]['tmp_name'];
            $name = $file["file"]['name'];
            move_uploaded_file($tmpName,
                'ressource/img/account/' . $name
            );
            $this->model->updatePhoto($userInfo,$name);
        }
        if (!$userInfo["pwd"] == "") {
            $this->model->updatePwd($userInfo);
        }
        
        echo json_encode($this->model->updateUser($userInfo));
    }

    public function deleteUser(){
        $idUser = filter_input(INPUT_POST,"idusers", FILTER_VALIDATE_INT);
        $this->model->deleteUser($idUser);
        echo json_encode($idUser);
    } 

    public function getUser(){
        $idUser = filter_input(INPUT_POST,"idUsers",FILTER_VALIDATE_INT	);
        echo(json_encode($this->model->getUser($idUser)));
    }

}