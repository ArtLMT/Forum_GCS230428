<?php
// class Database {
//     private static $instance = null;
//     private $pdo;

//     private $host = "localhost";
//     private $dbname = "forum";
//     private $username = "root";
//     private $password = "";

//     private function __construct() {
//         try {
//             $this->$pdo = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
//             $this->$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//         } catch (PDOException $e) {
//             die("$pdoection failed: " . $e->getMessage());
//         }
//     }

//     public static function getInstance() {
//         if (self::$instance === null) {
//             self::$instance = new Database();
//         }
//         return self::$instance;
//     }

//     public function get$pdoection() {
//         return $this->$pdo;
//     }
// }
?>