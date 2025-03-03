
<div class="modal fade bs-example-modal-center" id="ModalGarde" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Client</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post" id="Form_garde">
                @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="">Nom Complet</label>
                        <input type="text" class="form-control"  name="nom_complet" id="nom_complet" autocomplete="off" >
                    </div>
                
                    <div class="form-group col-sm-6">
                        <label for="">Telephone</label>
                        <input type="text" class="form-control" id="telephone" name="telephone" autocomplete="off">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="">Email</label>
                        <input type="email" class="form-control"  name="email" id="email">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="">Adresse</label>
                        <input type="text" class="form-control"  name="adresse" id="adresse">
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