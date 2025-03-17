<?php
session_start();
session_destroy();  // Destroy the session
header("Location: loginForm.html.php");  // Redirect back to login page
exit();
?>
