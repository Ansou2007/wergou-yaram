@extends('layouts.master')
@section('titre1')
Profil
@endsection

@section('contenu')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Profil </h4><br><br>

                <form method="post" id="profil_edit" action="" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Prénom</label>
                        <div class="col-sm-10">
                            <input name="prenom" id="prenom" class="form-control" type="text"
                                value="{{$profil->name}}">
                        </div>
                        @error('prenom')
                        <span class="text text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <!-- end row -->
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Role</label>
                        <div class="col-sm-10">
                            <input name="nom" id="nom" class="form-control" type="text" value="{{$profil->role}}" readonly>
                        </div>
                        @error('nom')
                        <span class="text text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <!-- end row -->


                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Télephone </label>
                        <div class="col-sm-10">
                            <input name="telephone" id="telephone" class="form-control" type="text"
                                value="{{$profil->telephone}}">
                        </div>
                        @error('telephone')
                        <span class="text text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <!-- end row -->
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input name="email" id="email" class="form-control" type="email" value="{{$profil->email}}">
                        </div>
                        @error('email')
                        <span class="text text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    
                    <!-- end row -->

                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Photo Client </label>
                        <div class="form-group col-sm-10">
                            <input name="photo" class="form-control" type="file" id="image"
                                accept="image/jpeg,image/gif,image/png">
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label"> </label>
                        <div class="col-sm-10">
                            <img id="showImage" class="rounded avatar-lg" src="{{asset($profil->photo)}}"
                                alt="Card image cap">
                        </div>
                    </div>
                    <!-- end row -->

                    <input type="submit" class="btn btn-info waves-effect waves-light btn_ajouter" value="Modifier">
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
<script type="text/javascript">
    // Affichage Image
    $(document).ready(function(){

        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });

        $(document).on('submit','#profil_edit',function(e){

            e.preventDefault();

            var prenom = $('#prenom').val();
                var nom = $('#nom').val();
                var telephone = $('#telephone').val();
                var email = $('#email').val();
                if(prenom == ''){
                    $.notify('Prénom  Obligatoire',{globalPosition: 'top right', className:'error' })
                    return false;
                }
                if(nom == ''){
                    $.notify('Nom  Obligatoire',{globalPosition: 'top right', className:'error' })
                    return false;
                }
                if(telephone == ''){
                    $.notify('Télephone Obligatoire',{globalPosition: 'top right', className:'error' })
                    return false;
                }
                if(email == ''){
                    $.notify('Email Obligatoire',{globalPosition: 'top right', className:'error' })
                    return false;
                }

                let formData = new FormData(this);
                formData.append('_method', 'PUT');


            $.ajax({
                url: "{{ route('profil.update') }}",
                method: 'POST',
                data: formData,
                 processData: false,
                 contentType: false,
                success: function(data) {
                    Swal.fire({
                        title: 'Profil',
                        icon: 'success',
                        text: data.message
                    }).then(() => {
                        window.location.reload()
                    })
                },
                error: function(xhr) {

                    Swal.fire({
                        title: 'Profil',
                        icon: 'error',
                        text: 'Erreur: ' + xhr.responseJSON['message']
                    })
                }
            })

                    })

        
    
    });
</script>


@endsection