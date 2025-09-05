<?php include '../includes/header.php'; ?>
<?php include '../includes/modal.php'; ?>

<main class="employees-page">
  <div class="container">
    <h1>Zaměstnanci</h1>

    <?php
    $employees = json_decode(file_get_contents(__DIR__ . '/../includes/employees.json'), true);
    $vedeni = array_filter($employees, fn($e) => $e['category'] === 'vedeni');
    $ridici = array_filter($employees, fn($e) => $e['category'] === 'ridici');

    function renderEmployeeCard($e) {
      $name = htmlspecialchars($e['name']);
      $role = htmlspecialchars($e['role']);
      $img = htmlspecialchars($e['img']);
      $email = htmlspecialchars($e['email']);
      $dcRaw = htmlspecialchars($e['dc']);
        $dcClean = preg_replace('/^https:\/\/discord\.com\/users\//', '', $dcRaw);
      $steam = htmlspecialchars($e['steam']);
      $tb = htmlspecialchars($e['trucksbook']);

      return <<<HTML
        <div class="employee-card">
          <img src="$img" alt="$role" class="employee-img">
          <h3>$name</h3>
          <p>$role</p>
          <button class="contact-btn"
            data-name="$name"
            data-role="$role"
            data-img="$img"
            data-email="$email"
            data-dc="$dcClean"
            data-steam="$steam"
            data-trucksbook="$tb">
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
        <?php foreach ($vedeni as $e) echo renderEmployeeCard($e); ?>
      </div>
    </section>

    <!-- Řidiči -->
    <section class="employee-category ridici">
      <h2>Řidiči</h2>
      <div class="drivers-grid">
        <?php foreach ($ridici as $e) echo renderEmployeeCard($e); ?>
      </div>
    </section>
  </div>
</main>

<?php include '../includes/footer.php'; ?>
<script src="/assets/js/modal.js"></script>