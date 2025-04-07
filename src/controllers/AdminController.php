<?php
namespace src\controllers;

use src\utils\SessionManager;

class AdminController {

    public function showDashboard() {
        $user = SessionManager::get('user');

        if (!$user || !$user->getIsAdmin()) {
            header("Location: /forum/public/");
            exit();
        }

        $title = "Admin Dashboard";
        // ob_start();
        require_once __DIR__ . "/../views/admins/adminDashboard.html.php"; // Create this view
        // $content = ob_get_clean();
        // require_once __DIR__ . "/../views/layout.php";
    }
}
?>