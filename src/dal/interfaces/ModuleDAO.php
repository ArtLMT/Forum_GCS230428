<?php
namespace src\dal\interfaces;

interface ModuleDAO {
    public function createModule($moduleName, $moduleDescription);
    public function updateModule($moduleId, $moduleName, $moduleDescription);
    public function getModuleById($moduleId);
}
?>
