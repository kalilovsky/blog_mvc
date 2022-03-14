<?php

require_once("manager.php");

class article extends Manager {
    public function getArticles($limit){
        $db = $this->dbConnect();
        $selectSql = "SELECT article.*, users.*, category.*, ifnull(t1.countComment,0) as countComment FROM article LEFT JOIN (SELECT comment.idarticle, COUNT(comment.idarticle) as countComment from comment WHERE comment.status = 1 GROUP BY comment.idarticle) as t1 ON t1.idarticle = article.idarticle INNER JOIN users on article.idusers = users.idusers INNER JOIN category ON article.idcategory = category.idcategory  GROUP BY article.idarticle LIMIT {$limit}";
        // SELECT article.*, users.*, category.*, t1.counter FROM article LEFT JOIN (SELECT comment.idarticle, COUNT(comment.idarticle) as counter from comment WHERE comment.status = 0 GROUP BY comment.idarticle) as t1 ON t1.idarticle = article.idarticle INNER JOIN users on article.idusers = users.idusers INNER JOIN category ON article.idcategory = category.idcategory  GROUP BY article.idarticle
        $querySql = $db->query($selectSql);
        $resultSql= $querySql->fetchAll(PDO::FETCH_ASSOC);
        return $resultSql;
    }
    public function getArticle($idArticle){
        $db = $this->dbConnect();
        $selectSql = "SELECT * FROM article INNER JOIN category ON article.idcategory = category.idcategory INNER JOIN users ON article.idusers = users.idusers WHERE idarticle = :idArticle";
        $querySql = $db->prepare($selectSql);
        $querySql->execute([
            "idArticle"=>$idArticle
        ]);
        $resultSql= $querySql->fetchAll(PDO::FETCH_ASSOC);
        return $resultSql;
    }

    public function updateArticle($articleInfo){
        $db = $this->dbConnect();
        $updateSql = "UPDATE article SET idcategory=?,title=?, content=?, updatedate=?, smalldesc =?  WHERE idarticle = ?";
        $querySql = $db->prepare($updateSql);
        $querySql->execute(array($articleInfo["idCategory"],$articleInfo["title"],$articleInfo["content"],date('d-m-y h:i:s'),$articleInfo["smallDesc"],$articleInfo["idArticle"]));
        $test = $querySql->errorInfo();
        return $this->getArticle($articleInfo["idArticle"]);
    }

    public function updatePhoto($articleInfo,$file){
        $db = $this->dbConnect();
        $updateSql = "UPDATE article SET photoarticle = ? WHERE idarticle = ?";
        $querySql = $db->prepare($updateSql)->execute(array($file,$articleInfo["idArticle"]));
    }

    public function deleteArticle($idArticle){
        $db = $this->dbConnect();
        $deleteSql ="DELETE FROM article WHERE idarticle = ?";
        $querySql = $db->prepare($deleteSql);
        $querySql->execute(array($idArticle));
        return $idArticle;
    }
    
    public function createArticle($articleInfo){
        $db = $this->dbConnect();
        $insertSql = "INSERT INTO article(idusers,idcategory,title,content,smalldesc) VALUES(?,?,?,?,?)";
        $querySql = $db->prepare($insertSql);
        $querySql->execute(array($articleInfo["idusers"],$articleInfo["idcategory"],$articleInfo["title"],$articleInfo["content"],$articleInfo["smalldesc"]));
    }
}