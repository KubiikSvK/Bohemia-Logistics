<?php 
// Načtení konfiguračního souboru
require_once '../config.php';

// Bezpečné načítání souborů
try {
    if (!safeInclude('includes/header.php') || !safeInclude('includes/modal.php')) {
        throw new Exception('Požadované soubory neexistují.');
    }
} catch (Exception $e) {
    error_log('Chyba při načítání souborů: ' . $e->getMessage());
    http_response_code(500);
    echo '<h1>Chyba serveru</h1><p>Omlouváme se, došlo k chybě při načítání stránky.</p>';
    exit;
}
?>

<main class="employees-page">
  <div class="container">
    <h1>Zaměstnanci</h1>

    <?php
    // Bezpečné načítání JSON dat
    try {
        $employees = loadJsonData('employees.json');
        if ($employees === false) {
            throw new Exception('Nelze načíst data zaměstnanců.');
        }
        
        // Optimalizované filtrování - jeden průchod místo dvou
        $vedeni = [];
        $ridici = [];
        
        foreach ($employees as $employee) {
            if (!isset($employee['category'])) continue;
            
            switch ($employee['category']) {
                case 'vedeni':
                    $vedeni[] = $employee;
                    break;
                case 'ridici':
                    $ridici[] = $employee;
                    break;
            }
        }
    } catch (Exception $e) {
        error_log('Chyba při načítání zaměstnanců: ' . $e->getMessage());
        echo '<div class="error-message">Omlouváme se, data zaměstnanců nejsou momentálně dostupná.</div>';
        $vedeni = $ridici = [];
    }

    function renderEmployeeCard($e) {
        // Validace povinných polí
        $requiredFields = ['name', 'role', 'img', 'email', 'dc', 'steam', 'trucksbook'];
        foreach ($requiredFields as $field) {
            if (!isset($e[$field])) {
                return '<div class="employee-card error">Chyba: Neúplná data zaměstnance</div>';
            }
        }
        
        // Bezpečné escapování všech dat pomocí konfigurační funkce
        $sanitized = sanitizeOutput($e);
        $name = $sanitized['name'];
        $role = $sanitized['role'];
        $img = $sanitized['img'];
        $email = $sanitized['email'];
        $dcRaw = $sanitized['dc'];
        // Pokud je to číselné ID, necháme ho tak
        $dcClean = preg_match('/^\d+$/', $dcRaw) ? $dcRaw : preg_replace('/^https:\/\/discord\.com\/users\//', '', $dcRaw);
        if ($dcClean === null) {
            $dcClean = $dcRaw;
        }
        $steam = $sanitized['steam'];
        $tb = $sanitized['trucksbook'];

        return <<<HTML
        <div class="employee-card">
          <img src="{$img}" alt="{$role}" class="employee-img">
          <h3>{$name}</h3>
          <p>{$role}</p>
          <button class="contact-btn"
            data-name="{$name}"
            data-role="{$role}"
            data-img="{$img}"
            data-email="{$email}"
            data-dc="{$dcClean}"
            data-steam="{$steam}"
            data-trucksbook="{$tb}">
            Kontaktovat
          </button>
        </div>
        HTML;
    }
    ?>

    <!-- Vedení -->
    <section class="employee-category vedeni">
      <h2>Vedení</h2>
      <div class="management-grid">
        <?php 
        if (!empty($vedeni)) {
            foreach ($vedeni as $e) {
                echo renderEmployeeCard($e);
            }
        } else {
            echo '<p>Žádní zaměstnanci ve vedení.</p>';
        }
        ?>
      </div>
    </section>

    <!-- Řidiči -->
    <section class="employee-category ridici">
      <h2>Řidiči</h2>
      <div class="drivers-grid">
        <?php 
        if (!empty($ridici)) {
            foreach ($ridici as $e) {
                echo renderEmployeeCard($e);
            }
        } else {
            echo '<p>Žádní řidiči.</p>';
        }
        ?>
      </div>
    </section>
  </div>
</main>

<?php 
// Bezpečné načítání footer
safeInclude('includes/footer.php');
?>
<script src="/assets/js/modal.js"></script>