<?php
namespace src\controllers;

use src\dal\implementations\ModuleDAOImpl;
use src\dal\implementations\UserDAOImpl;
use src\dal\implementations\PostDAOImpl;
use src\utils\Validation;


class ModuleController {
    private $moduleDAO;
    private $userDAO;
    private $postDAO;

    public function __construct() {
        $this->moduleDAO = new ModuleDAOImpl();
        $this->userDAO = new UserDAOImpl();
        $this->postDAO = new PostDAOImpl();
    }

    public function createModule($moduleName, $moduleDescription) 
    {
        $this->moduleDAO->createModule($moduleName, $moduleDescription);
    }

    public function updateModule($moduleId, $moduleName, $moduleDescription) 
    {
        $this->moduleDAO->updateModule($moduleId, $moduleName, $moduleDescription);
    }

    public function getModuleById($moduleId) : Module
    {
        $module = $this->moduleDAO->getModuleById($moduleId);
        return $module;
    }

    public function listModules() 
    {
        $modules = $this->moduleDAO->getAllModules();
        foreach($modules as $module) {
            $moduleId = $module->getModuleId();
        }

        require_once __DIR__ . '/../views/moduleLists.html.php';
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $moduleName = $_POST['module_name'];
            $moduleDescription = $_POST['module_description'];

            $this->createModule($moduleName, $moduleDescription);
            header('Location: /forum/public/moduleLists');
            exit();
        }

        require_once __DIR__ . '/../views/createModule.html.php';
    }

    public function delete()
    {
        $moduleId = $_GET['id'] ?? null;
    
        if (!$moduleId || !Validation::checkModuleById($moduleId)) {
            echo "Error: Invalid module ID";
            exit(); // Stop execution
        }
        
        $this->moduleDAO->deleteModule($moduleId);
        header("Location: /forum/public/moduleLists"); // Redirect after deletion
        exit();
    }
    

        // require_once __DIR__ . '/../views/deleteModule.html.php';

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $moduleId = $_POST['module_id'];
            $moduleName = $_POST['module_name'];
            $moduleDescription = $_POST['module_description'];
    
            $moduleDAO = new ModuleDAOImpl();
    
            if (!Validation::checkModuleById($moduleId)) {
                echo "Error: Invalid Module ID.";
                return;
            }
    
            $moduleDAO->updateModule($moduleId, $moduleName, $moduleDescription);
            header("Location: /forum/public/moduleLists");
            exit();
        } else {
            $moduleId = $_GET['id'] ?? null;
    
            if (!$moduleId) {
                echo "Error: Module ID is missing.";
                return;
            }
    
            $moduleDAO = new ModuleDAOImpl();
            $module = $moduleDAO->getModuleById($moduleId);
    
            if (!$module) {
                echo "Error: Module not found.";
                return;
            }
    
            require_once __DIR__ . '/../views/updateModule.html.php';
        }
    }
    
}