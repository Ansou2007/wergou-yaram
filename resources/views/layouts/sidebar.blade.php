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
                
                {{-- Gardes --}}
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-user-tag"></i>
                        <span>Mes gardes</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('gardes')}}">Liste Garde</a></li>
                        
                    </ul>
                </li>

                {{-- Pharmacies --}}
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-users"></i>
                        <span>Pharmacies</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('pharmacie')}}">Liste Pharmacies</a></li>
                        
                    </ul>
                </li>


                {{-- Ajustement --}}
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-truck"></i>
                        <span>Notifications</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="#">Liste</a></li>
                    </ul>
                </li>


               
                <hr>
               
                {{-- Utilisateur --}}
                <hr>
                <li class="menu-title">Utilisateur</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class=" fas fa-user"></i>
                        <span>Utilisateur</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="#{{-- {{route('utilisateur.all')}} --}}">Liste des Utilisateurs</a></li>
                        <li><a href="#{{-- {{route('role.all')}} --}}">Roles</a></li>
                    </ul>
                </li>
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
                    </script> © Gestion de Garde.
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end d-none d-sm-block">
                        MICDA.Tous droits reservés.
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>