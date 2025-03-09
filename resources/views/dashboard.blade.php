@extends('layouts.master')
@section('titre1')
Tableau de Bord
@endsection
@section('titre2')
Tableau de Bord
@endsection
@section('contenu')
<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-truncate font-size-14 mb-2">Nbre Gardes</p>
                        <h4 class="mb-2">00</h4>
                        <a href="#"><i class="fas fa-eye"></i>&nbspVoir</a>
                    </div>
                    <div class="avatar-sm">
                        <span class="avatar-title bg-light text-primary rounded-3">
                            <i class="ri-shopping-cart-2-line font-size-24"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-truncate font-size-14 mb-2">Nbre Pharmacie</p>
                        <h4 class="mb-2">00</h4>
                        <a href="#"><i class="fas fa-eye"></i>&nbspVoir</a>
                    </div>
                    <div class="avatar-sm">
                        <span class="avatar-title bg-light text-success rounded-3">
                            <i class="mdi mdi-package-variant-closed font-size-24"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-truncate font-size-14 mb-2">Nbre Notification</p>
                        <h4 class="mb-2">0</h4>
                        <a href="#"><i class="fas fa-eye"></i>&nbspVoir</a>
                    </div>
                    <div class="avatar-sm">
                        <span class="avatar-title bg-light text-primary rounded-3">
                            <i class="ri-user-3-line font-size-24"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

   

</div>
@endsection
 

 
