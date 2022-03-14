<?php
require_once("model/user.php");
require_once("model/article.php");
require_once("model/comment.php");
require_once("model/message.php");
require_once("controller_article.php");

function showHome(){
    //charger les donnée du home
    $allArticles = new article();
    $results = $allArticles->getArticles(15);
    
    //charger la page qui elle chargera le template
    require_once("view/frontend/home_user.php");
}



function showAbout(){
    //chargé la page
    require_once("view/frontend/about.php");
}

function showContactPage(){
    //chargé la page
    require_once("view/frontend/contact.php");
}



function showRegisterPage(){
    require_once("view/frontend/register.php");
}

function sendMessageToDb($email,$message) {
  message::sendMessage($email,$message);
}

function login($post){
    $actualUser = new users();
    $actualUser->loginUser($post);
}

function register($post){
    $newUser = new users();
    // $test = $newUser->registerUser($post);
    // return $test;
    $newUser->registerUser($post);
    
}

function showAdminDashboard(){
    $user = new users();
    $countUsers = count($user->getAllUsers());
    $comments = new comment();
    $allComments = $comments->getAllComments(0);
    $articles = new article;
    $allArticles = $articles->getArticles(1000);
    $messages = new message;
    $allMessages = $messages->getAllMessages();
    require_once("view/backend/dashboard_admin.php");
}

function showEditUsersAdmin(){
    $user = new users();
    $users = $user->getAllUsers();
    require_once("view/backend/edit_users_admin.php");
}

function showEditCommentsAdmin(){
    $comments = new comment();
    $allComments = $comments->getAllComments();
    require_once("view/backend/edit_comment_admin.php");
}



function showEditMessagesAdmin(){
    $messages = new message;
    $allMessages = $messages->getAllMessages();
    require_once("view/backend/edit_messages_admin.php");
}