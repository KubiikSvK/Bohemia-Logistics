<?php
session_start();
include 'includes/auth.php';

$page = $_GET['page'] ?? 'dashboard';

$allowedPages = [
  'dashboard',
  'manage',
  'add',
  'edit',
  'gallery',
  'settings'
];

if (!in_array($page, $allowedPages)) {
  $page = 'dashboard';
}

include 'includes/admin-header.php';
include "pages/admin/{$page}.php";
include 'includes/admin-footer.php';