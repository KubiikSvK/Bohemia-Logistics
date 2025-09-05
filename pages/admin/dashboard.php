<?php include 'admin-header.php'; ?>

<?php
session_start();
if (!isset($_SESSION["admin"])) {
  header("Location: login.php");
  exit;
}
?>

<div class="admin-dashboard container" style="padding:40px;">
  <h1>Administrace</h1>
  <p>Vítej, <strong><?php echo htmlspecialchars($_SESSION['admin']); ?></strong> 👋</p>

  <div class="admin-actions" style="margin-top:30px; display:flex; flex-direction:column; gap:15px;">
    <a href="manage-employees.php" class="admin-btn" style="padding:12px; background:#007bff; color:white; text-decoration:none; border-radius:5px;">
      <i class="fas fa-users"></i> Správa zaměstnanců
    </a>
    <a href="gallery.php" class="admin-btn" style="padding:12px; background:#28a745; color:white; text-decoration:none; border-radius:5px;">
      <i class="fas fa-image"></i> Správa galerie
    </a>
    <a href="settings.php" class="admin-btn" style="padding:12px; background:#ffc107; color:black; text-decoration:none; border-radius:5px;">
      <i class="fas fa-cog"></i> Nastavení systému
    </a>
    <a href="logout.php" class="admin-btn danger" style="padding:12px; background:#dc3545; color:white; text-decoration:none; border-radius:5px;">
      <i class="fas fa-sign-out-alt"></i> Odhlásit se
    </a>
  </div>
</div>

<?php include 'admin-footer.php'; ?>