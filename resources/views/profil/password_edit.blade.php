@extends('layouts.master')

@section('titre1')
Mot de Passe
@endsection

@section('contenu')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Changer le Mot de Passe</h4><br><br>

                <form id="password_form">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Nouveau Mot de Passe :</label>
                        <div class="col-sm-10">
                            <input name="password_1" id="password_1" class="form-control" type="password" required>
                        </div>
                        @error('password_1')
                        <span class="text text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Confirmer :</label>
                        <div class="col-sm-10">
                            <input name="password_confirmation" id="password_confirmation" class="form-control" type="password" required>
                        </div>
                        @error('password_confirmation')
                        <span class="text text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <input type="submit" class="btn btn-info waves-effect waves-light btn_ajouter" value="Changer">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script type="text/javascript">
    $(document).ready(function(){
        $('#password_form').submit(function(e){
            e.preventDefault();
            
            let password_1 = $('#password_1').val();
            let password_2 = $('#password_confirmation').val();

            if(password_1.length < 6){
                $.notify('Le mot de passe doit contenir au moins 6 caractères', {globalPosition: 'top right', className:'error'});
                return false;
            }
            if(password_1 !== password_2){
                $.notify('Les mots de passe ne correspondent pas', {globalPosition: 'top right', className:'error'});
                return false;
            }

            let formData = $(this).serialize();

            $.ajax({
                url: "{{ route('password.update') }}",
                method: 'PUT',
                data: formData,
                success: function(data) {
                    Swal.fire({
                        title: 'Mot de Passe',
                        icon: 'success',
                        text: data.message
                    }).then(() => {
                        window.location.reload();
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        title: 'Erreur',
                        icon: 'error',
                        text: 'Erreur: ' + xhr.responseJSON.message
                    });
                }
            });
        });
    });
</script>
@endsection