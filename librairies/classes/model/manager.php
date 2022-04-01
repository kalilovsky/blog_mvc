<?php
namespace model ;

use PDO;
use PDOException;

class Manager
{
    protected function dbConnect()
    {
        try {
            $db = new PDO('mysql:host=localhost;dbname=blogg_olivier;charset=utf8', 'khalil', 'root');
            return $db;
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}
