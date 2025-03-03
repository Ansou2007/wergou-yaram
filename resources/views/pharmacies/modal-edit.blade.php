<div class="modal fade bs-example-modal-center" id="ModalPharmacieEdition" tabindex="-1" role="dialog"
    aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pharmacie</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post" id="Form_pharmacie_edition">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <input type="hidden" class="pharmacie_id" name="pharmacie_id" id="pharmacie_id">
                            <label for="">Nom Pharmacie</label>
                            <input type="text" class="form-control nom" name="nom" id="nom" autocomplete="off">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="">Ville</label>

                            <select name="ville" id="ville" class="form-select form-control">
                                <option value="">Selection...</option>
                                @foreach ($villes as $ville)
                                    <option value="{{ $ville->id }}">{{ $ville->nom }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="">Telephone</label>
                            <input type="text" class="form-control telephone" id="telephone" name="telephone"
                                autocomplete="off" maxlength="9">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="">Adresse Precise</label>
                            <input type="text" class="form-control adresse" name="adresse" id="adresse">
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="">Longitude</label>
                            <input type="text" class="form-control longitude" name="longitude" id="longitude" readonly>
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="">Latitude</label>
                            <input type="text" class="form-control latitude" name="latitude" id="latitude" readonly>
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="">Geolocalisation</label>
                            <button class="btn btn-primary form-control" id="btn-geoloc"><i
                                    class="fa fa-map"></i></button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Modifier</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script>
    document.getElementById("btn-geoloc").addEventListener("click", function (event) {
        event.preventDefault(); // Empêche la soumission du formulaire
    
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function (position) {
                    // Récupérer la latitude et la longitude
                    let latitude = position.coords.latitude;
                    let longitude = position.coords.longitude;
                    
                    // Afficher dans les champs du formulaire
                    document.getElementById("latitude").value = latitude;
                    document.getElementById("longitude").value = longitude;
    
                    alert("Localisation réussie ! 📍\nLatitude: " + latitude + "\nLongitude: " + longitude);
                },
                function (error) {
                    switch (error.code) {
                        case error.PERMISSION_DENIED:
                            alert("❌ L'utilisateur a refusé la demande de géolocalisation.");
                            break;
                        case error.POSITION_UNAVAILABLE:
                            alert("❌ Les informations de localisation sont indisponibles.");
                            break;
                        case error.TIMEOUT:
                            alert("❌ La demande de localisation a expiré.");
                            break;
                        case error.UNKNOWN_ERROR:
                            alert("❌ Une erreur inconnue est survenue.");
                            break;
                    }
                },
                { enableHighAccuracy: true, timeout: 10000, maximumAge: 0 } // Options pour forcer le GPS
            );
        } else {
            alert("❌ La géolocalisation n'est pas supportée par votre appareil.");
        }
    });
    </script>
    