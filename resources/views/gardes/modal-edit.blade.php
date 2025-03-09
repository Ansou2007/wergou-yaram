
<div class="modal fade bs-example-modal-center" id="ModalGardeEdition" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edition Garde</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post" id="Form_garde_edition">
                @csrf
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" name="garde_id" id="garde_id" class="garde_id">
                    <div class="form-group col-sm-6">
                        <label for="">Pharmacie</label>
                        <select name="pharmacie" id="pharmacie" class="pharmacie form-control form-select">
                            <option value="">Selectionner...</option>
                            @foreach ($pharmacies as $pharmacie )
                                <option value="{{$pharmacie->id}}">{{$pharmacie->nom}}</option>
                            @endforeach
                        </select>
                    </div>
                
                    <div class="form-group col-sm-6">
                        <label for="">Date Debut</label>
                        <input type="date" class="form-control date_debut" id="date_debut" name="date_debut" value="{{Carbon\Carbon::now()->toString()}}" >
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="">Date Fin</label>
                        <input type="date" class="form-control date_fin"  name="date_fin" id="date_fin">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="">Type de Garde</label>
                        <select name="type" id="type"  class="type form-control form-select">
                            <option value="nuit" selected>Nuit</option>
                            <option value="week-end">Week-End</option>
                            <option value="ferie">Férie</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Fermer</button>
                <button type="submit" class="btn btn-primary waves-effect waves-light">Modifier</button>
            </div>
        </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->