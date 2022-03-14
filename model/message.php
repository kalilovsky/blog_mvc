<?php
require_once("manager.php");

class message extends Manager{

    public static function sendMessage($email,$content){
        $db = self::dbConnect();
        $insertSql = 'INSERT INTO message (senderemail,content) VALUES(?,?)';
        $querySql = $db->prepare($insertSql);
        $querySql->execute(array($email,$content));
    }

    public function getAllMessages(){
        $db = $this->dbConnect();
        $insertSql = 'SELECT * FROM message';
        $querySql = $db->prepare($insertSql);
        $querySql->execute();
        $resultSql = $querySql->fetchAll(pdo::FETCH_ASSOC);
        return $resultSql;
    }

    public function getMessagesByStatus($status){
        $db = $this->dbConnect();
        $insertSql = 'SELECT * FROM message WHERE status = ?';
        $querySql = $db->prepare($insertSql);
        $querySql->execute(array($status));
        $resultSql = $querySql->fetchAll(PDO::FETCH_ASSOC);
        return $resultSql;
    }

    public function getMessage($idMessage,$status = null){
        $db = $this->dbConnect();
        if($status==0){
            $updateSql = "UPDATE message SET status = 1 WHERE idmessage = ?";
            $querySql = $db->prepare($updateSql);
            $querySql->execute(array($idMessage));
        }
        $insertSql = 'SELECT * FROM message WHERE idmessage = ?';
        $querySql = $db->prepare($insertSql);
        $querySql->execute(array($idMessage));
        $resultSql = $querySql->fetchAll(PDO::FETCH_ASSOC);
        return $resultSql;
    }
}