<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!-- User details -->
        <div class="user-profile text-center mt-3">
            <div class="">
                <img src="{{asset(auth()->user()->photo)}}" alt="" class="avatar-md rounded-circle">
            </div>
            <div class="mt-3">
                <h4 class="font-size-16 mb-1">{{auth()->user()->prenom}}</h4>
                <span class="text-muted"><i class="ri-record-circle-line align-middle font-size-14 text-success"></i>
                    En ligne</span>
            </div>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>
                <li>
                    <a href="{{route('dashboard')}}" class="waves-effect">
                        <i class="ri-dashboard-line"></i><span class="badge rounded-pill bg-success float-end"></span>
                        <span>Dashboard</span>
                    </a>
                </li>
                
                @role(['super admin','admin'])
                {{-- Fournisseur --}}
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-user-tag"></i>
                        <span>Gestion Fournisseur</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('fournisseur')}}">Tous les fournisseurs</a></li>
                        
                    </ul>
                </li>
                @endrole

                {{-- Client --}}
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-users"></i>
                        <span>Gestion Client</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('client')}}">Tous les clients</a></li>
                        
                    </ul>
                </li>

                @role(['super admin','admin','vendeur'])
                {{-- Produits --}}
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-box"></i>
                        <span>Gestion Produit</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('produit')}}">Produits</a></li>
                        <li><a href="{{route('categorie')}}">Catégories</a></li>
                        <li><a href="{{route('marque')}}">Marques</a></li>
                        <li><a href="{{route('unite')}}">Unités</a></li>
                        <li><a href="{{route('variation')}}">Variation</a></li>
                        <li><a href="javascript:void(0)">Imprimer Code barre</a></li>
                    </ul>
                </li>
                @endrole

                @role(['super admin','admin'])
                {{-- Entrée --}}
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-truck"></i>
                        <span>Gestion Achat</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('achat')}}">Liste</a></li>
                        <li><a href="#{{-- {{route('approvisionnement.rapport')}} --}}">Rapport Journalier</a></li>
                    </ul>
                </li>
                @endrole

                @role(['super admin','admin'])
                {{-- Ajustement --}}
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-truck"></i>
                        <span>Gestion Ajustement</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('ajustement')}}">Liste</a></li>
                    </ul>
                </li>
                @endrole

                @role(['admin','super admin','vendeur'])
                {{-- Vente --}}
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-money-bill"></i>
                        <span>Gestion Vente</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('vente')}}">Liste</a></li>
                        <li><a href="{{route('pos')}}">POS</a></li>
                    </ul>
                </li>
                @endrole


                {{-- Entrepot --}}
                @role(['super admin','admin'])
                <li>
                    <a href="{{route('magasin')}}" class="">
                        <i class="fas fa-home"></i>
                        <span>Magasin</span>
                    </a>

                </li>
                @endrole

               
                {{-- Stock --}}
                <hr>
                <li class="menu-title">Stock</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class=" fas fa-shopping-bag"></i>
                        <span>Gestion Stock</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="#{{-- {{route('stock.rapport')}} --}}">Rapport de Stock</a></li>
                        <li><a href="#{{-- {{route('stock.fournisseur')}} --}}">Stock/Fournisseur</a></li>
                        <li><a href="#{{-- {{route('stock.niveau')}} --}}">Niveau Stock</a></li>
                    </ul>
                </li>
                {{-- Utilisateur --}}
                <hr>
                @role(['super admin'])
                <li class="menu-title">Utilisateur</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class=" fas fa-user"></i>
                        <span>Utilisateur</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="#{{-- {{route('utilisateur.all')}} --}}">Liste des Utilisateurs</a></li>
                        <li><a href="#{{-- {{route('permission.all')}} --}}">Permissions</a></li>
                        <li><a href="#{{-- {{route('role.all')}} --}}">Roles</a></li>
                        <li><a href="#{{-- {{route('assignation.all')}} --}}">Assignation Roles</a></li>
                        <li><a href="#{{-- {{route('autorisation.create')}} --}}">Autorisation</a></li>
                    </ul>
                </li>
                @endrole
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>

{{-- Contenu --}}
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">@yield('titre1')</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Stock</a></li>
                                <li class="breadcrumb-item active">@yield('titre2')</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            @yield('contenu')
        </div>
    </div>

    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <script>
                        document.write(new Date().getFullYear())
                    </script> © Gestion de Stock.
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end d-none d-sm-block">
                        Copyright BIBA & MK Transit.Tous droits reservés.
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>