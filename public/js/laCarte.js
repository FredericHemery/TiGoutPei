document.addEventListener('DOMContentLoaded', function () {
    let lignePlats = document.querySelectorAll('.lignePlats');

    lignePlats.forEach(function (plats) {
        plats.addEventListener('click', function () {
            // Ferme toutes les autres déscriptions avant d'ouvrir celle-ci
            let autresDescriptions = document.querySelectorAll('.lignePlats:not(.collapsed)');
            autresDescriptions.forEach(function (autresDescriptions) {
                if (autresDescriptions !== plats) {
                    autresDescriptions.classList.add('collapsed');
                }
            });
            // Ouvre ou ferme la description
            if (plats.classList.contains('collapsed')) {
                plats.classList.remove('collapsed');
            } else {
                plats.classList.add('collapsed');
            }
        });
    });
});