<?php
namespace src\utils;

use src\dal\implementations\UserDAOImpl;
use src\dal\implementations\PostDAOImpl;
use src\dal\implementations\ModuleDAOImpl;

class Validation {
    private static ?UserDAOImpl $userDAO = null;
    private static ?PostDAOImpl $postDAO = null;
    private static ?ModuleDAOImpl $moduleDAO = null;

    private static function init()
    {
        if (self::$userDAO === null) {
            self::$userDAO = new UserDAOImpl();
        }
        if (self::$postDAO === null) {
            self::$postDAO = new PostDAOImpl();
        }
        if (self::$moduleDAO === null) {
            self::$moduleDAO = new ModuleDAOImpl();
        }
    }

    public static function checkUserById($userId) :bool
    {
        self::init();
        return self::$userDAO->getUserById($userId) ? true : false;
    }

    public static function checkUserByUsername($username) :bool
    {
        self::init();
        return self::$userDAO->getUserByUsername($username) ? true : false;
    }

    public static function checkPostById($postId) :bool
    {
        self::init();
        return self::$postDAO->getPostById($postId) ? true : false;
    }

    public static function checkPostByTitle($title) :bool
    {
        self::init();
        return self::$postDAO->getPostByTitle($title) ? true : false;
    }

    public static function checkModuleById($moduleId) :bool
    {
        self::init();
        return self::$moduleDAO->getModuleById($moduleId) ? true : false;
    }

    public static function checkModuleByName($moduleName) :bool
    {
        self::init();
        return self::$moduleDAO->getModuleByName($moduleName) ? true : false;
    }

}
?>