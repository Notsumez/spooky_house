// =================================== FUNDO HEADER QUANDO SCROLLAR =======================================
window.addEventListener("scroll", function() {
    var element = document.getElementById("bg_nav");
    if (window.scrollY > 0) {
        element.style.backgroundColor = "#181818";
    } else {
        element.style.backgroundColor = "transparent";
    }
});
