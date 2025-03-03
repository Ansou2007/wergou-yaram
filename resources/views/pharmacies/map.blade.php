

<div id="map" style="height: 300px; width: 100%; margin-top: 10px;"></div>

<script>
    document.getElementById("btn-geoloc").addEventListener("click", function (event) {
        event.preventDefault(); // Empêche la soumission du formulaire
    
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function (position) {
                    let latitude = position.coords.latitude;
                    let longitude = position.coords.longitude;
    
                    // Mettre à jour les champs du formulaire
                    document.getElementById("latitude").value = latitude;
                    document.getElementById("longitude").value = longitude;
    
                    // Afficher la carte et le marqueur
                    afficherCarte(latitude, longitude);
                },
                function (error) {
                    alert("Erreur de géolocalisation : " + error.message);
                },
                { enableHighAccuracy: true, timeout: 10000, maximumAge: 0 }
            );
        } else {
            alert("La géolocalisation n'est pas supportée par votre appareil.");
        }
    });
    
    // Fonction pour afficher la carte
    function afficherCarte(lat, lng) {
        // Vérifier si la carte existe déjà
        if (typeof map !== "undefined") {
            map.remove(); // Supprime l'ancienne carte si elle existe
        }
    
        // Créer la carte
        map = L.map('map').setView([lat, lng], 15); // Zoom à 15
    
        // Ajouter les tuiles OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);
    
        // Ajouter un marqueur
        L.marker([lat, lng]).addTo(map)
            .bindPopup("📍 Pharmacie ici !")
            .openPopup();
    }
    </script>
    