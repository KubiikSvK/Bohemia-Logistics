<div id="cookieConsent" class="cookie-consent" style="display: none;">
  <div class="cookie-content">
    <div class="cookie-text">
      <h4>🍪 Používáme cookies</h4>
      <p>Tento web používá cookies pro zajištění základní funkčnosti a zlepšení vašeho zážitku. Více informací najdete v našich <a href="/pages/gdpr.php">zásadách ochrany osobních údajů</a>.</p>
    </div>
    <div class="cookie-buttons">
      <button id="acceptCookies" class="cookie-btn accept">Přijmout vše</button>
      <button id="rejectCookies" class="cookie-btn reject">Pouze nezbytné</button>
      <button id="cookieSettings" class="cookie-btn settings">Nastavení</button>
    </div>
  </div>
</div>

<style>
.cookie-consent {
  position: fixed;
  bottom: 0;
  left: 0;
  right: 0;
  background: #1b1b1b;
  border-top: 3px solid #f5a623;
  padding: 20px;
  z-index: 10000;
  box-shadow: 0 -2px 10px rgba(0,0,0,0.3);
}

.cookie-content {
  max-width: 1200px;
  margin: 0 auto;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 20px;
}

.cookie-text h4 {
  color: #f5a623;
  margin: 0 0 8px 0;
  font-size: 1.1em;
}

.cookie-text p {
  color: #eee;
  margin: 0;
  font-size: 0.9em;
  line-height: 1.4;
}

.cookie-text a {
  color: #f5a623;
  text-decoration: none;
}

.cookie-text a:hover {
  text-decoration: underline;
}

.cookie-buttons {
  display: flex;
  gap: 10px;
  flex-shrink: 0;
}

.cookie-btn {
  padding: 10px 16px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 0.9em;
  font-weight: 500;
  transition: all 0.3s ease;
}

.cookie-btn.accept {
  background: #28a745;
  color: white;
}

.cookie-btn.accept:hover {
  background: #218838;
}

.cookie-btn.reject {
  background: #6c757d;
  color: white;
}

.cookie-btn.reject:hover {
  background: #5a6268;
}

.cookie-btn.settings {
  background: #f5a623;
  color: #000;
}

.cookie-btn.settings:hover {
  background: #e0950d;
}

@media (max-width: 768px) {
  .cookie-content {
    flex-direction: column;
    text-align: center;
  }
  
  .cookie-buttons {
    flex-wrap: wrap;
    justify-content: center;
  }
}
</style>