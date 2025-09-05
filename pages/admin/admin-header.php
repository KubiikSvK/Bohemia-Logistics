<?php
include 'auth.php';
?>

<!DOCTYPE html>
<html lang="cs">
<head>
  <meta charset="UTF-8">
  <title>Admin | Bohemia Logistics</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="/assets/css/style.css">
  <link rel="stylesheet" href="/assets/css/admin.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<header class="admin-header" style="background:#003366; color:white; padding:15px 30px; display:flex; align-items:center; justify-content:space-between;">
  <div class="logo-area" style="display:flex; align-items:center; gap:15px;">
    <a href="/pages/admin/dashboard.php" class="logo" style="color:white; font-size:1.5em; font-weight:bold; text-decoration:none;">
      <i class="fas fa-warehouse"></i> Bohemia Admin
    </a>
    <nav class="admin-nav" style="display:flex; gap:20px;">
      <a href="/pages/admin/dashboard.php" style="color:white; text-decoration:none;"><i class="fas fa-home"></i> Dashboard</a>
      <a href="/pages/admin/manage-employees.php" style="color:white; text-decoration:none;"><i class="fas fa-users"></i> Zaměstnanci</a>
      <a href="/pages/admin/gallery.php" style="color:white; text-decoration:none;"><i class="fas fa-image"></i> Galerie</a>
      <a href="/pages/admin/settings.php" style="color:white; text-decoration:none;"><i class="fas fa-cog"></i> Nastavení</a>
    </nav>
  </div>
  <div class="admin-user" style="font-size:0.9em;">
    <span><i class="fas fa-user-shield"></i> <?php echo $_SESSION["admin"]; ?></span>
    <a href="/pages/admin/logout.php" style="color:#ffcc00; margin-left:15px; text-decoration:none;"><i class="fas fa-sign-out-alt"></i> Odhlásit</a>
  </div>
</header>