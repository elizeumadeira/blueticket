<?php

namespace App\Controller;
use PDO;
// require 'config.php';

class Controller
{
    private $pdo;
    public function __construct()
    {
        $pdo = new PDO("mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DB_NAME, MYSQL_USER, MYSQL_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }

    public function get_pdo(){
        return $this->pdo;
    }
}