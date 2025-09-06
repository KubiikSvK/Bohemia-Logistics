<?php 
require_once '../../config.php';
requireAdmin();
include 'admin-header.php'; 
?>
<div class="admin-dashboard container">
  <h1>Nastavení přístupu</h1>

  <div class="form-section">
    <h2>Přehled adminů</h2>
    <?php
    $adminUsers = loadAdminUsers();
    if ($adminUsers && !empty($adminUsers)) {
    ?>
    <table class="employee-table">
      <thead>
        <tr>
          <th>Uživatelské jméno</th>
          <th>Email</th>
          <th>Role</th>
          <th>Akce</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($adminUsers as $index => $admin): ?>
        <tr>
          <td><?= htmlspecialchars($admin['username'], ENT_QUOTES, 'UTF-8') ?></td>
          <td><?= htmlspecialchars($admin['email'], ENT_QUOTES, 'UTF-8') ?></td>
          <td><?= htmlspecialchars($admin['role'], ENT_QUOTES, 'UTF-8') ?></td>
          <td>
            <form action="/actions/delete-admin.php" method="POST" style="display:inline;">
              <input type="hidden" name="csrf_token" value="<?= generateCSRFToken() ?>">
              <input type="hidden" name="index" value="<?= (int)$index ?>">
              <button type="submit" class="btn-delete" onclick="return confirm('Opravdu smazat admina?')">🗑️ Smazat</button>
            </form>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <?php 
    } else {
      echo '<p class="text-light">Žádní adminové nenalezeni.</p>';
    }
    ?>
  </div>

  <div class="form-section">
    <h2>Změna hesla</h2>
    <form method="post" action="/actions/change-password.php">
      <div class="form-group">
        <label class="form-label text-light">Staré heslo</label>
        <input type="password" name="old_password" required>
      </div>
      <div class="form-group">
        <label class="form-label text-light">Nové heslo</label>
        <input type="password" name="new_password" required>
      </div>
      <input type="submit" value="Změnit heslo">
    </form>
  </div>

  <div class="form-section">
    <h2>Přidat nového admina</h2>
    <form method="post" action="/actions/add-admin.php">
      <input type="hidden" name="csrf_token" value="<?= generateCSRFToken() ?>">
      <div class="form-group">
        <label class="form-label text-light">Jméno</label>
        <input type="text" name="name" required>
      </div>
      <div class="form-group">
        <label class="form-label text-light">Email</label>
        <input type="email" name="email" required>
      </div>
      <div class="form-group">
        <label class="form-label text-light">Heslo</label>
        <input type="password" name="password" required>
      </div>
      <div class="form-group">
        <label class="form-label text-light">Role</label>
        <select name="role" required>
          <option value="admin">Admin</option>
          <option value="editor">Editor</option>
          <option value="demo">Demo (pouze prohlížení)</option>
        </select>
      </div>
      <input type="submit" value="Vytvořit účet">
    </form>
  </div>
</div>
<?php include 'admin-footer.php'; ?>