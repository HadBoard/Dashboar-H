<?php

namespace App\Model;

class DB
{

    protected $pdo;
    protected $table;
    protected $fetcMode = \PDO::FETCH_OBJ;

    public function __construct()
    {

        $config = require __DIR__."/../config.php";
        $database = $config['db']['database'];
        $username = $config['db']['username'];
        $password = $config['db']['password'];
        $host = "localhost";
        $charset = "UTF8";
        $dsn = "mysql:host={$host};dbname={$database};";

        try {
            $this->pdo = new \PDO($dsn, $username, $password);
        } catch (\Exception $ex) {
            die("Error : {$ex->getMessage()} ");
        }
    }

    public function select() {
        $stmt = $this->pdo->prepare("SELECT * FROM `{$this->table}`");
        $stmt->execute();
        return $stmt->fetchAll($this->fetcMode);
    }

}