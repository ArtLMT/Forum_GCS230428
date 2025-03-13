<?php
namespace src\dal\implementations;

use src\config\Database;
use src\dal\interfaces\ModuleDAO;
use src\models\Module;

class ModuleDAOImpl implements ModuleDAO {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getConnection();
    }

    public function createModule($moduleName, $moduleDescription) 
    {

    }

    public function updateModule($moduleId, $moduleName, $moduleDescription) 
    {

    }

    public function getModuleById($moduleId) 
    {

    }
}
?>
