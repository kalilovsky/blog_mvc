<?php
function showAllArticles(){
    // charger les données de la page all articles
    $allArticles = new article();
    $results = $allArticles->getArticles(15);
    //chargé la page
    require_once("view/frontend/all_articles.php");
}

function showArticle($idArticle){
    //Get the article data for the page
    $article = new article();
    $results = $article->getArticle($idArticle);
    //Get the comments related to the article
    $comments = new comment();
    $commentsResult = $comments->getCommentsByArticle($idArticle);
    $articles = $article->getArticles(3);
    require_once("view/frontend/article.php");
}

function showEditArticlesAdmin(){
    $articles = new article;
    $allArticles = $articles->getArticles(1000);
    require_once("view/backend/edit_articles_admin.php");
}