@extends('layouts.master')
@section('titre1')
    Villes
@endsection
@section('titre2')
    Villes
@endsection
@section('contenu')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <button class="btn btn-success Btn_ajouter btn-rounded waves-effect waves-light" style="float:right;"><i
                            class="fas fa-plus-circle"></i></button>
                    <br> <br>
                    <h4 class="card-title">Toutes les villes</h4>
                    <x-table>
                        {{-- Header --}}
                        <x-table-header :colonnes="['N°', 'Nom', 'Actions']" />
                        @foreach ($data as $ville)
                            <tr>
                                <td> {{ $loop->iteration }} </td>
                                <td> {{ $ville->nom }} </td>
                                
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-info sm Btn_update" title="Modifier"
                                        data-url="{{ route('ville.edit', $ville->id) }}">
                                        <i class="fas fa-edit"></i> </a>

                                    <button data-url = "{{ route('ville.delete', $ville->id) }}"
                                        class="btn_delete btn btn-danger sm" title="Supprimer" id="delete">
                                        <i class="fas fa-trash"></i> </button>


                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </x-table>
                </div>
                @include('villes.modal-create')
                @include('villes.modal-edit')
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
                    text: "Voulez-vous supprimer ?",
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
                let modal = new bootstrap.Modal(document.getElementById('ModalVille'))
                modal.show()
            })

            // Submit
            $('#Form_ville').on('submit', function(e) {
                e.preventDefault()
                let nom = $('#nom').val();
                

                if (nom == '') {
                    $.notify('Nom Obligatoire', {
                        globalPosition: 'top right',
                        className: 'error'
                    })
                    return false;
                }
                
                let data = $(this).serialize();
                // console.log(data)
                $.ajax({
                    url: "{{ route('ville.store') }}",
                    method: 'POST',
                    data: data,
                    success: function(data) {
                        Swal.fire({
                            title: 'Ville',
                            icon: 'success',
                            text: data.message
                        }).then(() => {
                            window.location.reload()
                        })
                    },
                    error: function(xhr) {

                        Swal.fire({
                            title: 'Ville',
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
                        $('.ville_id').val(response.id);
                        $('.nom').val(response.nom);
                        let modal = new bootstrap.Modal(document.getElementById(
                            'ModalVilleEdition'))
                        modal.show();
                    },
                    error: function(xhr) {
                        console.log(xhr)
                    }
                })

            })
            // Submit update
            $(document).on('submit', '#Form_ville_edition', function(e) {
                  e.preventDefault()
                let nom = $('.nom').val();

                if (nom == '') {
                    $.notify('Nom Obligatoire', {
                        globalPosition: 'top right',
                        className: 'error'
                    })
                    return false;
                }

                let data = $(this).serialize();

                $.ajax({
                    url: "{{ route('ville.update') }}",
                    method: 'PUT',
                    data: data,
                    success: function(data) {
                        Swal.fire({
                            title: 'Villes',
                            icon: 'success',
                            text: data.message
                        }).then(() => {
                            window.location.reload()
                        })
                    },
                    error: function(xhr) {

                        Swal.fire({
                            title: 'Ville',
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
