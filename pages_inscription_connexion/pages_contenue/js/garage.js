var vehicules = document.querySelectorAll('.vehicule');
var modal = document.getElementById('myModal');
var vehicleDetails = document.getElementById('vehicleDetails');
var closeButton = document.querySelector('.close');
var paymentButton = document.getElementById('payment-button');

vehicules.forEach(function(vehicule) {
    var louerButton = vehicule.querySelector('#louer button');
    louerButton.addEventListener('click', function() {
        // Obtenez les détails du véhicule correspondant
        var details = vehicule.cloneNode(true);
        // Supprimez le bouton "Louer" des détails du véhicule
        details.querySelector('#louer').innerHTML = '';
        // Afficher les détails dans la modale
        vehicleDetails.innerHTML = '';
        vehicleDetails.appendChild(details);
        // Afficher la modale
        modal.style.display = 'block';
    });
});

// Fermer la modale des détails du véhicule lorsqu'on clique sur le bouton de fermeture
closeButton.addEventListener('click', function() {
    modal.style.display = 'none';
});

// JavaScript pour le bouton de paiement dans la modale des détails du véhicule
paymentButton.addEventListener('click', function() {
    // Redirigez l'utilisateur vers la page de paiement ou affichez une autre modale pour la saisie des informations de paiement
    window.location.href = 'page_paiement.php'; // Remplacez 'page_paiement.php' par le chemin de votre page de paiement PHP
});
