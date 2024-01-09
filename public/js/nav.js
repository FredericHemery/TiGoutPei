
document.addEventListener('DOMContentLoaded', function() {
    window.addEventListener('scroll', function() {
        var nav = document.querySelector('.sticky-nav');
        var scrolled = window.scrollY;

        // a partir de quelle hauteur la barre devient fixe
        var navHeight = 100;

        if (scrolled > navHeight) {
            nav.classList.add('fixed-top');
        } else {
            nav.classList.remove('fixed-top');
        }
    });
});

