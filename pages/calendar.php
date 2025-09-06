<?php include '../includes/header.php'; ?>

<main class="calendar-page">
  <div class="container">
    <h1>Kalendář konvojů</h1>
    
    <section class="calendar-info">
      <p>Zde najdete přehled všech nadcházejících konvojů a akcí Bohemia Logistics. Připojte se k nám a zažijte společné jízdy po evropských silnicích!</p>
    </section>

    <section class="calendar-embed">
      <h2>Nadcházející události</h2>
      
      <!-- Google Calendar Embed -->
      <div class="calendar-container">
        <iframe 
          src="https://calendar.google.com/calendar/embed?height=600&wkst=2&bgcolor=%23ffffff&ctz=Europe%2FPrague&showTitle=0&showPrint=0&showTabs=0&showCalendars=0&mode=AGENDA&src=YOUR_CALENDAR_ID%40group.calendar.google.com&color=%23F09300" 
          style="border:solid 1px #777; border-radius: 8px;" 
          width="100%" 
          height="600" 
          frameborder="0" 
          scrolling="no">
        </iframe>
      </div>
      
      <!-- Fallback pro případ, že iframe nefunguje -->
      <div class="events-fallback" style="display: none;">
        <div class="event-card">
          <div class="event-date">
            <span class="day">15</span>
            <span class="month">DEC</span>
          </div>
          <div class="event-info">
            <h3>Vánoční konvoj</h3>
            <p><strong>Čas:</strong> 19:00 - 22:00</p>
            <p><strong>Trasa:</strong> Praha → Vídeň</p>
            <p><strong>Náklad:</strong> Vánoční dárky</p>
            <p>Připojte se k našemu tradičnímu vánočnímu konvoju!</p>
          </div>
        </div>
        
        <div class="event-card">
          <div class="event-date">
            <span class="day">22</span>
            <span class="month">DEC</span>
          </div>
          <div class="event-info">
            <h3>Noční jízda</h3>
            <p><strong>Čas:</strong> 21:00 - 24:00</p>
            <p><strong>Trasa:</strong> Berlin → Amsterdam</p>
            <p><strong>Náklad:</strong> Elektronika</p>
            <p>Noční konvoj pro zkušené řidiče.</p>
          </div>
        </div>
        
        <div class="event-card">
          <div class="event-date">
            <span class="day">29</span>
            <span class="month">DEC</span>
          </div>
          <div class="event-info">
            <h3>Silvestrovský konvoj</h3>
            <p><strong>Čas:</strong> 20:00 - 02:00</p>
            <p><strong>Trasa:</strong> Mnichov → Milán</p>
            <p><strong>Náklad:</strong> Ohňostroje</p>
            <p>Oslavte Nový rok s námi na cestách!</p>
          </div>
        </div>
      </div>
    </section>

    <section class="calendar-instructions">
      <h2>Jak se připojit</h2>
      <div class="instructions-grid">
        <div class="instruction-card">
          <h3>1. Discord</h3>
          <p>Připojte se na náš Discord server pro koordinaci a komunikaci během konvojů.</p>
        </div>
        <div class="instruction-card">
          <h3>2. TrucksBook</h3>
          <p>Zaregistrujte se do našeho TrucksBook profilu pro sledování statistik.</p>
        </div>
        <div class="instruction-card">
          <h3>3. ETS2 konvoje</h3>
          <p>Připojte se buď na TruckersMP server nebo použijte originální ETS2 Konvoj funkci ve hře pro společné jízdy.</p>
        </div>
      </div>
    </section>

    <section class="calendar-rules">
      <h2>Pravidla konvojů</h2>
      <ul>
        <li>Dodržujte rychlostní limit 90 km/h</li>
        <li>Používejte firemní paint job</li>
        <li>Komunikujte přes Discord</li>
        <li>Respektujte ostatní účastníky</li>
        <li>Dostavte se 15 minut před začátkem</li>
      </ul>
    </section>
  </div>
</main>

<style>
.calendar-info {
  background: #1b1b1b;
  padding: 20px;
  border-radius: 8px;
  border: 1px solid #333;
  margin-bottom: 30px;
  text-align: center;
}

.calendar-container {
  background: #1b1b1b;
  padding: 20px;
  border-radius: 8px;
  border: 1px solid #333;
  margin-bottom: 30px;
}

.calendar-container iframe {
  background: white;
  border-radius: 8px;
}

.events-fallback {
  display: flex;
  flex-direction: column;
  gap: 20px;
}

.event-card {
  display: flex;
  background: #1b1b1b;
  border: 1px solid #333;
  border-radius: 8px;
  padding: 20px;
  gap: 20px;
  align-items: center;
}

.event-date {
  background: #f5a623;
  color: #000;
  padding: 15px;
  border-radius: 8px;
  text-align: center;
  min-width: 80px;
}

.event-date .day {
  display: block;
  font-size: 1.5em;
  font-weight: bold;
}

.event-date .month {
  display: block;
  font-size: 0.9em;
}

.event-info h3 {
  color: #f5a623;
  margin: 0 0 10px 0;
}

.event-info p {
  margin: 5px 0;
  color: #eee;
}

.instructions-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 20px;
  margin-top: 20px;
}

.instruction-card {
  background: #1b1b1b;
  padding: 20px;
  border-radius: 8px;
  border: 1px solid #333;
  text-align: center;
}

.instruction-card h3 {
  color: #f5a623;
  margin-bottom: 15px;
}

.calendar-rules {
  background: #1b1b1b;
  padding: 20px;
  border-radius: 8px;
  border: 1px solid #333;
  margin-top: 30px;
}

.calendar-rules h2 {
  color: #f5a623;
  margin-bottom: 15px;
}

.calendar-rules ul {
  list-style: none;
  padding: 0;
}

.calendar-rules li {
  padding: 8px 0;
  border-bottom: 1px solid #333;
  position: relative;
  padding-left: 20px;
}

.calendar-rules li:before {
  content: "✓";
  color: #28a745;
  font-weight: bold;
  position: absolute;
  left: 0;
}

.calendar-rules li:last-child {
  border-bottom: none;
}

@media (max-width: 768px) {
  .event-card {
    flex-direction: column;
    text-align: center;
  }
  
  .calendar-container iframe {
    height: 400px;
  }
}
</style>

<script>
// Check if iframe loads properly, show fallback if not
document.addEventListener('DOMContentLoaded', function() {
  const iframe = document.querySelector('.calendar-container iframe');
  const fallback = document.querySelector('.events-fallback');
  
  // Show fallback after 5 seconds if iframe doesn't load
  setTimeout(() => {
    // You can add logic here to check if calendar loaded
    // For now, we'll keep the iframe visible
  }, 5000);
  
  // Add click handlers for event cards
  const eventCards = document.querySelectorAll('.event-card');
  eventCards.forEach(card => {
    card.addEventListener('click', function() {
      // You can add functionality to show more details or register for event
      console.log('Event clicked');
    });
  });
});
</script>

<?php include '../includes/footer.php'; ?>