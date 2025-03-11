<?php
require_once __DIR__ . "/../../config/Database.php";
require_once __DIR__ . "/../interfaces/ModuleDAO.php";
require_once __DIR__ . "/../../models/Module.php";

class ModuleDAOImpl implements ModuleDAO {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getConnection();
    }

    public function createModule() 
    {

    }

    public function getModuleById() 
    {

    }
}
?>
