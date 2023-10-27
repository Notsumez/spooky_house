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

// =================================== REVELAR CONTEÚDO LENTAMENTE =======================================

const sr = ScrollReveal({
    origin: 'top',
    distance: '60px',
    duration: 2500,
    delay: 400,
    // reset: true // Repetição das Animações
})

sr.reveal('#home')
sr.reveal('#destaques', {origin: 'right', delay: 600})
sr.reveal('#sobre', {origin: 'left', delay: 600})