const modal = document.getElementById("galleryModal");
const modalImg = document.getElementById("modalImage");
const galleryItems = document.querySelectorAll(".gallery-item img");
const closeBtn = document.querySelector(".gallery-modal .close");
const prevBtn = document.querySelector(".gallery-modal .prev");
const nextBtn = document.querySelector(".gallery-modal .next");

let currentIndex = 0;

// otevření modal po kliknutí na náhled
galleryItems.forEach((img, idx) => {
    img.addEventListener('click', () => {
        modal.style.display = "block";
        modalImg.src = img.src;
        currentIndex = idx;
    });
});

// zavření modal
closeBtn.onclick = () => modal.style.display = "none";

// navigace šipkami
prevBtn.onclick = () => {
    currentIndex = (currentIndex - 1 + galleryItems.length) % galleryItems.length;
    modalImg.src = galleryItems[currentIndex].src;
};

nextBtn.onclick = () => {
    currentIndex = (currentIndex + 1) % galleryItems.length;
    modalImg.src = galleryItems[currentIndex].src;
};

// klávesové šipky
document.addEventListener('keydown', (e) => {
    if(modal.style.display === "block"){
        if(e.key === "ArrowLeft") prevBtn.click();
        if(e.key === "ArrowRight") nextBtn.click();
        if(e.key === "Escape") modal.style.display = "none";
    }
});
