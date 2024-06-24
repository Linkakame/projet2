var modal = document.getElementById("myModal");
var btn = document.getElementById("openModal");
var span = document.getElementsByClassName("close")[0];
var map = document.getElementById("map");

btn.onclick = function() {
    modal.style.display = "block";
    if (map) map.style.display = "none"; // Masquer la carte si elle existe lorsque la modal est ouverte
}

span.onclick = function() {
    modal.style.display = "none";
    if (map) map.style.display = "block"; // Afficher la carte si elle existe lorsque la modal est fermée
}

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
        if (map) map.style.display = "block"; // Afficher la carte si l'utilisateur clique en dehors de la modal pour la fermer
    }
}
