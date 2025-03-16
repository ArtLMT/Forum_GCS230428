<?php
namespace src\controllers;

use src\dal\implementations\ModuleDAOImpl;
use src\dal\implementations\UserDAOImpl;
use src\dal\implementations\PostDAOImpl;



class ModuleController {
    $private $moduleDAO;
    $private $userDAO;
    $private $postDAO;

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
        return $modules;
    }
}