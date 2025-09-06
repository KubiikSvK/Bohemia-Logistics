<?php 
require_once '../../config.php';
requireAdmin();
include 'admin-header.php'; 

$pages = [
    'index' => ['title' => 'Hlavní stránka', 'file' => 'pages/index.php'],
    'about' => ['title' => 'O nás', 'file' => 'pages/about.php'],
    'rules' => ['title' => 'Pravidla', 'file' => 'pages/rules.php']
];

$currentPage = $_GET['page'] ?? 'index';
if (!isset($pages[$currentPage])) {
    $currentPage = 'index';
}

$filePath = '/var/www/bml.vanekgroup.eu/' . $pages[$currentPage]['file'];
$content = '';

if (file_exists($filePath)) {
    $content = file_get_contents($filePath);
} else {
    // Create rules.php if it doesn't exist
    if ($currentPage === 'rules') {
        $content = '<?php include \'../includes/header.php\'; ?>

<main class="rules-page">
  <div class="container">
    <h1>Pravidla</h1>
    <div class="rules-content">
      <p>Zde budou pravidla...</p>
    </div>
  </div>
</main>

<?php include \'../includes/footer.php\'; ?>';
    }
}
?>

<div class="admin-dashboard container">
  <h1>Editor obsahu</h1>

  <div class="form-section">
    <div style="display: flex; gap: 10px; margin-bottom: 20px;">
      <?php foreach ($pages as $key => $page): ?>
      <a href="?page=<?= $key ?>" class="upload-mode-btn <?= $currentPage === $key ? 'active' : '' ?>">
        <?= htmlspecialchars($page['title']) ?>
      </a>
      <?php endforeach; ?>
    </div>

    <form action="/actions/save-content.php" method="POST">
      <input type="hidden" name="csrf_token" value="<?= generateCSRFToken() ?>">
      <input type="hidden" name="page" value="<?= htmlspecialchars($currentPage) ?>">
      
      <div class="form-group">
        <label class="form-label text-light">Editace: <?= htmlspecialchars($pages[$currentPage]['title']) ?></label>
        <textarea name="content" id="contentEditor" rows="25" style="font-family: 'Courier New', monospace; font-size: 14px;"><?= htmlspecialchars($content) ?></textarea>
      </div>
      
      <div style="display: flex; gap: 10px;">
        <input type="submit" value="Uložit změny" style="background: #28a745;">
        <button type="button" onclick="location.reload()" style="background: #6c757d;">Zrušit</button>
      </div>
    </form>
  </div>

  <div class="form-section">
    <h2>Nápověda</h2>
    <div class="text-light" style="font-size: 0.9em;">
      <p><strong>Tipy pro editaci:</strong></p>
      <ul>
        <li>Zachovejte PHP tagy <?php ?> na začátku a konci</li>
        <li>Pro HTML použijte standardní tagy</li>
        <li>Nezapomeňte na include header.php a footer.php</li>
        <li>Pro styling použijte existující CSS třídy</li>
      </ul>
    </div>
  </div>
</div>

<style>
.upload-mode-btn {
  padding: 8px 16px;
  border: 2px solid #333;
  background: #1f1f1f;
  color: #fff;
  border-radius: 4px;
  cursor: pointer;
  text-decoration: none;
  transition: all 0.3s ease;
}

.upload-mode-btn.active {
  background: #ffc107;
  color: #000;
  border-color: #ffc107;
}

.upload-mode-btn:hover {
  border-color: #555;
}

#contentEditor {
  width: 100%;
  min-height: 500px;
  padding: 15px;
  border-radius: 6px;
  border: 2px solid #333;
  background-color: #1f1f1f;
  color: #fff;
  font-family: 'Courier New', monospace;
  font-size: 14px;
  line-height: 1.4;
  resize: vertical;
}

#contentEditor:focus {
  outline: none;
  border-color: #f5a623;
  box-shadow: 0 0 0 3px rgba(245, 166, 35, 0.2);
}
</style>

<?php include 'admin-footer.php'; ?>