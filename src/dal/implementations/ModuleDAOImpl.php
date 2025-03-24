<?php
namespace src\dal\implementations;

use config\Database;
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
    
    // public function getModuleById($moduleId)
    // {
    //     $query = "SELECT * FROM modules WHERE module_ida = :module_id";
    //     $stmt = $this->pdo->prepare($query);
    //     $stmt->bindParam(':module_id', $moduleId, \PDO::PARAM_INT);
    //     $stmt->execute();
    
    //     return $stmt->fetch(\PDO::FETCH_ASSOC); 
    // }
    public function getModuleById($moduleId) 
    {
        $query = "SELECT * FROM modules WHERE module_id = :module_id";
        $params = [':module_id' => $moduleId];
        
        $stmt = $this->executeQuery($query, $params);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
    
        if (!$result) {
            return null; // Return null if no module is found
        }
    
        return new Module($result['module_id'], $result['module_name'], $result['module_description']);
    }    

    public function getAllModules(): array
    {
        $query = "SELECT * FROM modules";
        $stmt = $this->executeQuery($query);
    
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        
        $modules = [];
        foreach ($rows as $row) {
            $modules[] = $this->mapToModule($row);
        }
    
        return $modules; // Returns an array of Module objects
    }
    
    private function mapToModule($data): Module
    {
        return new Module($data['module_id'], $data['module_name'], $data['module_description']);
    }
    

    public function getName($moduleId) 
    {
        $query = "SELECT module_name FROM modules WHERE module_id = :module_id";
        $params = [':module_id' => $moduleId];
        
        $stmt = $this->executeQuery($query, $params);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        
        return $result ? $result['module_name'] : null;
    }
    
    public function getDescription($moduleId)
    {
        $query = "SELECT module_description FROM modules WHERE module_id = :module_id";
        $params = [':module_id' => $moduleId];
        
        $stmt = $this->executeQuery($query, $params);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        
        return $result ? $result['module_description'] : null;
    }
    
    public function deleteModule($moduleId) {
        $query = "DELETE FROM modules WHERE module_id = :module_id";
        $params = [':module_id' => $moduleId];
    
        $this->executeQuery($query, $params);
    }
    
}
?>
