<?php include '../../includes/auth.php'; ?>

<div class="admin-dashboard container">
  <h1>Nastavení přístupu</h1>

  <div class="form-section">
    <h2>Změna hesla</h2>
    <form method="post" action="/actions/change-password.php">
      <div class="form-group">
        <label class="form-label">Staré heslo</label>
        <input type="password" name="old_password" required>
      </div>
      <div class="form-group">
        <label class="form-label">Nové heslo</label>
        <input type="password" name="new_password" required>
      </div>
      <input type="submit" value="Změnit heslo">
    </form>
  </div>

  <div class="form-section">
    <h2>Přidat nového admina</h2>
    <form method="post" action="/actions/add-admin.php">
      <div class="form-group">
        <label class="form-label">Jméno</label>
        <input type="text" name="name" required>
      </div>
      <div class="form-group">
        <label class="form-label">Email</label>
        <input type="email" name="email" required>
      </div>
      <div class="form-group">
        <label class="form-label">Heslo</label>
        <input type="password" name="password" required>
      </div>
      <input type="submit" value="Vytvořit účet">
    </form>
  </div>
</div>