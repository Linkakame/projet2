<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>conducteur vehicule perso</title>
    <link rel="stylesheet" href="css/conducteur.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-search/dist/leaflet-search.min.css" />
</head>
<body>
    <p> vous avez enregistrer votre voiture  </p>
    <p> Les trajets : <input id="" placeholder="Rechercher une ville" /></p>
    <button id="openModal">Inscription</button>
    <div id="myModal" class="modal">
        <div class="modal-content">
            <form  method="post">
                
            </form>
            </div>
        <span class="close">&times;</span>
    </div> 
    <div id="contenue_map">
            <input id="search-input" placeholder="Rechercher une ville">
            <div id="map"></div>
    </div>
    
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-search/dist/leaflet-search.min.js"></script>
    <script src="js/conducteur.js"></script>
    <script src="js/map.js"></script>
</body>
</html>