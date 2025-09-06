<?php
require_once '../../config.php';
requireAdmin();

// Check if user is demo
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$adminUsers = loadAdminUsers();
$currentUser = null;
foreach ($adminUsers as $user) {
    if ($user['username'] === $_SESSION['admin']) {
        $currentUser = $user;
        break;
    }
}

if (!$currentUser || $currentUser['role'] !== 'demo') {
    header('Location: dashboard.php');
    exit;
}

include 'admin-header.php';
?>

<div class="admin-dashboard container" style="padding:40px;">
  <h1>Administrace</h1>
  <p>Vítej, <strong><?php echo htmlspecialchars($_SESSION['admin']); ?></strong> 👋</p>
  
  <div class="demo-notice" style="background: #ff6b35; color: white; padding: 15px; border-radius: 8px; margin: 20px 0; text-align: center;">
    <strong>⚠️ DEMO ÚČET</strong><br>
    Máte pouze oprávnění k prohlížení. Nelze provádět žádné změny.
  </div>

  <div class="admin-actions" style="margin-top:30px; display:flex; flex-direction:column; gap:15px;">
    <a href="manage-employees.php" class="admin-btn" style="padding:12px; background:#6c757d; color:white; text-decoration:none; border-radius:5px;">
      <i class="fas fa-eye"></i> Správa zaměstnanců (pouze prohlížení)
    </a>
    <a href="gallery.php" class="admin-btn" style="padding:12px; background:#6c757d; color:white; text-decoration:none; border-radius:5px;">
      <i class="fas fa-eye"></i> Správa galerie (pouze prohlížení)
    </a>
    <a href="wysiwyg-editor.php" class="admin-btn" style="padding:12px; background:#6c757d; color:white; text-decoration:none; border-radius:5px;">
      <i class="fas fa-eye"></i> Editor obsahu (pouze prohlížení)
    </a>
    <span class="admin-btn" style="padding:12px; background:#dc3545; color:white; border-radius:5px; cursor: not-allowed; opacity: 0.6;">
      <i class="fas fa-ban"></i> Nastavení systému (zakázáno)
    </span>
    <a href="logout.php" class="admin-btn danger" style="padding:12px; background:#dc3545; color:white; text-decoration:none; border-radius:5px;">
      <i class="fas fa-sign-out-alt"></i> Odhlásit se
    </a>
  </div>
</div>

<?php include 'admin-footer.php'; ?>