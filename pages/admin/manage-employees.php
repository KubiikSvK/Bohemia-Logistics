<?php 
require_once '../../config.php';
requireAdmin();
?>
<?php include 'admin-header.php'; ?>
<head>
  <title>Správa zaměstnanců - Bohemia Logistics</title>
  <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
  <div class="container">
    <h1>Správa zaměstnanců</h1>

<?php
$employees = loadJsonData('employees.json');
if ($employees === false) {
    $employees = [];
}
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
    <?php if (empty($employees)): ?>
      <tr><td colspan="5">Žádní zaměstnanci zatím nejsou přidáni.</td></tr>
    <?php else: ?>
    <?php foreach ($employees as $index => $e): 
        $safe = sanitizeOutput($e);
    ?>
      <tr>
        <td><img src="<?= $safe['img'] ?>" alt="<?= $safe['name'] ?>" class="admin-avatar"></td>
        <td><?= $safe['name'] ?></td>
        <td><?= $safe['role'] ?></td>
        <td>
          <?= !empty($safe['dc']) ? "<a href='" . (preg_match('/^\d+$/', $safe['dc']) ? 'https://discord.com/users/' . $safe['dc'] : $safe['dc']) . "' target='_blank' rel='noopener noreferrer'>Discord</a><br>" : "" ?>
          <?= !empty($safe['steam']) ? "<a href='{$safe['steam']}' target='_blank' rel='noopener noreferrer'>Steam</a><br>" : "" ?>
          <?= !empty($safe['trucksbook']) ? "<a href='{$safe['trucksbook']}' target='_blank' rel='noopener noreferrer'>TrucksBook</a><br>" : "" ?>
          <?= !empty($safe['email']) ? "<a href='mailto:{$safe['email']}'>Email</a>" : "" ?>
        </td>
        <td>
          <a href="/pages/admin/edit-employee.php?index=<?= (int)$index ?>" class="btn-edit">✏️ Editovat</a>
          <form action="/actions/delete-employee.php" method="POST" style="display:inline;">
            <input type="hidden" name="csrf_token" value="<?= generateCSRFToken() ?>">
            <input type="hidden" name="index" value="<?= (int)$index ?>">
            <button type="submit" class="btn-delete" onclick="return confirm('Opravdu smazat?')">🗑️ Smazat</button>
          </form>
        </td>
      </tr>
    <?php endforeach; ?>
    <?php endif; ?>
  </tbody>
</table>
  </div>
</body>
<?php include 'admin-footer.php'; ?>