<?php
// index.php
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bohemia Logistics - Virtuální ETS2 logistika</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/modal.css">
    <?php
    // Dynamicky připojíme admin CSS jen pokud jsme v admin sekci
    if (strpos($_SERVER['REQUEST_URI'], '/admin') !== false || strpos($_SERVER['REQUEST_URI'], 'manage-employees') !== false) {
      echo '<link rel="stylesheet" href="/assets/css/admin.css">';
    }
  ?>
</head>
<body>

<?php 
// Bezpečné načítání header souboru
try {
    if (!safeInclude('includes/header.php')) {
        throw new Exception('Header soubor neexistuje.');
    }
} catch (Exception $e) {
    error_log('Chyba při načítání header: ' . $e->getMessage());
    http_response_code(500);
    echo '<h1>Chyba serveru</h1><p>Omlouváme se, došlo k chybě při načítání stránky.</p>';
    exit;
}
?>
    <div class="container">

<main class="hero">
    <section class="welcome">
        <h1>Vítejte u Bohemia Logistics</h1>
        <p>Spolehlivá virtuální logistika a přeprava po celé Evropě.</p>
        <a href="pages/about.php" class="btn">Zjistit víc</a>
    </section>

    <section class="quick-links">
        <h2>Rychlé odkazy</h2>
        <ul>
            <li><a href="pages/about.php">O nás</a></li>
            <li><a href="pages/contacts.php">Kontakty</a></li>
            <li><a href="pages/calendar.php">Kalendář konvojů</a></li>
            <li><a href="pages/gdpr.php">GDPR a cookies</a></li>
        </ul>
    </section>
</main>
    </div>
<?php 
// Bezpečné načítání footer souboru
if (!safeInclude('includes/footer.php')) {
    echo '<!-- Footer soubor nenalezen -->';
}
?>
<script src="assets/js/script.js"></script>
<script src="assets/js/cookies.js"></script>

</body>
</html>
