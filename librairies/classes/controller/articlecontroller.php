<?php
namespace controller;


use Renderer;
use model\users;
use model\comment;
use model\message;

class articleController extends controller{

    protected $modelName = "article";

    public function showAllArticles(){
        //ça fait uniquement référence à $this->model = new $realModelName;
        //qui veut dire $this->model = new model\article
        $results = $this->model->getArticles(25);
        $title = 'Acceuil';
        \Renderer::render("frontend/all_articles", compact("title", "results"));
    }
    public function index(){
        //charger les donnée du home
        
        $results = $this->model->getArticles(15);

        $title = 'Acceuil';
        //charger la page qui elle chargera le template

        \Renderer::render("frontend/home_user", compact('title', 'results'));
    }

    public function showArticle(){
        $results = $this->model->getArticle($_GET["idArticle"]);
        $articles = $this->model->getArticles(3);
        $comments = new comment();
        $commentsResult = $comments->getCommentsByArticle($_GET["idArticle"]);
        $title = $results[0]["title"];
        \Renderer::render("frontend/article", compact("title","results","commentsResult","articles"));

    }

    public function showEditArticlesAdmin(){
        $allArticles = $this->model->getArticles(1000);
        $title = "Tableau de bord";
        \Renderer::render("backend/edit_articles_admin",compact("title","allArticles"));
    }
    
    public function showAdminDashboard(){
        $user = new users();
        $countUsers = count($user->getAllUsers());
        $comments = new comment();
        $allComments = $comments->getAllComments(0);
        
        $allArticles = $this->model->getArticles(1000);
        $messages = new message;
        $allMessages = $messages->getAllMessages();
        $title = "Tableau de bord";
        \Renderer::render("backend/dashboard_admin", compact("title", "countUsers", "allComments", "allArticles", "allMessages"));
    
    }

    public function showHome()
    {
        //charger les donnée du home
        
        $results = $this->model->getArticles(15);

        $title = 'Acceuil';
        //charger la page qui elle chargera le template

        \Renderer::render("frontend/home_user", compact('title', 'results'));
    }

    public function updateArticle(){
        $file = $_FILES;
        $articleInfo = $_POST;
        if ($file["file"]["error"] == 0) {
            $tmpName = $file["file"]['tmp_name'];
            $name = $file["file"]['name'];
            move_uploaded_file($tmpName,
                'ressource/img/article/temp/' . $name
            );
            $this->model->updatePhoto($articleInfo,$name);
        }
        echo json_encode($this->model->updateArticle($articleInfo));
    }

    public function deleteArticle(){
        $idArticle = filter_input(INPUT_POST,"idArticle",FILTER_VALIDATE_INT);
        echo json_encode($this->model->deleteArticle($idArticle));
    }

    public function getArticle(){
        $idArticle = filter_input(INPUT_POST,"idArticle",FILTER_VALIDATE_INT);
        echo json_encode($this->model->getArticle($idArticle));
    }

    public function showAbout(){
        //chargé la page
        $title = 'A propos';
        \Renderer::render("frontend/about",compact("title"));
        
    } //ok
    
    public function showContactPage(){
        //chargé la page
        $title = 'Contact';
        \Renderer::render("frontend/contact",compact("title"));
        
    } //ok
    
    
    
    public function showRegisterPage(){
    
        $title = "Inscription";
        \Renderer::render("frontend/register",compact("title"));
        
    } //ok

    public function showAddArticlePage(){
        $title = "Ajouter un article";
        \Renderer::render("backend/addarticle", compact("title"));
    }

    public function addArticle(){
        $args = array(
                            'idCategory'=>FILTER_VALIDATE_INT,
                            'title'=>FILTER_SANITIZE_FULL_SPECIAL_CHARS,
                            'content'=>FILTER_SANITIZE_FULL_SPECIAL_CHARS,
                            'smallDesc'=>FILTER_SANITIZE_FULL_SPECIAL_CHARS	);
       $dataToAdd = filter_input_array(INPUT_POST,$args);
       $dataToAdd["idUser"] = $_SESSION["idUser"];
       $idArticle["idArticle"] = $this->model->insertArticle($dataToAdd);
       $file = $_FILES;
        
        if ($file["file"]["error"] == 0) {
            $tmpName = $file["file"]['tmp_name'];
            $name = $file["file"]['name'];
            move_uploaded_file($tmpName,
                'ressource/img/article/temp/' . $name
            );
            $this->model->updatePhoto($idArticle,$name);
        }
        echo json_encode($idArticle["idArticle"]);

    }

}