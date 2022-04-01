<?php
namespace controller;
use model\message;




class messageController extends controller{

    protected $modelName = "message";

    public function sendMessage(){
        $email = filter_input(INPUT_GET,"email",FILTER_VALIDATE_EMAIL);
        $message = filter_input(INPUT_GET,"message",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        message::sendMessage($email,$message);
        \Http::redirect("index.php?controller=articlecontroller&action=showContactPage");
    }

    public function showEditMessagesAdmin(){
        $allMessages = $this->model->getAllMessages();
        $title = "Tableau de bord";
        \Renderer::render("backend/edit_messages_admin", compact("title", "allMessages"));
    }

    public function getMessage(){
        $idMessage = filter_input(INPUT_POST,"idMessage",FILTER_VALIDATE_INT);
        $status = filter_input(INPUT_POST,"statusMessage",FILTER_VALIDATE_INT);
        echo json_encode($this->model->getMessage($idMessage,$status));
    }
}
