<footer class="footer">
    <div class="footer-container">
        <div class="footer-left">
            <h3><a href="/index.php" class="logo">Bohemia <span>Logistics</span></a></h3>
            <p>&copy; <?= date('Y') ?> Bohemia Logistics. Všechna práva vyhrazena.</p>
        </div>
        <div class="footer-center">
            <h4>Rychlé odkazy</h4>
            <nav class="footer-nav">
                <a href="/pages/about.php">O nás</a>
                <a href="/pages/contacts.php">Kontakty</a>
                <a href="/pages/gdpr.php">GDPR</a>
                <a href="/pages/admin/login.php" style="color: #666; font-size: 0.9em;">⚙️ Admin</a>
            </nav>
        </div>
        <div class="footer-right">
            <h4>Sledujte nás</h4>
            <div class="social-links">
                <a href="https://discord.com" target="_blank" rel="noopener noreferrer">
                <img src="/assets/img/icons/dc.png" alt="Discord" class="footer-icon">
            </a>
            <a href="https://instagram.com" target="_blank" rel="noopener noreferrer">
                <img src="/assets/img/icons/ig.png" alt="Instagram" class="footer-icon">
            </a>
            </div>
        </div>
    </div>
</footer>

<?php include 'cookies.php'; ?>
