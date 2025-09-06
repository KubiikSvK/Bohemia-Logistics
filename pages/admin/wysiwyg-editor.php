<?php 
require_once '../../config.php';
requireAdmin();
include 'admin-header.php'; 

$pages = [
    'index' => ['title' => 'Hlavní stránka', 'file' => 'content/index.json'],
    'about' => ['title' => 'O nás', 'file' => 'content/about.json'],
    'rules' => ['title' => 'Pravidla', 'file' => 'content/rules.json']
];

$currentPage = $_GET['page'] ?? 'index';
if (!isset($pages[$currentPage])) {
    $currentPage = 'index';
}

$contentDir = '/var/www/bml.vanekgroup.eu/includes/content/';
if (!is_dir($contentDir)) {
    mkdir($contentDir, 0755, true);
}

$filePath = $contentDir . basename($pages[$currentPage]['file']);
$content = '';

if (file_exists($filePath)) {
    $data = json_decode(file_get_contents($filePath), true);
    $content = $data['content'] ?? '';
} else {
    // Try to extract content from existing PHP files
    $phpFiles = [
        'index' => '/var/www/bml.vanekgroup.eu/index.php',
        'about' => '/var/www/bml.vanekgroup.eu/pages/about.php',
        'rules' => '/var/www/bml.vanekgroup.eu/pages/rules.php'
    ];
    
    if (isset($phpFiles[$currentPage]) && file_exists($phpFiles[$currentPage])) {
        $phpContent = file_get_contents($phpFiles[$currentPage]);
        
        // Different extraction patterns for different pages
        $patterns = [
            '/<main[^>]*>(.*?)<\/main>/s',
            '/<section class="welcome"[^>]*>(.*?)<\/section>/s',
            '/<div class="container"[^>]*>\s*<main[^>]*>(.*?)<\/main>\s*<\/div>/s',
            '/<div class="rules-content"[^>]*>(.*?)<\/div>/s'
        ];
        
        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $phpContent, $matches)) {
                $content = trim($matches[1]);
                break;
            }
        }
        
        // Clean up PHP includes and extra whitespace
        $content = preg_replace('/\s*<\?php[^>]*\?>\s*/', '', $content);
        $content = trim($content);
    }
    
    // Default content if nothing found
    if (empty($content)) {
        $defaultContent = [
            'index' => '<h1>Vítejte na našich stránkách</h1><p>Zde můžete upravit obsah hlavní stránky.</p>',
            'about' => '<h1>O nás</h1><p>Zde můžete napsat informace o vaší společnosti.</p>',
            'rules' => '<h1>Pravidla</h1><p>Zde můžete definovat pravidla pro vaši komunitu.</p>'
        ];
        $content = $defaultContent[$currentPage] ?? '';
    }
}
?>

<div class="admin-dashboard container">
  <h1>WYSIWYG Editor</h1>

  <div class="form-section">
    <div style="display: flex; gap: 10px; margin-bottom: 20px;">
      <?php foreach ($pages as $key => $page): ?>
      <a href="?page=<?= $key ?>" class="upload-mode-btn <?= $currentPage === $key ? 'active' : '' ?>">
        <?= htmlspecialchars($page['title']) ?>
      </a>
      <?php endforeach; ?>
    </div>

    <form action="/actions/save-wysiwyg.php" method="POST">
      <input type="hidden" name="csrf_token" value="<?= generateCSRFToken() ?>">
      <input type="hidden" name="page" value="<?= htmlspecialchars($currentPage) ?>">
      
      <div class="form-group">
        <label class="form-label text-light">Editace: <?= htmlspecialchars($pages[$currentPage]['title']) ?></label>
        
        <!-- Toolbar -->
        <div id="toolbar" style="background: #f8f9fa; padding: 10px; border: 1px solid #ddd; border-bottom: none; border-radius: 4px 4px 0 0;">
          <button type="button" onclick="formatText('bold')" style="margin: 2px; padding: 5px 10px;"><b>B</b></button>
          <button type="button" onclick="formatText('italic')" style="margin: 2px; padding: 5px 10px;"><i>I</i></button>
          <button type="button" onclick="formatText('underline')" style="margin: 2px; padding: 5px 10px;"><u>U</u></button>
          <button type="button" onclick="formatText('insertUnorderedList')" style="margin: 2px; padding: 5px 10px;">• List</button>
          <button type="button" onclick="formatText('insertOrderedList')" style="margin: 2px; padding: 5px 10px;">1. List</button>
          <button type="button" onclick="formatText('justifyLeft')" style="margin: 2px; padding: 5px 10px;">←</button>
          <button type="button" onclick="formatText('justifyCenter')" style="margin: 2px; padding: 5px 10px;">↔</button>
          <button type="button" onclick="formatText('justifyRight')" style="margin: 2px; padding: 5px 10px;">→</button>
        </div>
        
        <!-- Editor -->
        <div id="wysiwygEditor" contenteditable="true" style="min-height: 400px; padding: 15px; border: 1px solid #ddd; border-radius: 0 0 4px 4px; background: white; color: black; font-family: Arial, sans-serif; line-height: 1.5;"><?= $content ?></div>
        
        <!-- Hidden textarea for form submission -->
        <textarea name="content" id="hiddenContent" style="display: none;"></textarea>
      </div>
      
      <div style="display: flex; gap: 10px; margin-top: 20px;">
        <input type="submit" value="Uložit změny" style="background: #28a745;">
        <button type="button" onclick="location.reload()" style="background: #6c757d;">Zrušit</button>
      </div>
    </form>
  </div>
</div>

<script>
function formatText(command) {
  document.execCommand(command, false, null);
  document.getElementById('wysiwygEditor').focus();
}

// Update hidden textarea before form submission
document.querySelector('form').addEventListener('submit', function() {
  const editorContent = document.getElementById('wysiwygEditor').innerHTML;
  document.getElementById('hiddenContent').value = editorContent;
});

// Initialize hidden content with current editor content
document.addEventListener('DOMContentLoaded', function() {
  const editor = document.getElementById('wysiwygEditor');
  const hiddenContent = document.getElementById('hiddenContent');
  
  // Set initial value
  hiddenContent.value = editor.innerHTML;
  
  // Auto-save content to hidden textarea
  editor.addEventListener('input', function() {
    hiddenContent.value = this.innerHTML;
  });
});
</script>

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
</style>

<?php include 'admin-footer.php'; ?>