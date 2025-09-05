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
        <section class="main-contacts">
            <h2>Hlavní kontakty</h2>
            <div class="contacts-grid">
                <div class="contact-card">
                    <img src="/assets/img/employees/owner.jpg" alt="Majitel">
                    <h3>Jméno Majitele</h3>
                    <p>Majitel</p>
                    <button class="btn-contact" data-contact="mailto:owner@bohemialogistics.com">Kontaktovat</button>
                </div>
                <div class="contact-card">
                    <img src="/assets/img/employees/recruiter.jpg" alt="Náborář">
                    <h3>Jméno Náboráře</h3>
                    <p>Náborář</p>
                    <button class="btn-contact" data-contact="mailto:recruiter@bohemialogistics.com">Kontaktovat</button>
                </div>
            </div>
        </section>

    </div>

    <!-- Modal -->
    <?php include '../includes/modal.php'; ?>

</main>

<?php include '../includes/footer.php'; ?>
