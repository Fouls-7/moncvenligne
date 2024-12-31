

    document.addEventListener("DOMContentLoaded", function() {
        // Sélectionner tous les liens de la page
        document.querySelectorAll('a').forEach(function(link) {
            // Ajouter l'attribut target="_blank" à chaque lien
            link.setAttribute('target', '_blank');
        });
    });

