<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bohemia Logistics</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/modal.css">
    <script src="/assets/js/modal.js" defer></script>
    <script src="/assets/js/script.js" defer></script>
    <script src="/assets/js/cookies.js" defer></script>
</head>
<body>
    <header class="site-header">
        <div class="container">
            <a href="/index.php" class="logo">Bohemia <span>Logistics</span></a>
            
            <!-- Hamburger menu button -->
            <button class="mobile-menu-toggle" id="mobileMenuToggle">
                <span></span>
                <span></span>
                <span></span>
            </button>
            
            <nav class="site-nav" id="siteNav">
                <ul>
                    <li><a href="/index.php">Domů</a></li>
                    <li><a href="/pages/about.php">O nás</a></li>
                    <li><a href="/pages/rules.php">Pravidla</a></li>
                    <li><a href="/pages/employees.php">Zaměstnanci</a></li>
                    <li><a href="/pages/gallery.php">Galerie</a></li>
                    <li><a href="/pages/calendar.php">Kalendář</a></li>
                    <li><a href="/pages/join-us.php">Přidej se k nám</a></li>
                    <li><a href="/pages/contacts.php">Kontakty</a></li>
                </ul>
            </nav>
        </div>
    </header>
    
    <style>
    .site-header .container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
    }
    
    .mobile-menu-toggle {
        display: none;
        flex-direction: column;
        background: none;
        border: none;
        cursor: pointer;
        padding: 5px;
    }
    
    .mobile-menu-toggle span {
        width: 25px;
        height: 3px;
        background: #f5a623;
        margin: 3px 0;
        transition: 0.3s;
        border-radius: 2px;
    }
    
    .mobile-menu-toggle.active span:nth-child(1) {
        transform: rotate(-45deg) translate(-5px, 6px);
    }
    
    .mobile-menu-toggle.active span:nth-child(2) {
        opacity: 0;
    }
    
    .mobile-menu-toggle.active span:nth-child(3) {
        transform: rotate(45deg) translate(-5px, -6px);
    }
    
    @media (max-width: 768px) {
        .mobile-menu-toggle {
            display: flex;
        }
        
        .site-nav {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: #121212;
            border-top: 1px solid #333;
            transform: translateY(-100%);
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 1000;
        }
        
        .site-nav.active {
            transform: translateY(0);
            opacity: 1;
            visibility: visible;
        }
        
        .site-nav ul {
            flex-direction: column;
            padding: 20px 0;
        }
        
        .site-nav li {
            margin: 0;
            border-bottom: 1px solid #333;
        }
        
        .site-nav li:last-child {
            border-bottom: none;
        }
        
        .site-nav a {
            display: block;
            padding: 15px 20px;
            text-align: left;
        }
    }
    </style>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuToggle = document.getElementById('mobileMenuToggle');
        const siteNav = document.getElementById('siteNav');
        
        if (mobileMenuToggle && siteNav) {
            mobileMenuToggle.addEventListener('click', function() {
                mobileMenuToggle.classList.toggle('active');
                siteNav.classList.toggle('active');
            });
            
            // Close menu when clicking on a link
            const navLinks = siteNav.querySelectorAll('a');
            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    mobileMenuToggle.classList.remove('active');
                    siteNav.classList.remove('active');
                });
            });
            
            // Close menu when clicking outside
            document.addEventListener('click', function(e) {
                if (!mobileMenuToggle.contains(e.target) && !siteNav.contains(e.target)) {
                    mobileMenuToggle.classList.remove('active');
                    siteNav.classList.remove('active');
                }
            });
        }
    });
    </script>
