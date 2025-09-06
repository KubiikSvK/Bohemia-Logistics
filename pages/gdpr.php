<?php include '../includes/header.php'; ?>

<main class="gdpr-page">
  <div class="container">
    <h1>Ochrana osobních údajů (GDPR)</h1>
    
    <section class="gdpr-section">
      <h2>Základní informace</h2>
      <p>Bohemia Logistics respektuje vaše soukromí a zavzavuje se k ochraně vašich osobních údajů v souladu s nařízením GDPR (EU) 2016/679.</p>
    </section>

    <section class="gdpr-section">
      <h2>Jaké údaje zpracováváme</h2>
      <h3>Při procházení webu:</h3>
      <ul>
        <li>IP adresa a technické informace o zařízení</li>
        <li>Informace o prohlížeči a operačním systému</li>
        <li>Cookies pro funkčnost webu a analytiku</li>
        <li>Čas a datum návštěvy</li>
      </ul>

      <h3>Při kontaktování:</h3>
      <ul>
        <li>Jméno a příjmení</li>
        <li>E-mailová adresa</li>
        <li>Obsah zprávy</li>
        <li>Další údaje, které nám dobrovolně poskytnete</li>
      </ul>

      <h3>Při registraci do firmy:</h3>
      <ul>
        <li>Herní jméno a profily (Steam, TrucksBook, Discord)</li>
        <li>Kontaktní údaje pro komunikaci</li>
        <li>Herní statistiky a výkony</li>
      </ul>
    </section>

    <section class="gdpr-section">
      <h2>Účel zpracování</h2>
      <ul>
        <li><strong>Provoz webu:</strong> Zajištění funkčnosti a bezpečnosti stránek</li>
        <li><strong>Komunikace:</strong> Odpovědi na dotazy a poskytování informací</li>
        <li><strong>Správa komunity:</strong> Organizace herních aktivit a koordinace členů</li>
        <li><strong>Analytika:</strong> Zlepšování uživatelského zážitku</li>
      </ul>
    </section>

    <section class="gdpr-section">
      <h2>Sdílení údajů s třetími stranami</h2>
      <p>Vaše osobní údaje můžeme sdílet s následujícími službami:</p>
      <ul>
        <li><strong>Discord:</strong> Pro komunikaci v komunitě (discord.com)</li>
        <li><strong>Steam:</strong> Pro ověření herních profilů (steampowered.com)</li>
        <li><strong>TrucksBook:</strong> Pro sledování herních statistik (trucksbook.eu)</li>
        <li><strong>Hosting poskytovatel:</strong> Pro technický provoz webu</li>
      </ul>
      <p>Tyto služby mají vlastní zásady ochrany osobních údajů, se kterými se doporučujeme seznámit.</p>
    </section>

    <section class="gdpr-section">
      <h2>Doba uchovávání</h2>
      <ul>
        <li><strong>Webové logy:</strong> 12 měsíců</li>
        <li><strong>Kontaktní formuláře:</strong> 24 měsíců</li>
        <li><strong>Členské údaje:</strong> Po dobu členství + 12 měsíců</li>
        <li><strong>Cookies:</strong> Podle nastavení prohlížeče</li>
      </ul>
    </section>

    <section class="gdpr-section">
      <h2>Vaše práva</h2>
      <p>Máte právo na:</p>
      <ul>
        <li>Přístup k vašim osobním údajům</li>
        <li>Opravu nesprávných údajů</li>
        <li>Výmaz údajů (právo být zapomenut)</li>
        <li>Omezení zpracování</li>
        <li>Přenositelnost údajů</li>
        <li>Námitku proti zpracování</li>
        <li>Stížnost u dozorového úřadu</li>
      </ul>
    </section>

    <section class="gdpr-section">
      <h2>Cookies</h2>
      <p>Používáme následující typy cookies:</p>
      <ul>
        <li><strong>Nezbytné:</strong> Pro základní funkčnost webu</li>
        <li><strong>Analytické:</strong> Pro sledování návštěvnosti</li>
        <li><strong>Funkční:</strong> Pro uložení preferencí</li>
      </ul>
      <p>Cookies můžete spravovat v nastavení vašeho prohlížeče.</p>
    </section>

    <section class="gdpr-section">
      <h2>Kontakt</h2>
      <p>Pro dotazy ohledně zpracování osobních údajů nás kontaktujte:</p>
      <ul>
        <li>E-mail: <a href="mailto:gdpr@bml.vanekgroup.eu">gdpr@bml.vanekgroup.eu</a></li>
        <li>Kontaktní formulář: <a href="/pages/contacts.php">Kontakty</a></li>
      </ul>
    </section>

    <section class="gdpr-section">
      <p><em>Tyto zásady byly naposledy aktualizovány: <?= date('d.m.Y') ?></em></p>
    </section>
  </div>
</main>

<style>
.gdpr-section {
  margin-bottom: 30px;
  padding: 20px;
  background: #1b1b1b;
  border-radius: 8px;
  border: 1px solid #333;
}

.gdpr-section h2 {
  color: #f5a623;
  margin-bottom: 15px;
}

.gdpr-section h3 {
  color: #ffc107;
  margin: 15px 0 10px 0;
}

.gdpr-section ul {
  margin: 10px 0;
  padding-left: 20px;
}

.gdpr-section li {
  margin-bottom: 5px;
}

.gdpr-section a {
  color: #f5a623;
  text-decoration: none;
}

.gdpr-section a:hover {
  text-decoration: underline;
}
</style>

<?php include '../includes/footer.php'; ?>