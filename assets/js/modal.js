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
      const card = button.closest(".employee-card");
      const name = card.querySelector("h3")?.textContent || "";
      const role = card.querySelector("p")?.textContent || "";
      const imgSrc = card.querySelector("img")?.getAttribute("src") || "";

      const dc = card.dataset.dc || "";
      const steam = card.dataset.steam || "";
      const tb = card.dataset.trucksbook || "";
      const email = card.dataset.email || "";

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