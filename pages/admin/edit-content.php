<?php
include 'auth.php';

$allowed = [
  'rules' => '../../pages/rules.php',
  'join-us' => '../../pages/join-us.php',
  'gdpr' => '../../pages/gdpr.php',
  'about' => '../../pages/about.php',
  'index' => '../../index.php'
];

$fileKey = $_GET['file'] ?? '';
if (!array_key_exists($fileKey, $allowed)) {
  die("Neplatný soubor.");
}

$path = $allowed[$fileKey];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Volitelná záloha
  $backupPath = $path . '.bak_' . date('Ymd_His');
  copy($path, $backupPath);

  // Uložení nového obsahu
  file_put_contents($path, $_POST["content"]);
  $message = "Soubor <strong>$fileKey.php</strong> byl úspěšně uložen.";
}

$content = file_exists($path) ? file_get_contents($path) : '';
?>

<?php include 'admin-header.php'; ?>

<h2>Úprava souboru: <?php echo htmlspecialchars($fileKey); ?>.php</h2>

<?php if (isset($message)) echo "<p style='color:green;'>$message</p>"; ?>

<form method="post">
  <textarea name="content" id="editor"><?php echo htmlspecialchars($content); ?></textarea>
  <button type="submit">Uložit změny</button>
</form>

<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
  tinymce.init({
    selector: '#editor',
    height: 600,
    menubar: false,
    plugins: 'code link image lists',
    toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright | bullist numlist | link image | code',
    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
  });
</script>

<?php include 'admin-footer.php'; ?>