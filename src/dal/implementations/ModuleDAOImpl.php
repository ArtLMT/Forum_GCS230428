<?php
namespace src\dal\implementations;

use src\config\Database;
use src\dal\interfaces\ModuleDAO;
use src\models\Module;
use src\dal\BaseDAO;


// Admin-only class
class ModuleDAOImpl extends BaseDAO implements ModuleDAO {

    public function __construct() {
        $this->db = new Database();
        $this->pdo = $this->db->getConnection();
    }

    public function createModule($moduleName, $moduleDescription) 
    {
        $query = "INSERT INTO modules (module_name, module_description) 
                  VALUES (:module_name, :module_description)";
        $params = [
            ':module_name' => $moduleName,
            ':module_description' => $moduleDescription,
        ];
        $this->executeQuery($query, $params);
    }

    public function updateModule($moduleId, $moduleName, $moduleDescription) 
    {
        $query = "UPDATE modules
                  SET module_name = :module_name,
                      module_description = :module_description
                  WHERE module_id = :module_id";
        $params = [
            ':module_name' => $moduleName,
            ':module_description' => $moduleDescription,
            ':module_id' => $moduleId,
        ];
        $this->executeQuery($query, $params);
    }

    public function getModuleById($moduleId) 
    {
        $query = "SELECT * FROM modules WHERE module_id = :module_id";
        $params = [':module_id' => $moduleId];
        $result =
        return new Module($result);
    }
}
?>
