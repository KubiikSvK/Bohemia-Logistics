/* =========================== */
/* Universal Modal Script     */
/* =========================== */
document.addEventListener("DOMContentLoaded", () => {
  const modal = document.getElementById("universal-modal");
  const modalBody = document.getElementById("modal-body");
  const modalNav = document.getElementById("modal-nav");
  const closeBtn = document.querySelector(".modal-close");
  const prevBtn = document.getElementById("prev-btn");
  const nextBtn = document.getElementById("next-btn");

  let galleryImages = [];
  let currentIndex = 0;

  // === Kontakt modal ===
  document.querySelectorAll(".contact-btn").forEach(button => {
    button.addEventListener("click", () => {
      const name = button.dataset.name || "";
      const role = button.dataset.role || "";
      const imgSrc = button.dataset.img || "";
      const dc = button.dataset.dc || "";
      const steam = button.dataset.steam || "";
      const tb = button.dataset.trucksbook || "";
      const email = button.dataset.email || "";

      modalBody.innerHTML = `
        <img src="${imgSrc}" alt="${name}" style="width:100px; height:100px; border-radius:50%; margin-bottom:10px;">
        <h3>${name}</h3>
        <p>${role}</p>
        <div class="contact-links">
          ${dc ? `<a href="${dc}" target="_blank">Discord</a>` : ""}
          ${steam ? `<a href="${steam}" target="_blank">Steam</a>` : ""}
          ${tb ? `<a href="${tb}" target="_blank">TrucksBook</a>` : ""}
          ${email ? `<a href="mailto:${email}">Email</a>` : ""}
        </div>
      `;
      modalNav.style.display = "none";
      modal.classList.add("active");
    });
  });

  // === Galerie modal ===
  document.querySelectorAll(".gallery-img").forEach((img, index) => {
    galleryImages.push(img.getAttribute("src"));

    img.addEventListener("click", () => {
      currentIndex = index;
      showGalleryImage();
      modalNav.style.display = "flex";
      modal.classList.add("active");
    });
  });

  function showGalleryImage() {
    const src = galleryImages[currentIndex];
    modalBody.innerHTML = `<img src="${src}" alt="" style="max-width:100%; border-radius:8px;">`;
  }

  prevBtn.addEventListener("click", () => {
    currentIndex = (currentIndex - 1 + galleryImages.length) % galleryImages.length;
    showGalleryImage();
  });

  nextBtn.addEventListener("click", () => {
    currentIndex = (currentIndex + 1) % galleryImages.length;
    showGalleryImage();
  });

  closeBtn.addEventListener("click", () => {
    modal.classList.remove("active");
  });

  window.addEventListener("click", (e) => {
    if (e.target === modal) {
      modal.classList.remove("active");
    }
  });

  document.addEventListener("keydown", (e) => {
    if (!modal.classList.contains("active")) return;

    if (e.key === "Escape") modal.classList.remove("active");
    if (modalNav.style.display === "flex") {
      if (e.key === "ArrowLeft") prevBtn.click();
      if (e.key === "ArrowRight") nextBtn.click();
    }
  });
});

/* =========================== */
/* Gallery Modal Script       */
/* =========================== */
document.addEventListener("DOMContentLoaded", () => {
  const galleryModal = document.getElementById("galleryModal");
  const galleryModalImg = document.getElementById("modalImage");
  const galleryClose = document.querySelector("#galleryModal .close");
  const galleryPrev = document.querySelector("#galleryModal .prev");
  const galleryNext = document.querySelector("#galleryModal .next");

  const galleryItems = Array.from(document.querySelectorAll(".gallery-img"));
  let currentIndex = 0;

  // Otevření modalu
  galleryItems.forEach((img, index) => {
    img.addEventListener("click", () => {
      currentIndex = index;
      galleryModal.style.display = "block";
      galleryModalImg.src = galleryItems[currentIndex].src;
    });
  });

  // Zavření modalu
  galleryClose.onclick = () => galleryModal.style.display = "none";
  window.addEventListener("click", (e) => {
    if (e.target === galleryModal) galleryModal.style.display = "none";
  });

  // Šipky
  galleryPrev.onclick = () => {
    currentIndex = (currentIndex - 1 + galleryItems.length) % galleryItems.length;
    galleryModalImg.src = galleryItems[currentIndex].src;
  };

  galleryNext.onclick = () => {
    currentIndex = (currentIndex + 1) % galleryItems.length;
    galleryModalImg.src = galleryItems[currentIndex].src;
  };

  // Klávesy
  document.addEventListener("keydown", (e) => {
    if (galleryModal.style.display !== "block") return;
    if (e.key === "ArrowLeft") galleryPrev.click();
    if (e.key === "ArrowRight") galleryNext.click();
    if (e.key === "Escape") galleryModal.style.display = "none";
  });

  // Swipe
  let touchStartX = 0;
  let touchEndX = 0;

  galleryModal.addEventListener("touchstart", (e) => {
    touchStartX = e.changedTouches[0].screenX;
  });

  galleryModal.addEventListener("touchend", (e) => {
    touchEndX = e.changedTouches[0].screenX;
    handleSwipe();
  });

  function handleSwipe() {
    const threshold = 50;
    const distance = touchEndX - touchStartX;
    if (Math.abs(distance) < threshold) return;

    if (distance > 0) {
      galleryPrev.click(); // swipe right
    } else {
      galleryNext.click(); // swipe left
    }
  }
});