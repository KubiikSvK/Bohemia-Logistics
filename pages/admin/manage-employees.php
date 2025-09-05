<?php include '../../includes/auth.php'; ?>
<?php include 'admin-header.php'; ?>
<head>
  <title>Správa zaměstnanců - Bohemia Logistics</title>
  <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
  <div class="container">
    <h1>Správa zaměstnanců</h1>

<?php
$employees = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/includes/employees.json'), true);
?>

<div class="admin-header">
  <a href="/pages/add-employee.php" class="btn-add">➕ Přidat zaměstnance</a>
</div>
<table class="employee-table">
  <thead>
    <tr>
      <th>Foto</th>
      <th>Jméno</th>
      <th>Funkce</th>
      <th>Kontakty</th>
      <th>Akce</th>
    </tr>
  </thead>
  <tbody>
    <?php if (is_array($employees)) {
  foreach ($employees as $index => $e) {
    // render řádku
  }
} else {
  echo "<p>Žádní zaměstnanci zatím nejsou přidáni.</p>";
}
foreach ($employees as $index => $e): ?>
      <tr>
        <td><img src="<?= $e['img'] ?>" alt="<?= $e['name'] ?>" class="admin-avatar"></td>
        <td><?= $e['name'] ?></td>
        <td><?= $e['role'] ?></td>
        <td>
          <?= $e['dc'] ? "<a href='{$e['dc']}' target='_blank'>Discord</a><br>" : "" ?>
          <?= $e['steam'] ? "<a href='{$e['steam']}' target='_blank'>Steam</a><br>" : "" ?>
          <?= $e['trucksbook'] ? "<a href='{$e['trucksbook']}' target='_blank'>TrucksBook</a><br>" : "" ?>
          <?= $e['email'] ? "<a href='mailto:{$e['email']}'>Email</a>" : "" ?>
        </td>
        <td>
          <a href="/pages/admin/edit-employee.php?index=<?= $index ?>" class="btn-edit">✏️ Editovat</a>
          <form action="/actions/delete-employee.php" method="POST" style="display:inline;">
            <input type="hidden" name="index" value="<?= $index ?>">
            <button type="submit" class="btn-delete">🗑️ Smazat</button>
          </form>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
  </div>
</body>
<?php include 'admin-footer.php'; ?>