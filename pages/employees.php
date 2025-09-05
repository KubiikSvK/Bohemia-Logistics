<?php include '../includes/header.php'; ?>

<main class="employees-page">
    <div class="container">
        <h1>Zaměstnanci</h1>

        <!-- Vedení -->
        <section class="employee-category vedeni">
            <h2>Vedení</h2>
            <div class="employee-grid">
                <div class="employee-card" data-contact="Jméno 1 – Generální ředitel">
                    <img src="/assets/img/employees/1.jpg" alt="Jméno 1">
                    <h3>Jméno 1</h3>
                    <p>Generální ředitel</p>
                    <button class="contact-btn">Kontakt</button>
                </div>
                <div class="employee-card" data-contact="Jméno 2 – Provozní ředitel">
                    <img src="/assets/img/employees/2.jpg" alt="Jméno 2">
                    <h3>Jméno 2</h3>
                    <p>Provozní ředitel</p>
                    <button class="contact-btn">Kontakt</button>
                </div>
                <div class="employee-card" data-contact="Jméno 3 – Finanční ředitel">
                    <img src="/assets/img/employees/3.jpg" alt="Jméno 3">
                    <h3>Jméno 3</h3>
                    <p>Finanční ředitel</p>
                    <button class="contact-btn">Kontakt</button>
                </div>
            </div>
        </section>

        <!-- Řidiči -->
        <section class="employee-category ridici">
            <h2>Řidiči</h2>
            <div class="employee-grid">
                <div class="employee-card" data-contact="Řidič 1 – Senior driver">
                    <img src="/assets/img/employees/1.jpg" alt="Řidič 1">
                    <h3>Řidič 1</h3>
                    <p>Senior driver</p>
                    <button class="contact-btn">Kontakt</button>
                </div>
                <div class="employee-card" data-contact="Řidič 2 – Junior driver">
                    <img src="/assets/img/employees/2.jpg" alt="Řidič 2">
                    <h3>Řidič 2</h3>
                    <p>Junior driver</p>
                    <button class="contact-btn">Kontakt</button>
                </div>
                <div class="employee-card" data-contact="Řidič 3 – Long-haul driver">
                    <img src="/assets/img/employees/3.jpg" alt="Řidič 3">
                    <h3>Řidič 3</h3>
                    <p>Long-haul driver</p>
                    <button class="contact-btn">Kontakt</button>
                </div>
                <div class="employee-card" data-contact="Řidič 4 – City driver">
                    <img src="/assets/img/employees/1.jpg" alt="Řidič 4">
                    <h3>Řidič 4</h3>
                    <p>City driver</p>
                    <button class="contact-btn">Kontakt</button>
                </div>
            </div>
        </section>
    </div>
</main>

<?php include '../includes/modal.php'; ?>
<?php include '../includes/footer.php'; ?>
