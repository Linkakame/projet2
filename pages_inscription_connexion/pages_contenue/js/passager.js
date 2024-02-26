var modal = document.getElementById("myModal");
var btn = document.getElementById("openModal");
var span = document.getElementsByClassName("close")[0];
var map = document.getElementById("map");

btn.onclick = function() {
  modal.style.display = "block";
  map.style.display = "none"; // Masquer la carte lorsque la modal est ouverte
}

span.onclick = function() {
  modal.style.display = "none";
  map.style.display = "block"; // Afficher la carte lorsque la modal est fermée
}

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
    map.style.display = "block"; // Afficher la carte si l'utilisateur clique en dehors de la modal pour la fermer
  }
}
