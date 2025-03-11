<?php
class Module {
    private $moduleId;
    private $moduleName;
    private $moduleDescription;

    public function __construct($moduleId, $moduleName, $moduleDescription)
    {
        $this->moduleId = $moduleId;
        $this->moduleName = $moduleName;
        $this->moduleDescription = $moduleDescription;
    }

    public function getModuleId()
    {
        return $this->moduleId;
    }

    public function setModuleId($moduleId)
    {
        $this->moduleId = $moduleId;
    }

    public function getModuleName()
    {
        return $this->moduleName;
    }

    public function setModuleName($moduleName)
    {
        $this->moduleName = $moduleName;
    }

    public function getModuleDescription()
    {
        return $this->moduleDescription;
    }

    public function setModuleDescription($moduleDescription)
    {
        $this->moduleDescription = $moduleDescription;
    }
}

?>