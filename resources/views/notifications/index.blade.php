@extends('layouts.master')
@section('titre1')
Notification
@endsection
@section('titre2')
Notification
@endsection
@section('contenu')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Toutes les notifications</h4>
                <div class="table-responsive">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead class="bg-dark text-center text-white">
                            <tr>
                                <th>N°</th>
                                <th>Titre</th>
                                <th>Message</th>
                                <th>Status</th>
                        </thead>
                        <tbody>

                            @foreach ($data as $notification )
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td class="text-center">{{$notification->data['titre']}}</td>
                                <td>{{$notification->data['message']}}</td>
                                <td class="alert-success">{{$notification->read_at ? 'Lue' : 'Non lue'}}</td>
                            </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Script --}}
@section('javascript')
<script>
    $(document).ready(function(){
       
   
        $(document).on('click','.mark-as-read',function() {
            var notificationId = $(this).data('notification-id');
            
             $.ajax({
                type: 'POST',
                url: '/notification/marquer-lue/' + notificationId,
                success: function(response) {
                    // Mettez à jour l'affichage de la notification
                    // Vous pouvez ajouter du code pour masquer ou mettre à jour l'élément HTML ici
                    console.log('Notification marquée comme lue avec succès.');
                },
                error: function(error) {
                    console.error('Erreur lors de la mise à jour de la notification.', error);
                }
            }); 
        });
        // Chargement table
    $('.table').DataTable({'pageLength':100});
    });



</script>

@endsection


@endsection