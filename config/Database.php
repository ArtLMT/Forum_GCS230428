<?php
namespace config;

class Database {
    private $host = "localhost";
    private $db_name = "forum";
    private $username = "root";
    private $password = "";
    private $pdo;
    
    public function getConnection() {
        try {
            $this->pdo = new PDO("mysql:host=".$this->host.";dbname=".$this->db_name, $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->pdo;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            return null;
        }
    }
}
?>