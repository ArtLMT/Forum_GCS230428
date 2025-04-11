<?php
namespace src\controllers;

use src\dal\implementations\ModuleDAOImpl;
use src\dal\implementations\PostDAOImpl;
use src\utils\Validation;

class ModuleController {
    private $moduleDAO;

    public function __construct() {
        $this->moduleDAO = new ModuleDAOImpl();
    }

    public function getAllModules()
    {
        return $modules = $this->moduleDAO->getAllModules();
    }

    // List all modules
    public function index() {
        $modules = $this->moduleDAO->getAllModules();

        // Get post count for each module
        $modulePostCounts = [];
        foreach ($modules as $module) {
            $modulePostCounts[$module->getModuleId()] = $this->getNumberOfPostOfModuleId($module->getModuleId());
        }
        
        require_once __DIR__ . '/../views/modules/moduleLists.html.php';
    }

    // Show form for creating a module
    public function create() {
        require_once __DIR__ . '/../views/modules/createModule.html.php';
    }

    // Store a new module
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo "Method Not Allowed";
            return;
        }

        $moduleName = $_POST['module_name'];
        $moduleDescription = $_POST['module_description'];

        $this->moduleDAO->createModule($moduleName, $moduleDescription);
        header('Location: /forum/public/moduleLists');
        exit();
    }

    // Show edit form
    public function edit() 
    {
        $moduleId = $_GET['id'] ?? null;

        if (!$moduleId || !Validation::checkModuleById($moduleId)) {
            echo "Error: Invalid Module ID.";
            return;
        }

        $module = $this->moduleDAO->getModuleById($moduleId);
        require_once __DIR__ . '/../views/modules/updateModule.html.php';
    }

    // Update an existing module
    public function update() 
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo "Method Not Allowed";
            return;
        }

        $moduleId = $_POST['module_id'];
        $moduleName = $_POST['module_name'];
        $moduleDescription = $_POST['module_description'];

        if (!Validation::checkModuleById($moduleId)) {
            echo "Error: Invalid Module ID.";
            return;
        }

        $this->moduleDAO->updateModule($moduleId, $moduleName, $moduleDescription);
        header("Location: /forum/public/moduleLists");
        exit();
    }

    // Delete a module
    public function destroy() 
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            http_response_code(405);
            echo "Method Not Allowed";
            return;
        }

        $moduleId = $_GET['id'] ?? null;

        if (!$moduleId || !Validation::checkModuleById($moduleId)) {
            echo "Error: Invalid Module ID.";
            return;
        }

        $this->moduleDAO->deleteModule($moduleId);
        header("Location: /forum/public/moduleLists");
        exit();
    }

    public function getNumberOfPostOfModuleId($moduleOd)
    {
        return $this->moduleDAO->getTotalPostOfModuleId($moduleOd);
    }
}
?>
