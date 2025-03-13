<?php
namespace src\dal;

use config\Database;

abstract class BaseDAO {
    protected $pdo;
    protected $query;
    protected $db;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    protected function executeQuery($sql, array $params = []) {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

}
?>