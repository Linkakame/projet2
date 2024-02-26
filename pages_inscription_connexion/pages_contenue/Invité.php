<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invité</title>
    <link rel="stylesheet" href="css/invite.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-search/dist/leaflet-search.min.css" />
</head>
<body>
    <div>
        <p> Vous êtes connecté en tant qu'invité </p>
        <br>
        <p> Les trajets : <input id="" placeholder="Rechercher une ville" /></p>
        <div id="contenue_map">
            <input id="search-input" placeholder="Rechercher une ville">
            <div id="map"></div>
        </div>
    </div>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-search/dist/leaflet-search.min.js"></script>
    <script src="js/map.js"></script>
</body>
</html>
