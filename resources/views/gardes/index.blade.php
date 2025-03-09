@extends('layouts.master')
@section('titre1')
    Gardes
@endsection
@section('titre2')
    Gardes
@endsection
@section('contenu')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <button class="btn btn-success Btn_ajouter btn-rounded waves-effect waves-light" style="float:right;"><i
                            class="fas fa-plus-circle"></i></button>
                    <br> <br>
                    <h4 class="card-title">Toutes les gardes</h4>
                    <x-table>
                        {{-- Header --}}
                        <x-table-header :colonnes="['N°', 'Pharmacies', 'Ville', 'Date Debut', 'Date Fin', 'Actions']" />
                        @foreach ($data as $garde)
                            <tr>
                                <td> {{ $loop->iteration }} </td>
                                <td> {{ $garde->pharmacies->nom }} </td>
                                <td> {{ $garde->pharmacies->villes->nom }} </td>
                                <td> {{ $garde->date_debut }} </td>
                                <td> {{ $garde->date_fin }} </td>
                                <td>

                                    <a href="javascript:void(0)" class="btn btn-info sm Btn_update" title="Modifier ce client"
                                        data-url="{{ route('garde.edit', $garde->id) }}">
                                        <i class="fas fa-edit"></i> </a>

                                    <button data-url = "{{ route('garde.delete', $garde->id) }}"
                                        class="btn_delete btn btn-danger sm" title="Supprimer cette garde" id="delete">
                                        <i class="fas fa-trash"></i> </button>


                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </x-table>
                </div>
                @include('gardes.modal-create')
                @include('gardes.modal-edit')
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
                    text: "Voulez-vous supprimer la garde ?",
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
                let modal = new bootstrap.Modal(document.getElementById('ModalGarde'))
                modal.show()
            })

            // Submit
            $('#Form_garde').on('submit', function(e) {
                e.preventDefault()
                let pharmacie = $('#pharmacie').val();
                let date_debut = new Date($('#date_debut').val());
                let date_fin = new Date($('#date_fin').val());
                let type = $('#type').val();
                if (pharmacie == '') {
                    $.notify('Pharmacie obligatoire', {
                        globalPosition: 'top right',
                        className: 'error'
                    })
                    return false;
                }
                if (!date_debut || isNaN(date_debut)) {
                    $.notify('Date début obligatoire', {
                        globalPosition: 'top right',
                        className: 'error'
                    });
                    return false;
                }

                if (!date_fin || isNaN(date_fin)) {
                    $.notify('Date fin obligatoire', {
                        globalPosition: 'top right',
                        className: 'error'
                    });
                    return false;
                }

                if (date_fin <= date_debut) {
                    $.notify('La date de fin doit être postérieure à la date de début', {
                        globalPosition: 'top right',
                        className: 'error'
                    });
                    return false;
                }
                if (type == '') {
                    $.notify('Type Obligatoire', {
                        globalPosition: 'top right',
                        className: 'error'
                    })
                    return false;
                }
                let data = $(this).serialize();
                // console.log(data)
                $.ajax({
                    url: "{{ route('garde.store') }}",
                    method: 'POST',
                    data: data,
                    success: function(data) {
                        Swal.fire({
                            title: 'Gardes',
                            icon: 'success',
                            text: data.message
                        }).then(() => {
                            window.location.reload()
                        })
                    },
                    error: function(xhr) {

                        Swal.fire({
                            title: 'Garde',
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
                        $('.garde_id').val(response.id);
                        $('.pharmacie').val(response.pharmacie_id);
                        $('.date_fin').val(response.date_fin);
                        $('.date_debut').val(response.date_debut);
                        let modal = new bootstrap.Modal(document.getElementById(
                            'ModalGardeEdition'))
                        modal.show();
                    },
                    error: function(xhr) {
                        console.log(xhr)
                    }
                })

            })
            // Submit update
            $(document).on('submit', '#Form_garde_edition', function(e) {
                e.preventDefault();
                let garde_id = $('.garde_id').val();
                let pharmacie = $('.pharmacie').val();
                let date_debut = new Date($('.date_debut').val());
                let date_fin = new Date($('.date_fin').val());
                if (pharmacie == '') {
                    $.notify('Pharmacie obligatoire', {
                        globalPosition: 'top right',
                        className: 'error'
                    })
                    return false;
                }
                if (!date_debut || isNaN(date_debut)) {
                    $.notify('Date début obligatoire', {
                        globalPosition: 'top right',
                        className: 'error'
                    });
                    return false;
                }

                if (!date_fin || isNaN(date_fin)) {
                    $.notify('Date fin obligatoire', {
                        globalPosition: 'top right',
                        className: 'error'
                    });
                    return false;
                }

                if (date_fin <= date_debut) {
                    $.notify('La date de fin doit être postérieure à la date de début', {
                        globalPosition: 'top right',
                        className: 'error'
                    });
                    return false;
                }
                let data = $(this).serialize();

                $.ajax({
                    url: "{{ route('garde.update') }}",
                    method: 'PUT',
                    data: data,
                    success: function(data) {
                        Swal.fire({
                            title: 'Gardes',
                            icon: 'success',
                            text: data.message
                        }).then(() => {
                            window.location.reload()
                        })
                    },
                    error: function(xhr) {

                        Swal.fire({
                            title: 'Gardes',
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

        })
    </script>
@endsection


@endsection
