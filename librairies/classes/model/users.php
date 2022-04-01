<?php

namespace model;
use PDO; //a enlever lors du rajout des attributs dans la classe parente

class users extends Manager 
{   

    public function loginUser($userInfo)
    {
        $db = $this->dbConnect();
        
        $selectSql = "SELECT * FROM users WHERE email = :email";
        $querySql = $db->prepare($selectSql);
        $querySql->execute([
            "email"=>$userInfo["email"]
        ]);
        if($querySql->rowCount()>0){
            $resultSql = $querySql->fetch(PDO::FETCH_ASSOC);
            $verifPwd = password_verify($userInfo["pwd"],$resultSql["pwd"]);
            if ($verifPwd)
            {
                $this->setSession($resultSql);
                return $resultSql;
            }else
            {
                $_SERVER["erreur"] = "Email ou mot de passe erroné";
            }

        }else
        {
            $_SERVER["erreur"] = "Email ou mot de passe erroné";
        }

    }

    public function registerUser($userInfo){
        if (!$this->verifyUserData($userInfo)){
            $_SESSION["erreur"] = "Erreur dans les données saisies";
            return;
        }

        $db = $this->dbConnect();
        $selectSql = "SELECT * FROM users WHERE email = :email OR pseudo = :Pseudo";
        $querySql = $db->prepare($selectSql);
        $querySql->execute([
            "email"=>$userInfo["email"],
            "Pseudo"=>$userInfo["pseudo"]
        ]);
        if (!$querySql->rowCount()>0){
            $pwd = password_hash($userInfo["pwd"],PASSWORD_DEFAULT);
            $insertSql = "INSERT INTO users(firstname,lastname,email,pwd,pseudo) VALUES (:firstname,:lastname,:email,:pwd,:pseudo)";
            $querySql = $db->prepare($insertSql);
            $querySql->execute([
                "firstname"=>$userInfo["firstname"],
                "lastname"=>$userInfo["lastname"],
                "email"=>$userInfo["email"],
                "pwd"=>$pwd,
                "pseudo"=>$userInfo["pseudo"]
            ]);
            $test = $querySql->errorInfo();
            $userInfo["pwd"]=$pwd;
            $userInfo["usertype"] = "normal";
            $userInfo["photouser"] = "account_default.png";
            $userInfo["idusers"] = $db->lastInsertId();
            $this->setSession($userInfo);
            
        }
        else{
           $_SESSION["erreur"] = "Email ou Pseudo déja existant";
        }
    }

    public function getUser($userId)
    {
        $db = $this->dbConnect();
        $selectSql = "SELECT * FROM users WHERE idusers=:userId";
        $querySql = $db->prepare($selectSql);
        $querySql->execute([
            "userId"=>$userId
        ]);
        $resultSql = $querySql->fetch(PDO::FETCH_ASSOC);
        return $resultSql;
    }

    public function getAllUsers()
    {
        $db = $this->dbConnect();
        $selectSql = "SELECT * FROM users";
        $querySql = $db->prepare($selectSql);
        $querySql->execute();
        $resultSql = $querySql->fetchAll(PDO::FETCH_ASSOC);
        return $resultSql;
    }

    public function updateUser($userInfo)
    {
        $db = $this->dbConnect();
        $updateSql = "UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email, pseudo = :pseudo, usertype = :usertype WHERE idusers = :idUser";
        $querySql = $db->prepare($updateSql);
        $querySql->execute([
            "firstname"=>$userInfo["firstname"],
            "lastname"=>$userInfo["lastname"],
            "pseudo"=>$userInfo["pseudo"],
            "email"=>$userInfo["email"],
            "idUser"=>$userInfo["idusers"],
            "usertype"=>$userInfo["usertype"]
        ]);
        $resultSql = $db->prepare("SELECT * FROM users WHERE idusers = ?");
        $resultSql->execute(array($userInfo["idusers"]));
        return $resultSql->fetch(PDO::FETCH_ASSOC);
        //$this->setSession($resultSql);
        //echo 'Update effectué.';  
    }

    private function setSession($resultSql)
    {
        unset($_SESSION["erreur"]);
        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION["mail"] = $resultSql["email"];
        $_SESSION["firstname"] = $resultSql["firstname"];
        $_SESSION["lastname"] = $resultSql["lastname"];
        $_SESSION["photo"] = $resultSql["photouser"];
        $_SESSION["idUser"] = $resultSql["idusers"];
        $_SESSION["userType"] = $resultSql["usertype"];
        $_SESSION["pwd"] = $resultSql["pwd"];
        $_SESSION["pseudo"] = $resultSql["pseudo"];
    }

    public function verifyUserData($userInfo){
        foreach ($userInfo as $elem){
            if($elem==""){
                return false;
            }

        }
        if ($userInfo["pwd"] != $userInfo["pwd2"]){
            return false;
        }
        return true;
    }

    public function updatePhoto($userInfo,$file){
        $db = $this->dbConnect();
        $updateSql = "UPDATE users SET photouser = ? WHERE idusers = ?";
        $querySql = $db->prepare($updateSql)->execute(array($file,$userInfo["idusers"]));
    }

    public function updatePwd($userInfo){
        $pwd = password_hash($userInfo["pwd"],PASSWORD_DEFAULT);
        $db = $this->dbConnect();
        $updateSql = "UPDATE users SET pwd = ? WHERE idusers = ?";
        $querySql = $db->prepare($updateSql)->execute(array($pwd,$userInfo["idusers"]));
    }

    public function deleteUser($idUser){
        $db = $this->dbConnect();
        $deleteSql = "DELETE FROM users WHERE idusers = ?";
        $querySql = $db->prepare($deleteSql)->execute(array($idUser));
        
    }
}