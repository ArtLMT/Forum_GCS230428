<?php
interface ModuleDAO {
    public function createModule(Module $module);
    public function getModuleById($moduleId);
}
?>
