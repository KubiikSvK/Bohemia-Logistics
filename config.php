<?php
// config.php - Hlavní konfigurační soubor

// Bezpečnostní nastavení
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('session.cookie_httponly', 1);
// ini_set('session.cookie_secure', 1); // Vypnuto - vyžaduje HTTPS
ini_set('session.use_strict_mode', 1);
error_reporting(E_ALL);

// Prevent direct access
if (!defined('SECURE_ACCESS')) {
    define('SECURE_ACCESS', true);
}

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
    return substr($realPath, 0, strlen($basePath . DIRECTORY_SEPARATOR)) === $basePath . DIRECTORY_SEPARATOR || $realPath === $basePath;
}

// Bezpečné načítání souborů
function safeInclude($file) {
    // Whitelist povolených souborů
    $allowedFiles = [
        'includes/header.php',
        'includes/footer.php',
        'includes/cookies.php',
        'includes/modal.php'
    ];
    
    // Normalizace cesty
    $file = str_replace(['\\', '..'], '', $file);
    $file = ltrim($file, '/');
    
    if (!in_array($file, $allowedFiles, true)) {
        error_log("Pokus o načtení nepovolného souboru: " . htmlspecialchars($file, ENT_QUOTES, 'UTF-8'));
        return false;
    }
    
    $fullPath = BASE_PATH . '/' . $file;
    
    if (!validateFilePath($fullPath) || !file_exists($fullPath)) {
        error_log("Soubor neexistuje nebo není povolen: " . htmlspecialchars($file, ENT_QUOTES, 'UTF-8'));
        return false;
    }
    
    include $fullPath;
    return true;
}

// Bezpečné načítání JSON dat
function loadJsonData($filename) {
    // Whitelist povolených JSON souborů
    $allowedFiles = [
        'employees.json',
        'admin-users.json'
    ];
    
    // Sanitizace názvu souboru
    $filename = basename($filename);
    
    if (!in_array($filename, $allowedFiles, true)) {
        error_log("Pokus o načtení nepovolného JSON souboru: " . htmlspecialchars($filename, ENT_QUOTES, 'UTF-8'));
        return false;
    }
    
    $filePath = INCLUDES_PATH . '/' . $filename;
    
    if (!file_exists($filePath)) {
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
        $errorMsg = str_replace(["\r", "\n"], '', json_last_error_msg());
        error_log("Chyba při parsování JSON: " . htmlspecialchars($errorMsg, ENT_QUOTES, 'UTF-8'));
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
        try {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        } catch (Exception $e) {
            // Fallback token generation
            $_SESSION['csrf_token'] = bin2hex(openssl_random_pseudo_bytes(32));
        }
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
    return loadJsonData('admin-users.json');
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

// Load WYSIWYG content
function loadWysiwygContent($page) {
    // Whitelist allowed pages
    $allowedPages = ['index', 'about', 'rules'];
    
    if (!in_array($page, $allowedPages, true)) {
        return '';
    }
    
    $contentDir = BASE_PATH . '/includes/content/';
    $filePath = $contentDir . $page . '.json';
    
    if (!validateFilePath($filePath) || !file_exists($filePath)) {
        return '';
    }
    
    $jsonData = file_get_contents($filePath);
    if ($jsonData === false) {
        return '';
    }
    
    $data = json_decode($jsonData, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        return '';
    }
    
    return $data['content'] ?? '';
}
?>