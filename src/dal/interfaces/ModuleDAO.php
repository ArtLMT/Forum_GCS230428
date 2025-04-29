<?php
namespace src\dal\interfaces;

interface ModuleDAO {
    public function createModule($moduleName, $moduleDescription);
    public function updateModule($moduleId, $moduleName, $moduleDescription);
    public function getModuleById($moduleId);
    public function getAllModules(): array;
    public function getName($moduleId);
    public function getDescription($moduleId);
    public function deleteModule($moduleId);
    public function getTotalModule();
    public function getTotalPostOfModuleId($moduleId);
    public function getModulesPaginated($limit, $offset): array;
}
?>
