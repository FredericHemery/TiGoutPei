    document.addEventListener('DOMContentLoaded', function () {
        let liensSupprimer = document.querySelectorAll('.boutonSupprimer');

        liensSupprimer.forEach(function (lienSupprimer) {
            lienSupprimer.addEventListener('click', function (event) {
                let resultat = confirm('Voulez-vous vraiment supprimer ce plat?');
                if (resultat === false) {
                    event.preventDefault();
                }
            });
        });
    });

    // Fonction pour ouvrir la modale
    function openModal(plat) {
        // Récupère l'élément du conteneur de la modale
        let modalContainer = document.getElementById('modalContainer');

        // Récupère les éléments de la modale pour afficher les détails du plat
        let platTitle = document.getElementById('platTitle');
        let platDescription = document.getElementById('platDescription');
        let platImage = document.getElementById('platImage');

        // Affiche le titre du plat
        platTitle.innerText = plat.querySelector('td:first-child').innerText;

        // Récupère la description du plat s'il existe
        let descriptionElement = plat.nextElementSibling.querySelector('td p.description');
        platDescription.innerText = descriptionElement ? descriptionElement.innerText : '';

        // Récupère l'image du plat s'il existe
        let imgDescription = plat.nextElementSibling.querySelector('td img.imgDescription');
        platImage.src = imgDescription ? imgDescription.src : '';

        // Affiche la modale en la rendant visible
        modalContainer.style.display = 'block';
    }
    // Fonction pour fermer la modale
    function closeModal() {
        // Récupère l'élément du conteneur de la modale
        let modalContainer = document.getElementById('modalContainer');

        // Masque la modale en la rendant invisible
        modalContainer.style.display = 'none';
    }
    // Attache l'événement de clic à chaque ligne du DOM avec la classe 'lignePlats'
    let lignePlats = document.querySelectorAll('.lignePlats');
    lignePlats.forEach(function (plat) {
        // Ajoute un écouteur d'événement au clic sur chaque ligne de plat
        plat.addEventListener('click', function () {
            // Appelle la fonction openModal pour ouvrir la modale du plat sélectionné
            openModal(plat);
        });
    });

