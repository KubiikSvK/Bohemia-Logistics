<?php include '../includes/header.php'; ?>

<main class="employees-page">
  <div class="container">
    <h1>Zaměstnanci</h1>

    <?php
    $employees = json_decode(file_get_contents("../includes/employees.json"), true);
    $vedeni = array_filter($employees, fn($e) => $e['category'] === 'vedeni');
    $ridici = array_filter($employees, fn($e) => $e['category'] === 'ridici');

    function renderEmployeeCard($e) {
      return '
        <div class="employee-card"
             data-name="' . htmlspecialchars($e['name']) . '"
             data-role="' . htmlspecialchars($e['role']) . '"
             data-img="' . htmlspecialchars($e['img']) . '"
             data-dc="' . htmlspecialchars($e['dc']) . '"
             data-steam="' . htmlspecialchars($e['steam']) . '"
             data-trucksbook="' . htmlspecialchars($e['trucksbook']) . '"
             data-email="' . htmlspecialchars($e['email']) . '">
          <img src="' . htmlspecialchars($e['img']) . '" alt="' . htmlspecialchars($e['name']) . '">
          <h3>' . htmlspecialchars($e['name']) . '</h3>
          <p>' . htmlspecialchars($e['role']) . '</p>
          <button class="contact-btn">Kontakt</button>
        </div>';
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

<script src="/assets/js/modal.js"></script>
<?php include '../includes/modal.php'; ?>
<?php include '../includes/footer.php'; ?>