<?php

class Database {
    private static $instance = null;
    private $pdo;
    
    private function __construct() {
        $this->pdo = new PDO("mysql:host=db;dbname=maniglio_calcetto", "root", "", [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }
    
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function getConnection() {
        return $this->pdo;
    }


}