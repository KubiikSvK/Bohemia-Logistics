document.addEventListener("DOMContentLoaded", () => {
    const modal = document.querySelector(".modal");
    const modalContent = document.querySelector(".modal-content p");
    const closeBtn = document.querySelector(".modal-close");
    const contactButtons = document.querySelectorAll(".contact-btn");

    contactButtons.forEach(btn => {
        btn.addEventListener("click", () => {
            const info = btn.closest(".employee-card").dataset.contact;
            modalContent.textContent = info;
            modal.classList.add("active");
        });
    });

    closeBtn.addEventListener("click", () => {
        modal.classList.remove("active");
    });

    modal.addEventListener("click", e => {
        if(e.target === modal) modal.classList.remove("active");
    });
});
