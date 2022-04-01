<?php

namespace controller;

use controller\controller;




class commentController extends controller{
    protected $modelName = "comment";

    public function showEditCommentsAdmin(){
        $allComments = $this->model->getAllComments();
        $title = "Tableau de bord";
        \Renderer::render('backend/edit_comment_admin',compact("title","allComments"));
    }

    public function postComment($commentInfo){
        $this->model->postComment($commentInfo);
        return "all is okay";
    }

    public function getComment(){
        $idComment = filter_input(INPUT_POST,"idComment",FILTER_VALIDATE_INT);
        echo json_encode( $this->model->getComment($idComment));
    }    

    public function updateComment(){
        $idComment = filter_input(INPUT_POST,"idComment",FILTER_VALIDATE_INT);
        $status = filter_input(INPUT_POST,"status",FILTER_VALIDATE_INT);
        echo json_encode( $this->model->updateComment($idComment,$status));
    }

    public function deleteComment(){
        $idComment = filter_input(INPUT_POST,"idComment",FILTER_VALIDATE_INT);
        echo json_encode( $this->model->deleteComment($idComment));
    }
}