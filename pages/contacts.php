<?php include '../includes/header.php'; ?>

<main class="contacts-page">
  <div class="container">
    <h1>Kontakty</h1>

    <!-- Kontaktní formulář -->
    <section class="contact-form-section">
      <h2>Napiš nám</h2>
      <form action="/pages/send-contact.php" method="post" class="contact-form">
        <input type="text" name="name" placeholder="Tvé jméno" required>
        <input type="email" name="email" placeholder="Tvůj email" required>
        <textarea name="message" placeholder="Tvoje zpráva" rows="5" required></textarea>
        <button type="submit">Odeslat</button>
      </form>
    </section>

    <!-- Externí odkazy -->
    <section class="external-links">
      <h2>Externí odkazy</h2>
      <div class="links-grid">
        <a href="https://discord.gg/tvoje-server-link" target="_blank" class="link-card">
          <img src="/assets/img/icons/dc.png" alt="Discord">
          <span>Discord</span>
        </a>
        <a href="https://trucksbook.eu/company/213447" target="_blank" class="link-card">
          <img src="/assets/img/icons/tb.png" alt="TrucksBook">
          <span>TrucksBook</span>
        </a>
      </div>
    </section>

    <!-- Karty hlavních osob -->
    <?php
    $contacts = json_decode(file_get_contents(__DIR__ . '/../includes/employees.json'), true);

    // Vyber jen Majitele a Náboráře
    $filtered = array_filter($contacts, function ($person) {
      return in_array($person['role'] ?? '', ['Majitel', 'Náborář']);
    });
    ?>

    <section class="main-contacts">
      <h2>Hlavní kontakty</h2>
      <div class="contacts-grid">
        <?php foreach ($filtered as $person): ?>
          <div class="contact-card">
            <?php if (!empty($person['img'])): ?>
              <img src="<?php echo htmlspecialchars($person['img']); ?>" alt="<?php echo htmlspecialchars($person['role'] ?? ''); ?>">
            <?php endif; ?>
            <h3><?php echo htmlspecialchars($person['name'] ?? ''); ?></h3>
            <p><?php echo htmlspecialchars($person['role'] ?? ''); ?></p>
            <button class="contact-btn"
              data-dc="<?php echo htmlspecialchars($person['dc'] ?? ''); ?>"
              data-steam="<?php echo htmlspecialchars($person['steam'] ?? ''); ?>"
              data-trucksbook="<?php echo htmlspecialchars($person['trucksbook'] ?? ''); ?>"
              data-email="<?php echo htmlspecialchars($person['email'] ?? ''); ?>">
                Kontaktovat
            </button>
          </div>
        <?php endforeach; ?>
      </div>
    </section>

  </div>

  <!-- Modal -->
  <?php include '../includes/modal.php'; ?>
</main>

<?php include '../includes/footer.php'; ?>
<script src="/assets/js/modal.js"></script>