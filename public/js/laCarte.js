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
    let modalContainer = document.getElementById('modalContainer');
    let platTitle = document.getElementById('platTitle');
    let platDescription = document.getElementById('platDescription');
    let platImage = document.getElementById('platImage');

    platTitle.innerText = plat.querySelector('td:first-child').innerText;
    let descriptionElement = plat.nextElementSibling.querySelector('td p.description');
    platDescription.innerText = descriptionElement ? descriptionElement.innerText : '';
    let imgDescription = plat.nextElementSibling.querySelector('td img.imgDescription');
    platImage.src = imgDescription ? imgDescription.src:'';

    modalContainer.style.display = 'block';
}

// Fonction pour fermer la modale
function closeModal() {
    let modalContainer = document.getElementById('modalContainer');
    modalContainer.style.display = 'none';
}

// Attache l'événement de clic à chaque ligne du DOM avec la classe 'lignePlats'
let lignePlats = document.querySelectorAll('.lignePlats');
lignePlats.forEach(function (plat) {
    plat.addEventListener('click', function () {
        openModal(plat);
    });
});
