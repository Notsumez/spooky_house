// =================================== FUNDO HEADER QUANDO SCROLLAR =======================================
window.addEventListener("scroll", function() {
    var element = document.getElementById("bg_nav");
    if (window.scrollY > 0) {
        element.style.backdropFilter = "blur(15px)";
    } else {
        element.style.backgroundColor = "transparent";
    }
});

// =================================== HEADER FIXO QUANDO SCROLLAR =======================================

window.addEventListener("scroll", function() {
    var element = document.getElementById("bg_nav");
    if (window.scrollY > 0) {
        element.classList.add("fixed-header");
    } else {
        element.classList.remove("fixed-header");
    }
});

