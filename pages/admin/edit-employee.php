<?php
include '../../includes/auth.php';
include 'admin-header.php';

$index = $_GET['index'] ?? null;
$path = $_SERVER['DOCUMENT_ROOT'] . '/includes/employees.json';
$employees = json_decode(file_get_contents($path), true);

if (!is_numeric($index) || !isset($employees[$index])) {
  echo "<p style='color:red;'>Zaměstnanec nenalezen.</p>";
  include 'admin-footer.php';
  exit;
}

$e = $employees[$index];
?>

<div class="container">
  <h1>Editace zaměstnance</h1>

  <form method="post" action="/pages/admin/update-employee.php" enctype="multipart/form-data">
    <input type="hidden" name="index" value="<?= $index ?>">

    <div class="form-group">
        <label class="form-label">Aktuální foto</label><br>
        <img src="<?= htmlspecialchars($e['img']) ?>" alt="Foto" style="max-width:150px; border-radius:6px;">
    </div>

    <div class="form-group">
      <label class="form-label">Jméno</label>
      <input type="text" name="name" value="<?= htmlspecialchars($e['name']) ?>" required>
    </div>

    <div class="form-group">
      <label class="form-label">Funkce</label>
      <input type="text" name="role" value="<?= htmlspecialchars($e['role']) ?>" required>
    </div>

    <div class="form-group">
        <label class="form-label">Kategorie</label>
        <select name="category" required>
            <option value="vedeni" <?= $e['category'] === 'vedeni' ? 'selected' : '' ?>>Vedení</option>
            <option value="ridici" <?= $e['category'] === 'ridici' ? 'selected' : '' ?>>Řidiči</option>
        </select>
    </div>

    <div class="form-group">
      <label class="form-label">Email</label>
      <input type="email" name="email" value="<?= htmlspecialchars($e['email']) ?>">
    </div>

    <div class="form-group">
      <label class="form-label">Discord ID</label>
      <input type="text" name="dc" value="<?= htmlspecialchars($e['dc']) ?>">
    </div>

    <div class="form-group">
      <label class="form-label">Steam</label>
      <input type="text" name="steam" value="<?= htmlspecialchars($e['steam']) ?>">
    </div>

    <div class="form-group">
      <label class="form-label">TrucksBook</label>
      <input type="text" name="trucksbook" value="<?= htmlspecialchars($e['trucksbook']) ?>">
    </div>

    <div class="form-group">
      <label class="form-label">Foto (URL)</label>
      <input type="text" name="img" value="<?= htmlspecialchars($e['img']) ?>">
    </div>

    <div class="form-group">
        <label class="form-label">Nové foto (soubor)</label>
        <input type="file" name="new_img" accept="image/*">
    </div>

    <input type="submit" value="💾 Uložit změny">
  </form>
</div>

<?php include 'admin-footer.php'; ?>