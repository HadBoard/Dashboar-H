<?php

namespace App\Model;

class DB
{

    protected $pdo;

    public function __construct()
    {

        $config = require __DIR__."/../config.php";
        $database = $config['db']['database'];
        $username = $config['db']['username'];
        $password = $config['db']['password'];
        $host = "localhost";
        $charset = "UTF-8";
        $dsn = "mysql:host={$host};dbname={$database};charset={$charset}";

        try {
            $this->pdo = new \PDO($dsn, $username, $password);
        } catch (\Exception $ex) {
            die("Error : {$ex->getMessage()} ");
        }
    }
}