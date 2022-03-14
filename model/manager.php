<?php

class Manager
{
    protected function dbConnect()
    {
        try {
            $db = new PDO('mysql:host=localhost;dbname=blogg_olivier;charset=utf8', 'khalil', 'root');
            return $db;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}
