<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: /pages/admin/login.php");
  exit;
}

$index = $_POST['index'] ?? null;
$path = $_SERVER['DOCUMENT_ROOT'] . '/includes/employees.json';
$employees = json_decode(file_get_contents($path), true);

if (!is_numeric($index) || !isset($employees[$index])) {
  die("Neplatný index zaměstnance.");
}

// Aktualizace dat
$employees[$index]['name'] = $_POST['name'] ?? '';
$employees[$index]['role'] = $_POST['role'] ?? '';
$employees[$index]['email'] = $_POST['email'] ?? '';
$employees[$index]['dc'] = $_POST['dc'] ?? '';
$employees[$index]['steam'] = $_POST['steam'] ?? '';
$employees[$index]['trucksbook'] = $_POST['trucksbook'] ?? '';
$employees[$index]['category'] = $_POST['category'] ?? 'ridici';

// Upload nové fotky
if (isset($_FILES['new_img']) && $_FILES['new_img']['error'] === UPLOAD_ERR_OK) {
  $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
  if (in_array($_FILES['new_img']['type'], $allowedTypes)) {
    // Smazat starou fotku pokud existuje
    $oldImg = $employees[$index]['img'] ?? '';
    if (!empty($oldImg) && strpos($oldImg, '/assets/img/employees/') === 0) {
      $oldImgPath = $_SERVER['DOCUMENT_ROOT'] . $oldImg;
      if (file_exists($oldImgPath)) {
        unlink($oldImgPath);
      }
    }
    
    $ext = pathinfo($_FILES['new_img']['name'], PATHINFO_EXTENSION);
    $filename = 'employee_' . $index . '.' . $ext;
    $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/assets/img/employees/';
    $targetPath = $uploadDir . $filename;

    if (move_uploaded_file($_FILES['new_img']['tmp_name'], $targetPath)) {
      $employees[$index]['img'] = '/assets/img/employees/' . $filename;
    }
  }
}

// Uložení zpět do JSON
file_put_contents($path, json_encode($employees, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

// Přesměrování
header("Location: /pages/admin/manage-employees.php?updated=1");
exit;