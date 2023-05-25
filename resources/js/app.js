import "./bootstrap";
import "flowbite";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

const modalToggle = document.querySelectorAll(".modal-toggle");

modalToggle.forEach((el) => {
    el.addEventListener("change", () => {
        if (el.checked) {
            document.body.style.overflowY = "hidden";
        } else {
            document.body.style.overflowY = "auto";
        }
    });
});

document.addEventListener("DOMContentLoaded", function() {
    const lazyImages = [].slice.call(document.querySelectorAll("img.lazy-image"));

    if ("IntersectionObserver" in window) {
        let lazyImageObserver = new IntersectionObserver(function(entries, observer) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    let lazyImage = entry.target;
                    lazyImage.src = lazyImage.dataset.src;
                    lazyImage.classList.remove("lazy-image");
                    lazyImageObserver.unobserve(lazyImage);
                }
            });
        });

        lazyImages.forEach(function(lazyImage) {
            lazyImageObserver.observe(lazyImage);
        });
    }
});
