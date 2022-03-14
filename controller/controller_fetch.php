<?php
require_once("../model/user.php");
require_once("../model/article.php");
require_once("../model/comment.php");
require_once("../model/message.php");

if (isset($_POST["submitAction"])) {
    switch ($_POST["submitAction"]) {
        case "commentSubmit":
            echo(postComment($_POST));
            break;
        case "getArticle": 
            echo(json_encode(getArticleById($_POST["idArticle"])));
            break;
        case "getComment":
            echo(json_encode(getComment($_POST["idComment"])));
            break;
        case "getMessage":
            echo(json_encode(getMessage($_POST["idMessage"],$_POST["statusMessage"])));
            break;
        case "getUser":
            echo(json_encode(getUser($_POST["idUsers"])));
            break;
        case "updateComment":
            echo(json_encode(updateComment($_POST["idComment"],$_POST["status"])));
            break;
        case "deleteComment":
            echo(json_encode(deleteComment($_POST["idComment"])));
            break;
        case "updateUser":
            echo(json_encode(updateUser($_POST,$_FILES)));
        case "deleteUser":
            echo(json_encode(deleteUser($_POST["idusers"])));
        case "updateArticle":
            echo(json_encode(updateArticle($_POST,$_FILES)));
        case "deleteArticle":
            echo(json_encode(deleteArticle($_POST["idArticle"])));

    }
}


function postComment($commentInfo){
    $comments = new comment();
    $comments->postComment($commentInfo);
    return "all is okay";
}

function getArticleById($idArticle){
    $article = new article();
    return $article->getArticle($idArticle);
}

function getComment($idComment){
    $comment = new comment();
    return $comment->getComment($idComment);
}

function getMessage($idMessage,$status){
    $message = new message();
    return $message->getMessage($idMessage,$status);
}

function getUser($idUser){
    $user = new users();
    return $user->getUser($idUser);
}

function updateComment($idComment,$status){
    $comment = new comment();
    return $comment->updateComment($idComment,$status);
}

function deleteComment($idComment){
    $comment = new comment();
    return $comment->deleteComment($idComment);
}

function updateUser($userInfo,$file = null){
    // https://espritweb.fr/comment-uploader-une-image-en-php/
    $user = new users();
    if ($file["file"]["error"] == 0) {
        $tmpName = $file["file"]['tmp_name'];
        $name = $file["file"]['name'];
        move_uploaded_file($tmpName,
            '../ressource/img/account/' . $name
        );
        $user->updatePhoto($userInfo,$name);
    }
    if (!$userInfo["pwd"] == "") {
        $user->updatePwd($userInfo);
    }
    
    return $user->updateUser($userInfo);
}

function deleteUser($idUser){
    $user = new users();
    $user->deleteUser($idUser);
    return $idUser;
}

function updateArticle($articleInfo,$file=null){
    $article = new article();
    if ($file["file"]["error"] == 0) {
        $tmpName = $file["file"]['tmp_name'];
        $name = $file["file"]['name'];
        move_uploaded_file($tmpName,
            '../ressource/img/article/temp/' . $name
        );
        $article->updatePhoto($articleInfo,$name);
    }
    return $article->updateArticle($articleInfo);
}

function deleteArticle($idArticle){
    $article = new article();
    return $article->deleteArticle($idArticle);
}