@extends('layouts.master')
@section('titre')
Pharmacie
@endsection

@section('contenu')
<div class="row">
    <div class="col-sm-12">
        <div class="card card-table">
            <div class="card-header">
                <h4 class="card-title float-left mt-2">Map</h4>
                <a href="{{route('pharmacie')}}" type="button" class="btn btn-primary float-right veiwbutton">Retour
                </a>
            </div>
            <div class="card-body">
                <div class="row formtype">
                    <div class="col-sm-12" id="map" style="height: 500px" ; width="500px">
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
{{-- Modal --}}
<div class="modal fade" id="PharmacieModal" tabindex="-1" aria-labelledby="motosModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="motosModalLabel">Infos Pharmacies</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul id="pharmacieList" class="list-group">
                   
                </ul>
            </div>
        </div>
    </div>
</div>
{{-- Fin Modal --}}
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        var map = L.map('map').setView([0, 0], 2);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Wergou-Yaram'
        }).addTo(map);

        var pharms = @json($data);
        var markers = [];

        pharms.forEach(function (pharm) {
            // Utilisation du marqueur par défaut
            var marker = L.marker([pharm.latitude, pharm.longitude]).addTo(map)
                .bindPopup(pharm.nom);

            markers.push(marker);

            marker.on('click', function () {
                var pharmacieList = document.getElementById('pharmacieList');
                pharmacieList.innerHTML = '';

                // Vérifier que motos est un tableau
                if (pharm.motos && Array.isArray(pharm.motos)) {
                    pharm.motos.forEach(function (pharmacie) {
                        var li = document.createElement('li');
                        li.className = 'list-group-item';
                        li.textContent = pharmacie['nom'];
                 
                        pharmacieList.appendChild(li);
                    });
                }

                $('#PharmacieModal').modal('show');
            });
        });

        if (markers.length > 0) {
            var group = L.featureGroup(markers);
            map.fitBounds(group.getBounds());
        }
    });
</script>


@endsection