<?php
namespace model ;
use PDO; //a enlever lors du rajout des attributs dans la classe parente


class comment extends Manager {

    public function getComment($idComment){
        $db = $this->dbConnect();
        $selectSql = "SELECT * FROM comment INNER JOIN users ON comment.idusers = users.idusers INNER JOIN article ON article.idarticle=comment.idarticle WHERE idcomment = ?";
        $querySql = $db->prepare($selectSql);
        $querySql->execute(array($idComment));
        $resultSql = $querySql->fetchAll(PDO::FETCH_ASSOC);
        $test = $querySql->errorInfo();
        return $resultSql;
    }
    
    public function getAllComments($status = 5){
        $db = $this->dbConnect();
        if ($status != 5){
            $selectSql = "SELECT * FROM comment INNER JOIN users ON comment.idusers = users.idusers INNER JOIN article ON article.idarticle=comment.idarticle WHERE status = ?";
        }else{
                $selectSql = "SELECT * FROM comment INNER JOIN users ON comment.idusers = users.idusers INNER JOIN article ON article.idarticle=comment.idarticle";
        }
        $querySql = $db->prepare($selectSql);
        $querySql->execute(array($status));
        $resultSql = $querySql->fetchAll(PDO::FETCH_ASSOC);
        $test = $querySql->errorInfo();
        return $resultSql;
    }

    public function getCommentsByArticle($idArticle){
        $db = $this->dbConnect();
        $selectSql = "SELECT comment.*,COUNT(comment.idarticle) as counterComment FROM comment INNER JOIN users ON comment.idusers = users.idusers WHERE idarticle = :idArticle AND status = 1 GROUP BY comment.idcomment";
        $querySql = $db->prepare($selectSql);
        $querySql->execute([
            'idArticle'=>$idArticle
        ]);
        $resultSql = $querySql->fetchAll(PDO::FETCH_ASSOC);
        return$resultSql;
    }

    public function getCommentsByUser($idUser){
        $db = $this->dbConnect();
        $selectSql = "SELECT * FROM comment INNER JOIN users ON comment.idusers = users.idusers WHERE idusers = :idUser";
        $querySql = $db->prepare($selectSql);
        $querySql->execute([
            'idUser'=>$idUser
        ]);
        $resultSql = $querySql->fetchAll(PDO::FETCH_ASSOC);
        return $resultSql;
    }

    public function countCommentByArticle($idArticle){
        $db = $this->dbConnect();
        $selectSql = "SELECT COUNT(idcomment) as countComment FROM comment WHERE idarticle = :idArticle";
        $querySql = $db->prepare($selectSql);
        $querySql->execute([
            'idArticle'=>$idArticle
        ]);
        $resultSql = $querySql->fetch(PDO::FETCH_ASSOC);
        
        return $resultSql;
    }

    public function postComment($commentInfo){
        $db = $this->dbConnect();
        $insertSql = "INSERT INTO comment(idarticle,contentcomment,idusers,sender) VALUES(?,?,?,?)";
        $querySql = $db->prepare($insertSql);
        $querySql->execute(array($commentInfo["idArticle"],$commentInfo["comment"],$commentInfo["idUser"],$commentInfo["pseudo"]));
        $test = $querySql->errorInfo();
    }

    public function updateComment($idComment,$status){
        $db = $this->dbConnect();
        $updateSql = "UPDATE comment SET status = ? WHERE idcomment =?";
        $querySql = $db->prepare($updateSql);
        $querySql->execute(array($status,$idComment));
        
        return  $idComment;
    }

    public function deleteComment($idComment){
        $db = $this->dbConnect();
        $deleteSql = "DELETE FROM comment WHERE idcomment = ?";
        $querySql = $db->prepare($deleteSql)->execute(array($idComment));
        if ($querySql){
            return ["status"=>"all is okay","idComment"=>$idComment];
        }else{
            return ["status"=>"Houston we have a problem"];
        }
    }
}