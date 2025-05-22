
<div class="modal fade bs-example-modal-center" id="ModalUtilisateur" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Utilisateur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post" id="Form_utilisateur">
                @csrf
            <div class="modal-body">
                <div class="row">

                    <div class="form-group col-sm-6">
                        <label for="">Nom</label>
                        <input type="text" name="nom" id="nom" class="form-control">
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="">Email</label>
                        <input type="email" name="email" id="email" class="form-control">
                    </div>
                
                    <div class="form-group col-sm-6">
                        <label for="">Telephone</label>
                        <input type="number" class="form-control" maxlength="9" id="telephone" name="telephone">
                    </div>
                    
                    <div class="form-group col-sm-6">
                        <label for="">Role</label>
                        <select name="role" id="role"  class="form-control form-select">
                            <option value="" selected>Selectionner...</option>
                            <option value="admin">Admin</option>
                            <option value="pharmacien">Pharmacien</option>
                        </select>
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