<?php
require_once '../../config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Vymazání session dat
$_SESSION = [];

// Zničení session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Zničení session
session_destroy();

// Přesměrování na login
header('Location: login.php');
exit;
?>