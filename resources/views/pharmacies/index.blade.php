@extends('layouts.master')
@section('titre1')
    Pharmacies
@endsection
@section('titre2')
    Pharmacies
@endsection
@section('contenu')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <button class="btn btn-success Btn_ajouter btn-rounded waves-effect waves-light" style="float:right;"><i
                            class="fas fa-plus-circle"></i></button>
                    <br> <br>
                    <h4 class="card-title">Toutes les Pharmacies</h4>
                    <x-table>
                        {{-- Header --}}
                        <x-table-header :colonnes="['N°', 'Pharmacies', 'Ville', 'telephone', 'Localisation', 'Actions']" />
                        @foreach ($data as $garde)
                            <tr>
                                <td> {{ $loop->iteration }} </td>
                                <td> {{ $garde->nom }} </td>
                                <td> {{ $garde->villes->nom }} </td>
                                <td> {{ $garde->telephone }} </td>
                                <td class="text-center"><button class="btn btn-info btn-rounded"><i
                                            class="fa fa-map"></i></button></td>
                                <td>

                                    <a href="javascript:void(0)" class="btn btn-info sm Btn_update"
                                        title="Modifier pharmacie" data-url="{{ route('pharmacie.edit', $garde->id) }}">
                                        <i class="fas fa-edit"></i> </a>

                                    <button data-url = "{{ route('pharmacie.delete', $garde->id) }}"
                                        class="btn_delete btn btn-danger sm" title="Supprimer cette pharmacie"
                                        id="delete">
                                        <i class="fas fa-trash"></i> </button>


                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </x-table>
                </div>
                @include('pharmacies.modal-create')
                @include('pharmacies.modal-edit')
            </div>
        </div>
    </div>
    {{-- Script --}}
@section('javascript')
    <script>
        $(document).ready(function() {



            // Delete
            $('.btn_delete').on('click', function(e) {
                e.preventDefault();
                var link = $(this).attr("data-url");
                Swal.fire({
                    title: 'Confirmation',
                    text: "Voulez-vous supprimer la pharmacie ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Annuler',
                    confirmButtonText: 'Oui, Supprimer!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = link
                        Swal.fire(
                            'Supprime!',
                            'Supprimé',
                            'success'
                        )
                    }
                });
            });

            // Modal Client
            $('.Btn_ajouter').on('click', function(e) {
                e.preventDefault();
                let modal = new bootstrap.Modal(document.getElementById('ModalPharmacie'))
                modal.show()
            })

            // Submit
            $('#Form_pharmacie').on('submit', function(e) {
                e.preventDefault()
                let nom = $('#nom').val();
                let telephone = $('#telephone').val();
                let longitude = $('#longitude').val();
                let latitude = $('#latitude').val();
                let ville = $('#ville').val();
                if (nom == '') {
                    $.notify('Nom du client obligatoire', {
                        globalPosition: 'top right',
                        className: 'error'
                    })
                    return false;
                }
                if (telephone == '') {
                    $.notify('Télephone Obligatoire', {
                        globalPosition: 'top right',
                        className: 'error'
                    })
                    return false;
                }
                if (ville == '') {
                    $.notify('Ville Obligatoire', {
                        globalPosition: 'top right',
                        className: 'error'
                    })
                    return false;
                }
                let data = $(this).serialize();
                // console.log(data)
                $.ajax({
                    url: "{{ route('pharmacie.store') }}",
                    method: 'POST',
                    data: data,
                    success: function(data) {
                        Swal.fire({
                            title: 'Pharmacie',
                            icon: 'success',
                            text: data.message
                        }).then(() => {
                            window.location.reload()
                        })
                    },
                    error: function(xhr) {

                        Swal.fire({
                            title: 'Pharmacie',
                            icon: 'error',
                            text: 'Erreur: ' + xhr.responseJSON['message']
                        })
                    }
                })
            })

            $(document).on('click', '.Btn_update', function(e) {
                e.preventDefault();
                let url = $(this).data("url");
                $.ajax({
                    url: url,
                    method: "GET",
                    success: function(response) {
                        //console.log(response)
                        $('.pharmacie_id').val(response.id);
                        $('.nom').val(response.nom);
                        $('.telephone').val(response.telephone);
                        $('.adresse').val(response.adresse);
                        $('.longitude').val(response.longitude);
                        $('.latitude').val(response.latitude);
                        $('.ville').val(response.ville_id);
                        let modal = new bootstrap.Modal(document.getElementById(
                            'ModalPharmacieEdition'))
                        modal.show();
                    },
                    error: function(xhr) {
                        console.log(xhr)
                    }
                })

            })
            // Submit update
            $(document).on('submit', '#Form_pharmacie_edition', function(e) {
                e.preventDefault();
                let pharmacie_id = $('.pharmacie_id').val();
                let nom = $('.nom').val();
                let ville = $('.ville').val();
                let telephone = $('.telephone').val();
                let adresse = $('.adresse').val();
                let longitude = $('.longitude').val();
                let latitude = $('.latitude').val();

                if (nom == '') {
                    $.notify('Nom Pharmacie obligatoire', {
                        globalPosition: 'top right',
                        className: 'error'
                    })
                    return false;
                }
                if (telephone == '') {
                    $.notify('Télephone Obligatoire', {
                        globalPosition: 'top right',
                        className: 'error'
                    })
                    return false;
                }
                if (ville == '') {
                    $.notify('Ville Obligatoire', {
                        globalPosition: 'top right',
                        className: 'error'
                    })
                    return false;
                }
                let data = $(this).serialize();

                $.ajax({
                    url: "{{ route('pharmacie.update') }}",
                    method: 'PUT',
                    data: data,
                    success: function(data) {
                        Swal.fire({
                            title: 'Pharmacie',
                            icon: 'success',
                            text: data.message
                        }).then(() => {
                            window.location.reload()
                        })
                    },
                    error: function(xhr) {

                        Swal.fire({
                            title: 'Pharmacie',
                            icon: 'error',
                            text: 'Erreur: ' + xhr.responseJSON['message']
                        })
                    }
                })

            })

            // Chargement table
            $('.table').DataTable({
                "pageLength": 100,
                "ordering": true,
                "autoWidth": false,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/French.json"
                }
            });

           /*  $('#telephone').inputmask('99-999-99-99', {
                clearIncomplete: true,
                placeholder: '_',
            }); */
        })
    </script>
@endsection


@endsection
