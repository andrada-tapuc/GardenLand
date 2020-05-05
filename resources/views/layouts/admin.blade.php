<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Garden Land | Dashboard </title>

@section('styles')
    <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="{{ asset('/plugins/fontawesome-free/css/all.min.css') }}">
        <!-- IonIcons -->
        <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('/adminApp/css/adminlte.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/css/admin.css') }}">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
        <style>
            .user_name{
                color:white;
            }

            .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active, .sidebar-light-primary .nav-sidebar>.nav-item>.nav-link.active{
                background-color: #29e84e87;
            }
        </style>
    @show

</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
    </nav>

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="info">
                    <h3 class="user_name">Bună, {{\Auth::user()->name}}!</h3>
                </div>
            </div>

            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item has-treeview menu-open">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas fa-robot"></i>
                            <p> Produse<i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/admin/products/show" class="nav-link">
                                    <i class="far fa-list-alt nav-icon"></i>
                                    <p>Toate Produsele</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/products/create" class="nav-link">
                                    <i class="far fa-plus-square nav-icon"></i>
                                    <p>Crează Produs</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item has-treeview menu-open">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas fa-robot"></i>
                            <p>Servicii<i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/admin/services/show" class="nav-link">
                                    <i class="far fa-list-alt nav-icon"></i>
                                    <p>Toate Serviciile</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/services/create" class="nav-link">
                                    <i class="far fa-plus-square nav-icon"></i>
                                    <p>Crează Serviciu</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item has-treeview menu-open">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas fa-robot"></i>
                            <p>Categorii <i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/admin/categories/products/show" class="nav-link">
                                    <i class="far fa-list-alt nav-icon"></i>
                                    <p>Categorii Produse</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="/admin/categories/products/create" class="nav-link">
                                    <i class="far fa-plus-square nav-icon"></i>
                                    <p>Crează Categorie Produse</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="/admin/categories/services/show" class="nav-link">
                                    <i class="far fa-list-alt nav-icon"></i>
                                    <p>Categorii Servicii</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="/admin/categories/services/create" class="nav-link">
                                    <i class="far fa-plus-square nav-icon"></i>
                                    <p>Crează Categorie Servicii</p>
                                </a>
                            </li>

                        </ul>
                    </li>


                    <li class="nav-header">Alte Opțiuni</li>

                    <li class="nav-item">
                        <a href="/admin/documentation" class="nav-link">
                            <i class="nav-icon far fa-file"></i>
                            <p>Documentatie Pagina</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/admin/inbox" class="nav-link">
                            <i class="nav-icon far fa-envelope"></i>
                            <p>Inbox</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/" class="nav-link">
                            <i class="nav-icon glyphicon glyphicon-globe"></i>
                            <p>Back to website</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{url('logout')}}" class="nav-link">
                            <i class="nav-icon glyphicon glyphicon-log-out"></i>
                            <p>Logout</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <div class="content-wrapper">
        <div class="content-header">
        </div>
        <div class="content">
            @yield('content')
        </div>
    </div>

    <footer class="tm-footer text-center">
        <p>Copyright &copy; 2020 GardenLand
            | Design: <a rel="nofollow" href="/"> ##</a></p>
    </footer>
</div>
@section('scripts')
    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">


    <!-- AdminLTE -->
    <script src="{{ asset('adminApp/js/adminlte.js') }}"></script>

    <!-- OPTIONAL SCRIPTS -->
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('adminApp/js/demo.js') }}"></script>
    <script src="{{ asset('adminApp/js/pages/dashboard3.js') }}"></script>
@show
</body>
</html>
