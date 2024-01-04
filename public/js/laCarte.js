document.addEventListener('DOMContentLoaded', function () {
    var lignePlats = document.querySelectorAll('.lignePlats');

    lignePlats.forEach(function (row) {
        row.addEventListener('click', function () {
            // Ferme tous les autres détails avant d'ouvrir celui-ci
            var otherDetails = document.querySelectorAll('.lignePlats:not(.collapsed)');
            otherDetails.forEach(function (otherDetail) {
                if (otherDetail !== row) {
                    otherDetail.classList.add('collapsed');
                    var target = document.getElementById(otherDetail.getAttribute('data-target').substring(1));
                    target.classList.remove('in');
                }
            });

            // Ouvre ou ferme le détail
            var target = document.getElementById(row.getAttribute('data-target').substring(1));
            if (row.classList.contains('collapsed')) {
                row.classList.remove('collapsed');
                target.classList.add('in');
            } else {
                row.classList.add('collapsed');
                target.classList.remove('in');
            }
        });
    });
});