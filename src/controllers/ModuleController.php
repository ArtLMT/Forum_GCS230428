<?php
namespace src\controllers;

use src\dal\implementations\ModuleDAOImpl;
use src\utils\Validation;
use src\utils\SessionManager;

class ModuleController {
    private $moduleDAO;

    public function __construct() {
        $this->moduleDAO = new ModuleDAOImpl();
    }

    public function getAllModules()
    {
        return $this->moduleDAO->getAllModules();
    }

    public function isLoggedIn()
    {
        $currentUser = SessionManager::get('user');
        if ($currentUser === null) {
            $errors['unauth'] = 'You need to login to access this page.';
            SessionManager::set('errors', $errors);
            header("Location: /forum/public/login");
            exit();
        }
    }

    // List all modules
    public function index() 
    {
        $this->isLoggedIn();
        $modules = $this->moduleDAO->getAllModules();
        $modulePostCounts = [];
        foreach ($modules as $module) {
            $modulePostCounts[$module->getModuleId()] = $this->getNumberOfPostOfModuleId($module->getModuleId());
        }
        
        require_once __DIR__ . '/../views/modules/moduleLists.html.php';
    }

    // Show form for creating a module
    public function create() 
    {
        $this->isLoggedIn();
        require_once __DIR__ . '/../views/modules/createModule.html.php';
    }

    // Store a new module
    public function store() 
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo "Method Not Allowed";
            return;
        }

        $moduleName = $_POST['module_name'] ?? '';
        $moduleDescription = $_POST['module_description'] ?? '';

        // Validation
        if (!Validation::validateNotEmpty($moduleName) || !Validation::validateNotEmpty($moduleDescription)) {
            $message = "Module name and description cannot be empty.";
            require_once __DIR__ . '/../views/error/displayError.html.php';
            exit();
        }

        $this->moduleDAO->createModule($moduleName, $moduleDescription);
        header('Location: /forum/public/moduleLists');
        exit();
    }

    // Show edit form
    public function edit() 
    {
        $this->isLoggedIn();
        $moduleId = $_GET['id'] ?? null;

        if (!Validation::validateNotEmpty($moduleId) || !Validation::checkModuleById($moduleId)) {
            $message = "Oops! Invalid Module ID provided.";
            require_once __DIR__ . '/../views/error/displayError.html.php';
            exit();
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

        $moduleId = $_POST['module_id'] ?? null;
        $moduleName = $_POST['module_name'] ?? '';
        $moduleDescription = $_POST['module_description'] ?? '';

        if (!Validation::validateNotEmpty($moduleId) || !Validation::checkModuleById($moduleId)) {
            $message = "Oops! Invalid Module ID provided.";
            require_once __DIR__ . '/../views/error/displayError.html.php';
            exit();
        }

        if (!Validation::validateNotEmpty($moduleName) || !Validation::validateNotEmpty($moduleDescription)) {
            $message = "Module name and description cannot be empty.";
            require_once __DIR__ . '/../views/error/displayError.html.php';
            exit();
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

        if (!Validation::validateNotEmpty($moduleId) || !Validation::checkModuleById($moduleId)) {
            $message = "Oops! Invalid Module ID provided.";
            require_once __DIR__ . '/../views/error/displayError.html.php';
            exit();
        }

        $this->moduleDAO->deleteModule($moduleId);
        header("Location: /forum/public/moduleLists");
        exit();
    }

    public function getNumberOfPostOfModuleId($moduleId)
    {
        return $this->moduleDAO->getTotalPostOfModuleId($moduleId);
    }
}
?>
