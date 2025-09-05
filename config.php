<?php
// config.php - Hlavní konfigurační soubor

// Bezpečnostní nastavení
ini_set('display_errors', 0);
ini_set('log_errors', 1);
error_reporting(E_ALL);

// Definice konstant
define('BASE_PATH', __DIR__);
define('INCLUDES_PATH', BASE_PATH . '/includes');
define('PAGES_PATH', BASE_PATH . '/pages');
define('ASSETS_PATH', BASE_PATH . '/assets');

// Bezpečnostní funkce pro validaci souborů
function validateFilePath($path) {
    $realPath = realpath($path);
    $basePath = realpath(BASE_PATH);
    
    if ($realPath === false || $basePath === false) {
        return false;
    }
    
    // Bezpečnější kontrola s DIRECTORY_SEPARATOR
    return str_starts_with($realPath, $basePath . DIRECTORY_SEPARATOR) || $realPath === $basePath;
}

// Bezpečné načítání souborů
function safeInclude($file) {
    // Sanitizace vstupu
    $file = filter_var($file, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
    $fullPath = BASE_PATH . '/' . ltrim($file, '/');
    
    if (!validateFilePath($fullPath) || !file_exists($fullPath)) {
        error_log("Pokus o načtení neexistujícího nebo nebezpečného souboru: " . htmlspecialchars($file, ENT_QUOTES, 'UTF-8'));
        return false;
    }
    
    include $fullPath;
    return true;
}

// Bezpečné načítání JSON dat
function loadJsonData($filename) {
    // Sanitizace názvu souboru
    $filename = basename($filename);
    $filePath = INCLUDES_PATH . '/' . $filename;
    
    if (!validateFilePath($filePath) || !file_exists($filePath)) {
        error_log("JSON soubor neexistuje: " . htmlspecialchars($filename, ENT_QUOTES, 'UTF-8'));
        return false;
    }
    
    $jsonData = file_get_contents($filePath);
    if ($jsonData === false) {
        error_log("Nelze načíst JSON soubor: " . htmlspecialchars($filename, ENT_QUOTES, 'UTF-8'));
        return false;
    }
    
    $data = json_decode($jsonData, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        error_log("Chyba při parsování JSON: " . htmlspecialchars(json_last_error_msg(), ENT_QUOTES, 'UTF-8'));
        return false;
    }
    
    return $data;
}

// XSS ochrana
function sanitizeOutput($data) {
    if (is_array($data)) {
        return array_map('sanitizeOutput', $data);
    }
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}

// CSRF ochrana
function generateCSRFToken() {
    // Zajistíme, že session je spuštěna
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function validateCSRFToken($token) {
    // Zajistíme, že session je spuštěna
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

// Admin funkce
function loadAdminUsers() {
    $filename = 'admin-users.json';
    $filePath = BASE_PATH . '/pages/admin/includes/' . $filename;
    
    if (!validateFilePath($filePath) || !file_exists($filePath)) {
        error_log("Admin users soubor neexistuje: " . htmlspecialchars($filename, ENT_QUOTES, 'UTF-8'));
        return false;
    }
    
    $jsonData = file_get_contents($filePath);
    if ($jsonData === false) {
        error_log("Nelze načíst admin users soubor: " . htmlspecialchars($filename, ENT_QUOTES, 'UTF-8'));
        return false;
    }
    
    $data = json_decode($jsonData, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        error_log("Chyba při parsování admin users JSON: " . htmlspecialchars(json_last_error_msg(), ENT_QUOTES, 'UTF-8'));
        return false;
    }
    
    return $data;
}

function isAdminLoggedIn() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    return isset($_SESSION['admin']) && !empty($_SESSION['admin']);
}

function requireAdmin() {
    if (!isAdminLoggedIn()) {
        header('Location: /pages/admin/login.php');
        exit;
    }
}
?>