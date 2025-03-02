<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="{{route('dashboard')}}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{asset('upload/ctu.jpeg')}}" alt="logo-sm" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{asset('upload/ctu.jpeg')}}" alt="logo-dark" height="20">
                    </span>
                </a>

                <a href="{{route('dashboard')}}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{asset('upload/ctu.jpeg')}}" alt="logo-sm-light" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{asset('upload/ctu.jpeg')}}" alt="logo-light" height="20">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                <i class="ri-menu-2-line align-middle"></i>
            </button>

            <!-- App Search-->
            <form class="app-search d-none d-lg-block">
                <div class="position-relative">
                    <input type="text" class="form-control" placeholder="Rechercher...">
                    <span class="ri-search-line"></span>
                </div>
            </form>


        </div>

        <div class="d-flex">

            <div class="dropdown d-inline-block d-lg-none ms-2">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="ri-search-line"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-search-dropdown">

                    <form class="p-3">
                        <div class="mb-3 m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search ...">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i
                                            class="ri-search-line"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="dropdown d-none d-sm-inline-block">
                <button type="button" class="btn header-item waves-effect" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <img class="" src="{{asset('assets/images/flags/french.jpg')}}" alt="Header Language" height="16">
                </button>

            </div>

            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="ri-apps-2-line"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <div class="px-lg-2">
                        <div class="row g-0">
                            <div class="col">
                                <a class="dropdown-icon-item" href="{{-- {{route('pos')}} --}}">
                                    <img src="{{asset('upload/pos.jpeg')}}" alt="POS">
                                    <span>POS</span>
                                </a>
                            </div>


                        </div>


                    </div>
                </div>
            </div>

            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                    <i class="ri-fullscreen-line"></i>
                </button>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon waves-effect"
                    id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ri-notification-3-line"></i>
                    <span class="noti-dot"></span>{{-- {{nbre_notification()}} --}}
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0"> Notifications </h6>
                            </div>
                            <div class="col-auto">
                                <a href="{{-- {{route('notification')}} --}}" class="small"> Voir Tout</a>
                            </div>
                        </div>
                    </div>
                    <div data-simplebar style="max-height: 230px;">

                        @foreach (auth()->user()->notifications as $notification )
                        <a href="" class="text-reset notification-item">
                            <div class="d-flex">
                                <div class="avatar-xs me-3">
                                    <span class="avatar-title bg-success rounded-circle font-size-16">
                                        <i class="ri-checkbox-circle-line"></i>
                                    </span>
                                </div>
                                <div class="flex-1">
                                    <h6 class="mb-1">{{$notification->data['titre']}}</h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1">{{$notification->data['message']}}</p>
                                        <p class="mb-0"><i
                                                class="mdi mdi-clock-outline"></i>{{carbon\Carbon::parse($notification->created_at)->format('d-m-Y:
                                            H:i')}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @endforeach

                    </div>
                    <div class="p-2 border-top">
                        <div class="d-grid">
                            <a class="btn btn-sm btn-link font-size-14 text-center" href="{{-- {{route('notification')}} --}}">
                                <i class=" mdi mdi-arrow-right-circle me-1"></i> Voir +
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="dropdown d-inline-block user-dropdown">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="{{asset(auth()->user()->photo)}}"
                        alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1">{{auth()->user()->prenom}}</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="{{-- {{route('profil',auth()->user()->id)}} --}}"><i
                            class="ri-user-line align-middle me-1"></i>
                        Profil</a>
                    <a class="dropdown-item d-block" href="{{-- {{route('password.edit',auth()->user()->id)}} --}}"><span
                            class="ri-password-2-line align-middle me-1"></i>
                            Mot de Passe</a>

                    <div class="dropdown-divider"></div>
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="dropdown-item text-danger" href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                            <i class="ri-shut-down-line align-middle me-1 text-danger"></i> Déconnexions
                        </a>
                    </form>
                </div>
            </div>

        </div>
    </div>
</header>