<div class="admin-dashboard container">
  <h1>Administrace</h1>
  <p>Vítej, <?php echo $_SESSION['user']['name']; ?> 👋</p>

  <div class="admin-actions">
    <a href="/admin.php?page=manage" class="admin-btn">Správa zaměstnanců</a>
    <a href="/admin.php?page=gallery" class="admin-btn">Správa galerie</a>
    <a href="/admin.php?page=settings" class="admin-btn">Nastavení systému</a>
    <a href="/logout.php" class="admin-btn danger">Odhlásit se</a>
  </div>
</div>