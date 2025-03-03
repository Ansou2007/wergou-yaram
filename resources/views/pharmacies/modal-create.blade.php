<div class="modal fade bs-example-modal-center" id="ModalPharmacie" tabindex="-1" role="dialog"
    aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pharmacie</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post" id="Form_pharmacie">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div id="error-message" class="alert alert-danger d-none mb-3" ></div>
                        <div class="form-group col-sm-6">
                            <label for="">Nom Pharmacie</label>
                            <input type="text" class="form-control" name="nom" id="nom" autocomplete="off">
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
                            <input type="text" class="form-control" id="telephone" name="telephone"
                                autocomplete="off" maxlength="9">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="">Adresse Precise</label>
                            <input type="text" class="form-control" name="adresse" id="adresse">
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="">Longitude</label>
                            <input type="text" class="form-control" name="longitude" id="longitude" readonly>
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="">Latitude</label>
                            <input type="text" class="form-control" name="latitude" id="latitude" readonly>
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="">Geolocalisation</label>
                            <button class="btn btn-primary form-control btn-rounded" id="btn-geoloc"><i
                                    class="fa fa-map"></i></button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Enregistrer</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

{{-- <script>
    document.getElementById("btn-geoloc").addEventListener("click", function(event) {
        event.preventDefault(); // Empêche la soumission du formulaire

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function(position) {
                    document.getElementById("latitude").value = position.coords.latitude;
                    document.getElementById("longitude").value = position.coords.longitude;
                },
                function(error) {
                    alert("Erreur de géolocalisation : " + error.message);
                }
            );
        } else {
            alert("La géolocalisation n'est pas supportée par votre navigateur.");
        }
    });
</script> --}}
<script>
    $(document).ready(function() {

        function showError(message) {
            $('#error-message').text(message).removeClass('d-none');
        }

        $('#btn-geoloc').click(function(e) {
            e.preventDefault();
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        let latitude = position.coords.latitude;
                        let longitude = position.coords.longitude;
                        $('#latitude').val(latitude);
                        $('#longitude').val(longitude);
                        showError(""); // Clear any previous errors
                    },
                    function(error) {
                        let errorMessage = "❌ Une erreur est survenue lors de la géolocalisation.";
                        switch (error.code) {
                            case error.PERMISSION_DENIED:
                                errorMessage =
                                    "❌ L'utilisateur a refusé la demande de géolocalisation.";
                                break;
                            case error.POSITION_UNAVAILABLE:
                                errorMessage =
                                    "❌ Les informations de localisation sont indisponibles.";
                                break;
                            case error.TIMEOUT:
                                errorMessage = "❌ La demande de localisation a expiré.";
                                break;
                            case error.UNKNOWN_ERROR:
                                errorMessage = "❌ Une erreur inconnue est survenue.";
                                break;
                        }
                        showError(errorMessage);
                    }, {
                        enableHighAccuracy: true,
                        timeout: 10000,
                        maximumAge: 0
                    }
                );
            } else {
                showError("❌ La géolocalisation n'est pas supportée par votre appareil.");
            }
        });

       
    })
</script>
