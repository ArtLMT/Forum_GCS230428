<?php
namespace src\controllers;

use src\dal\implementations\ModuleDAOImpl;
use src\dal\implementations\UserDAOImpl;
use src\dal\implementations\PostDAOImpl;



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

    public function delete ()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $moduleId = $_POST['module_id'];
            $this->moduleDAO->deleteModule($moduleId);
            
            header("Location: /forum/public/");
            exit();
        }

        // require_once __DIR__ . '/../views/deleteModule.html.php';
    }

    // public function update()
    // {
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         $moduleId = $_POST['module_id'];
    //         $moduleName = $_POST['module_name'];
    //         $moduleDescription = $_POST['module_description'];

    //         $moduleDAO->updateModule($moduleId, $moduleName, $moduleDescription);
    //     }
    // }
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $moduleId = $_POST['module_id'];
            $moduleName = $_POST['module_name'];
            $moduleDescription = $_POST['module_description'];

            // Corrected line: Use $this->moduleDAO instead of $moduleDAO
            $this->moduleDAO->updateModule($moduleId, $moduleName, $moduleDescription);

            // Redirect after update
            header("Location: /forum/public/moduleLists");
            exit();
        }

        // Optionally, load the update form if needed
        // require_once __DIR__ . '/../views/updateModule.html.php';
    }

}