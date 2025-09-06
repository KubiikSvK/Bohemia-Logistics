/* =========================== */
/* Modal Script */
/* =========================== */
(function() {
  'use strict';
  
  function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
  }
  
  function isValidUrl(string) {
    try {
      new URL(string);
      return true;
    } catch (_) {
      return false;
    }
  }
  
  function initModal() {
    const modal = document.getElementById("universal-modal");
    const modalBody = document.getElementById("modal-body");
    const modalNav = document.getElementById("modal-nav");
    const closeBtn = document.querySelector(".modal-close");
    const prevBtn = document.getElementById("prev-btn");
    const nextBtn = document.getElementById("next-btn");

    let galleryImages = [];
    let currentIndex = 0;

    // Kontakt modal
    document.querySelectorAll(".contact-btn").forEach(button => {
      button.addEventListener("click", (e) => {
        e.preventDefault();
        
        const name = escapeHtml(button.dataset.name || "");
        const role = escapeHtml(button.dataset.role || "");
        const imgSrc = escapeHtml(button.dataset.img || "");
        const dc = button.dataset.dc || "";
        const steam = button.dataset.steam || "";
        const tb = button.dataset.trucksbook || "";
        const email = button.dataset.email || "";
        
        let discordLink = "";
        if (dc && /^\d+$/.test(dc)) {
          discordLink = `https://discord.com/users/${dc}`;
        } else if (dc && dc.startsWith("http") && isValidUrl(dc)) {
          discordLink = dc;
        }
        
        const contactLinks = [];
        if (discordLink) contactLinks.push(`<a href="${discordLink}" target="_blank" rel="noopener noreferrer">Discord</a>`);
        if (steam && isValidUrl(steam)) contactLinks.push(`<a href="${steam}" target="_blank" rel="noopener noreferrer">Steam</a>`);
        if (tb && isValidUrl(tb)) contactLinks.push(`<a href="${tb}" target="_blank" rel="noopener noreferrer">TrucksBook</a>`);
        if (email && /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) contactLinks.push(`<a href="mailto:${email}">Email</a>`);

        modalBody.innerHTML = `
          <img src="${imgSrc}" alt="${name}" style="width:100px; height:100px; border-radius:50%; margin-bottom:10px;" loading="lazy">
          <h3>${name}</h3>
          <p>${role}</p>
          <div class="contact-links">
            ${contactLinks.join('')}
          </div>
        `;
        
        if (modalNav) modalNav.style.display = "none";
        modal.classList.add("active");
      });
    });

    // Galerie modal - jednodušší přístup
    const galleryModal = document.getElementById("galleryModal");
    const galleryModalImg = document.getElementById("modalImage");
    const galleryClose = document.querySelector(".close");
    const galleryPrev = document.querySelector(".prev");
    const galleryNext = document.querySelector(".next");
    

    
    // Přidání event listenerů na všechny gallery obrázky
    document.addEventListener('click', (e) => {
      if (e.target.classList.contains('gallery-img')) {
        e.preventDefault();
        const imgs = document.querySelectorAll('.gallery-img');
        currentIndex = Array.from(imgs).indexOf(e.target);
        
        if (galleryModal && galleryModalImg) {
          galleryModalImg.src = e.target.src;
          galleryModal.classList.add('active');
        }
      }
    });
    
    // Gallery modal controls
    function closeGalleryModal() {
      if (galleryModal) {
        galleryModal.classList.remove('active');
      }
    }
    
    if (galleryClose) {
      galleryClose.onclick = closeGalleryModal;
    }
    
    // Gallery navigation - jednoduché řešení
    function changeImage(direction) {
      const imgs = document.querySelectorAll('.gallery-img');
      if (direction === 'prev') {
        currentIndex = (currentIndex - 1 + imgs.length) % imgs.length;
      } else {
        currentIndex = (currentIndex + 1) % imgs.length;
      }
      
      galleryModalImg.src = imgs[currentIndex].src;
    }
    
    if (galleryPrev) {
      galleryPrev.onclick = () => changeImage('prev');
    }
    
    if (galleryNext) {
      galleryNext.onclick = () => changeImage('next');
    }
    
    // Swipe podpora pro mobily
    let touchStartX = 0;
    let touchEndX = 0;
    
    if (galleryModal) {
      galleryModal.addEventListener('touchstart', (e) => {
        touchStartX = e.changedTouches[0].screenX;
      });
      
      galleryModal.addEventListener('touchend', (e) => {
        touchEndX = e.changedTouches[0].screenX;
        const swipeThreshold = 50;
        const diff = touchStartX - touchEndX;
        
        if (Math.abs(diff) > swipeThreshold) {
          if (diff > 0) {
            changeImage('next'); // swipe left = next
          } else {
            changeImage('prev'); // swipe right = prev
          }
        }
      });
    }
    
    window.addEventListener("click", (e) => {
      if (e.target === galleryModal) {
        closeGalleryModal();
      }
    });

    function showGalleryImage() {
      if (currentIndex >= 0 && currentIndex < galleryImages.length) {
        modalBody.innerHTML = `<img src="${galleryImages[currentIndex]}" alt="Galerie" style="max-width:100%; border-radius:8px;">`;
      }
    }

    if (prevBtn) {
      prevBtn.addEventListener("click", (e) => {
        e.preventDefault();
        if (galleryImages.length > 0) {
          currentIndex = (currentIndex - 1 + galleryImages.length) % galleryImages.length;
          showGalleryImage();
        }
      });
    }

    if (nextBtn) {
      nextBtn.addEventListener("click", (e) => {
        e.preventDefault();
        if (galleryImages.length > 0) {
          currentIndex = (currentIndex + 1) % galleryImages.length;
          showGalleryImage();
        }
      });
    }

    function closeModal() {
      modal.classList.remove("active");
    }

    if (closeBtn) {
      closeBtn.addEventListener("click", closeModal);
    }

    if (modal) {
      modal.addEventListener("click", (e) => {
        if (e.target === modal) closeModal();
      });
    }

    document.addEventListener("keydown", (e) => {
      if (modal && modal.classList.contains("active")) {
        if (e.key === "Escape") closeModal();
      }
      if (galleryModal && galleryModal.classList.contains('active')) {
        e.preventDefault();
        if (e.key === "Escape") closeGalleryModal();
        if (e.key === "ArrowLeft") changeImage('prev');
        if (e.key === "ArrowRight") changeImage('next');
      }
    });
  }
  
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initModal);
  } else {
    initModal();
  }
})();