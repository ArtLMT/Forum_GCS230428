<?php
namespace src\utils;

class SessionManager {
    public static function start() {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    public static function set($key, $value) {
        self::start();
        $_SESSION[$key] = $value;
    }

    public static function get($key) {
        self::start();
        return $_SESSION[$key] ?? null;
    }

    public static function getOnce($key) {
        self::start();
        $value = $_SESSION[$key] ?? null;
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]); // remove it after first access
        }
        return $value;
    }

    public static function remove($key) {
        self::start();
        unset($_SESSION[$key]);
    }

    public static function destroy() {
        self::start();
        session_unset();
        session_destroy();
    }

    public static function isAuthenticated() {
        self::start();
        return isset($_SESSION['user_id']);
    }
}
?>
