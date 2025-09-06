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
    <style>
    .feature-card {
        background: #1b1b1b;
        padding: 20px;
        border-radius: 8px;
        border: 1px solid #333;
        text-align: center;
    }
    .feature-card h3 {
        color: #f5a623;
        margin-bottom: 10px;
    }
    .link-card {
        display: block;
        padding: 15px;
        background: #2a2a2a;
        color: #fff;
        text-decoration: none;
        border-radius: 6px;
        text-align: center;
        transition: background 0.3s ease;
    }
    .link-card:hover {
        background: #f5a623;
        color: #000;
    }
    </style>
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

<!-- Development Notice -->
<div style="background: #ff6b35; color: white; text-align: center; padding: 10px; font-weight: bold;">
    ⚠️ Stránky jsou stále ve vývoji - některé funkce mohou být nedokončené a ne všechny informace jsou aktuální ⚠️
</div>

<main class="hero">
    <section class="welcome">
        <?php 
        $wysiwygContent = loadWysiwygContent('index');
        if (!empty($wysiwygContent)) {
            echo $wysiwygContent;
        } else {
            // Default ETS2 company content
            echo '<h1>Bohemia Logistics</h1>';
            echo '<h2>Virtuální dopravní společnost pro Euro Truck Simulator 2</h2>';
            echo '<p>Přidejte se k naší komunitě nadšenců ETS2 a zažijte život truckera s přátelským kolektivem hráčů.</p>';
            echo '<div style="display: flex; gap: 15px; margin-top: 20px;">';
            echo '<a href="pages/about.php" class="btn">Zjistit víc</a>';
            echo '<a href="pages/join-us.php" class="btn" style="background: #28a745;">Přidat se</a>';
            echo '</div>';
        }
        ?>
    </section>

    <section class="features">
        <h2>Co u nás najdete</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-top: 20px;">
            <div class="feature-card">
                <h3>🚚 Multiplayer jízdy</h3>
                <p>Společné konvoje a koordinované přepravy po celé virtuální Evropě.</p>
            </div>
            <div class="feature-card">
                <h3>📊 Reálné statistiky</h3>
                <p>Sledování výkonu, dodržování rychlostních limitů a profesionální přístup.</p>
            </div>
            <div class="feature-card">
                <h3>💬 Komunitní Discord</h3>
                <p>Aktivní komunita, koordinace jízd a sdílení zážitků z cest.</p>
            </div>
            <div class="feature-card">
                <h3>🎨 Firemní design</h3>
                <p>Jednotný vizuál vozidel s firemními paint joby a profesionálním vzhledem.</p>
            </div>
        </div>
    </section>

    <section class="quick-links">
        <h2>Rychlé odkazy</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
            <a href="pages/about.php" class="link-card">O nás</a>
            <a href="pages/rules.php" class="link-card">Pravidla</a>
            <a href="pages/employees.php" class="link-card">Řidiči</a>
            <a href="pages/gallery.php" class="link-card">Galerie</a>
            <a href="pages/calendar.php" class="link-card">Kalendář</a>
            <a href="pages/join-us.php" class="link-card">Přidat se</a>
        </div>
    </section>
</main>
    </div>
<?php 
// Bezpečné načítání footer souboru
if (!safeInclude('includes/footer.php')) {
    echo '<!-- Footer soubor nenalezen -->';
}

// Přímé vložení cookies banneru
echo '<div id="cookieConsent" style="position: fixed !important; bottom: 0 !important; left: 0 !important; right: 0 !important; background: #1b1b1b !important; border-top: 3px solid #f5a623 !important; padding: 20px !important; z-index: 99999 !important; box-shadow: 0 -2px 10px rgba(0,0,0,0.3) !important; display: none !important;">';
echo '<div style="max-width: 1200px; margin: 0 auto; display: flex; align-items: center; justify-content: space-between; gap: 20px; flex-wrap: wrap;">';
echo '<div><h4 style="color: #f5a623; margin: 0 0 8px 0; font-size: 1.1em;">🍪 Používáme cookies</h4><p style="color: #eee; margin: 0; font-size: 0.9em; line-height: 1.4;">Tento web používá cookies pro zajištění základní funkčnosti a zlepšení vašeho zážitku. <a href="/pages/gdpr.php" style="color: #f5a623; text-decoration: none;">Více informací</a></p></div>';
echo '<div style="display: flex; gap: 10px; flex-shrink: 0;"><button id="acceptCookies" style="background: #28a745; color: white; border: none; padding: 10px 16px; border-radius: 4px; cursor: pointer; font-size: 0.9em; font-weight: 500;">Přijmout vše</button><button id="rejectCookies" style="background: #6c757d; color: white; border: none; padding: 10px 16px; border-radius: 4px; cursor: pointer; font-size: 0.9em; font-weight: 500;">Pouze nezbytné</button><a href="/pages/gdpr.php" style="background: #f5a623; color: #000; text-decoration: none; padding: 10px 16px; border-radius: 4px; font-size: 0.9em; font-weight: 500; display: inline-block;">GDPR</a></div>';
echo '</div></div>';
?>
<script src="/assets/js/script.js"></script>
<script src="/assets/js/cookies.js"></script>

</body>
</html>
