// Cookie consent functionality
document.addEventListener('DOMContentLoaded', function() {
    const cookieConsent = document.getElementById('cookieConsent');
    const acceptBtn = document.getElementById('acceptCookies');
    const rejectBtn = document.getElementById('rejectCookies');
    const settingsBtn = document.getElementById('cookieSettings');
    
    // Check if user has already made a choice
    if (!getCookie('cookieConsent')) {
        // Show cookie banner after half second
        setTimeout(() => {
            if (cookieConsent) {
                cookieConsent.style.display = 'block';
                cookieConsent.style.visibility = 'visible';
                cookieConsent.style.opacity = '1';
            }
        }, 500);
    }
    
    // Accept all cookies
    acceptBtn.addEventListener('click', function() {
        setCookie('cookieConsent', 'accepted', 365);
        setCookie('analyticsConsent', 'true', 365);
        setCookie('functionalConsent', 'true', 365);
        hideCookieBanner();
        loadAnalytics();
    });
    
    // Reject optional cookies
    rejectBtn.addEventListener('click', function() {
        setCookie('cookieConsent', 'rejected', 365);
        setCookie('analyticsConsent', 'false', 365);
        setCookie('functionalConsent', 'false', 365);
        hideCookieBanner();
    });
    
    // Cookie settings
    settingsBtn.addEventListener('click', function() {
        showCookieSettings();
    });
    
    // Load analytics if previously accepted
    if (getCookie('analyticsConsent') === 'true') {
        loadAnalytics();
    }
});

// Function to manually show cookie banner
function showCookieBanner() {
    const cookieConsent = document.getElementById('cookieConsent');
    if (cookieConsent) {
        cookieConsent.style.display = 'block';
    }
}

function setCookie(name, value, days) {
    const expires = new Date();
    expires.setTime(expires.getTime() + (days * 24 * 60 * 60 * 1000));
    document.cookie = name + '=' + value + ';expires=' + expires.toUTCString() + ';path=/;SameSite=Lax';
}

function getCookie(name) {
    const nameEQ = name + "=";
    const ca = document.cookie.split(';');
    for(let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) === ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

function hideCookieBanner() {
    const cookieConsent = document.getElementById('cookieConsent');
    cookieConsent.style.display = 'none';
}

function showCookieSettings() {
    const modal = document.createElement('div');
    modal.innerHTML = `
        <div id="cookieModal" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.8); z-index: 10001; display: flex; align-items: center; justify-content: center;">
            <div style="background: #1b1b1b; padding: 30px; border-radius: 8px; max-width: 500px; width: 90%; border: 1px solid #333;">
                <h3 style="color: #f5a623; margin-top: 0;">Nastavení cookies</h3>
                
                <div style="margin: 20px 0;">
                    <label style="display: flex; align-items: center; margin-bottom: 15px; color: #eee;">
                        <input type="checkbox" checked disabled style="margin-right: 10px;">
                        <div>
                            <strong>Nezbytné cookies</strong><br>
                            <small>Potřebné pro základní funkčnost webu</small>
                        </div>
                    </label>
                    
                    <label style="display: flex; align-items: center; margin-bottom: 15px; color: #eee;">
                        <input type="checkbox" id="analyticsCheck" style="margin-right: 10px;">
                        <div>
                            <strong>Analytické cookies</strong><br>
                            <small>Pomáhají nám zlepšovat web</small>
                        </div>
                    </label>
                    
                    <label style="display: flex; align-items: center; margin-bottom: 15px; color: #eee;">
                        <input type="checkbox" id="functionalCheck" style="margin-right: 10px;">
                        <div>
                            <strong>Funkční cookies</strong><br>
                            <small>Ukládají vaše preference</small>
                        </div>
                    </label>
                </div>
                
                <div style="display: flex; gap: 10px; justify-content: flex-end;">
                    <button id="saveSettings" style="background: #28a745; color: white; border: none; padding: 10px 16px; border-radius: 4px; cursor: pointer;">Uložit</button>
                    <button id="closeModal" style="background: #6c757d; color: white; border: none; padding: 10px 16px; border-radius: 4px; cursor: pointer;">Zrušit</button>
                </div>
            </div>
        </div>
    `;
    
    document.body.appendChild(modal);
    
    // Set current values
    document.getElementById('analyticsCheck').checked = getCookie('analyticsConsent') === 'true';
    document.getElementById('functionalCheck').checked = getCookie('functionalConsent') === 'true';
    
    // Save settings
    document.getElementById('saveSettings').addEventListener('click', function() {
        const analytics = document.getElementById('analyticsCheck').checked;
        const functional = document.getElementById('functionalCheck').checked;
        
        setCookie('cookieConsent', 'custom', 365);
        setCookie('analyticsConsent', analytics.toString(), 365);
        setCookie('functionalConsent', functional.toString(), 365);
        
        if (analytics) {
            loadAnalytics();
        }
        
        document.body.removeChild(modal);
        hideCookieBanner();
    });
    
    // Close modal
    document.getElementById('closeModal').addEventListener('click', function() {
        document.body.removeChild(modal);
    });
}

function loadAnalytics() {
    // Here you can load Google Analytics or other analytics scripts
    // Example: Load Google Analytics
    // (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    // (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    // m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    // })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
    // ga('create', 'YOUR-GA-ID', 'auto');
    // ga('send', 'pageview');
}