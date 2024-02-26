document.addEventListener("DOMContentLoaded", function () {
    var mymap;
    var markers = []; // Stocker les références des marqueurs

    // Initialiser la carte avec les limites de la France
    var franceBounds = L.latLngBounds(
        L.latLng(41.303, -5.559), // Sud-ouest de la France
        L.latLng(51.124, 9.660)   // Nord-est de la France
    );

    mymap = L.map('map', {
        maxBounds: franceBounds,
        minZoom: 5
    }).setView([46.603, 1.888], 6);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(mymap);

    // Fonction pour ajouter un marqueur sur la carte
    function addMarker(latlng) {
        var marker = L.marker(latlng).addTo(mymap);
        markers.push(marker);

        // Ajouter un gestionnaire d'événement de clic pour supprimer le marqueur
        marker.on('click', function () {
            removeMarker(marker);
        });
    }

    // Fonction pour supprimer un marqueur de la carte
    function removeMarker(marker) {
        mymap.removeLayer(marker);
        var index = markers.indexOf(marker);
        if (index !== -1) {
            markers.splice(index, 1);
        }
    }

    // Fonction de recherche de location limitée à la France
    function searchLocation(searchValue) {
        // Attendre au moins 3 caractères pour éviter des requêtes inutiles
        if (searchValue.length <= 2) {
            return Promise.reject('La recherche doit contenir au moins 3 caractères.');
        }

        // Construire l'URL de recherche limitée à la France
        var url = 'https://nominatim.openstreetmap.org/search?format=json&q=' + encodeURIComponent(searchValue) +
            '&viewbox=' + franceBounds.getWest() + ',' + franceBounds.getSouth() + ',' + franceBounds.getEast() + ',' + franceBounds.getNorth();

        return fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error('La requête a échoué.');
                }
                return response.json();
            })
            .then(data => {
                var uniqueSuggestions = {};
                var uniqueResults = [];
                data.forEach(result => {
                    var key = result.display_name + (result.address && result.address.postcode ? result.address.postcode : '');
                    if (!uniqueSuggestions[key]) {
                        uniqueSuggestions[key] = true;
                        uniqueResults.push(result);
                    }
                });

                return uniqueResults.map(result => {
                    var label = result.display_name;
                    if (result.address && result.address.postcode) {
                        label += ", " + result.address.postcode;
                    }
                    return {
                        label: label,
                        value: result.display_name,
                        latlng: L.latLng(result.lat, result.lon)
                    };
                });
            })
            .catch(error => {
                console.error('Erreur lors de la recherche de la position :', error);
                return Promise.reject(error);
            });
    }

    // Initialiser l'autocomplétion de la barre de recherche
    var searchInput = document.getElementById('search-input');
    searchInput.addEventListener('input', function () {
        var searchValue = this.value;

        // Effectuer la recherche de location
        searchLocation(searchValue)
            .then(suggestions => {
                // Afficher les suggestions dans la barre de recherche
                autocomplete(searchInput, suggestions);
            })
            .catch(error => {
                console.error('Erreur lors de la recherche de la position :', error);
            });
    });

    // Fonction pour afficher les suggestions dans la barre de recherche
    function autocomplete(input, suggestions) {
        var currentFocus;

        // Fermer toutes les suggestions
        closeAllLists();

        if (!input.value) {
            return false;
        }

        // Créer une nouvelle liste de suggestions
        var autocompleteList = document.createElement("div");
        autocompleteList.setAttribute("class", "autocomplete-items");
        input.parentNode.appendChild(autocompleteList);

        // Parcourir les suggestions et créer des éléments pour les afficher
        for (var i = 0; i < suggestions.length; i++) {
            var suggestion = suggestions[i];
            var suggestionElement = document.createElement("div");
            suggestionElement.innerHTML = "<strong>" + suggestion.label.substr(0, input.value.length) + "</strong>";
            suggestionElement.innerHTML += suggestion.label.substr(input.value.length);
            suggestionElement.innerHTML += "<input type='hidden' value='" + suggestion.label + "'>";
            suggestionElement.addEventListener("click", function (e) {
                // Mettre la valeur de la suggestion sélectionnée dans la barre de recherche
                input.value = this.getElementsByTagName("input")[0].value;

                // Ajouter un marqueur sur la carte pour la suggestion sélectionnée
                addMarker(suggestion.latlng);

                // Fermer toutes les suggestions
                closeAllLists();
            });
            autocompleteList.appendChild(suggestionElement);
        }

        // Fonction pour fermer toutes les suggestions
        function closeAllLists() {
            var autocompleteItems = document.getElementsByClassName("autocomplete-items");
            for (var i = 0; i < autocompleteItems.length; i++) {
                autocompleteItems[i].parentNode.removeChild(autocompleteItems[i]);
            }
        }

        // Gérer les événements de clavier pour la navigation dans les suggestions
        input.addEventListener("keydown", function (e) {
            var autocompleteItems = document.getElementsByClassName("autocomplete-items");
            if (autocompleteItems.length) {
                if (e.keyCode === 40) {
                    // Flèche vers le bas
                    currentFocus++;
                    addActive(autocompleteItems);
                } else if (e.keyCode === 38) {
                    // Flèche vers le haut
                    currentFocus--;
                    addActive(autocompleteItems);
                } else if (e.keyCode === 13) {
                    // Touche "Entrée"
                    e.preventDefault();
                    if (currentFocus > -1) {
                        autocompleteItems[currentFocus].click();
                    }
                }
            }
        });

        function addActive(autocompleteItems) {
            if (!autocompleteItems) {
                return false;
            }
            removeActive(autocompleteItems);
            if (currentFocus >= autocompleteItems.length) {
                currentFocus = 0;
            }
            if (currentFocus < 0) {
                currentFocus = (autocompleteItems.length - 1);
            }
            autocompleteItems[currentFocus].classList.add("autocomplete-active");
        }

        function removeActive(autocompleteItems) {
            for (var i = 0; i < autocompleteItems.length; i++) {
                autocompleteItems[i].classList.remove("autocomplete-active");
            }
        }
    }

    // Ajouter un gestionnaire d'événement à la carte pour ajouter des marqueurs manuellement
    mymap.on('click', function (event) {
        var searchValue = searchInput.value;

        if (!searchValue) {
            // Ajouter un marqueur uniquement si l'input de recherche est vide
            addMarker(event.latlng);
        }
    });
});
