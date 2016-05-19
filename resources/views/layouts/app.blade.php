<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Reportes DTI</title>
        <!-- Fonts -->
        
        <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="/jquery-ui/jquery-ui.min.css">
        <link rel="stylesheet" href="/jquery-ui/jquery-ui.theme.min.css">
        <link rel="stylesheet" href="/js/vendor/semanticui/semantic.min.css">
        
        <link rel="stylesheet" href="/css/app.css">
        <!-- custom -->
        <script src="/js/vendor/jquery/jquery-1.11.3.js"></script>
        <script src="/js/vendor/footable/jquery.bdt.js"></script>
        <link rel="stylesheet" href="/js/vendor/footable/jquery.bdt.css">
        <link rel="stylesheet" type="text/css" href="/css/vendor/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="/css/vendor/bootstrap/css/bootstrap-theme.css">
        <link rel="stylesheet" href="/css/vendor/footable/footable.bootstrap.css">
        <link rel="stylesheet" href="/css/vendor/font-awesome/css/font-awesome.css">
        <link rel="stylesheet" type="text/css" href="/css/vendor/sweetalert/dist/sweetalert.css">
        <script type="text/javascript" src="/js/vendor/sweetalert/dist/sweetalert.min.js"></script>
        <link rel="stylesheet" href="/js/vendor/dropzone/dropzone.css">
        <script src="/js/vendor/footable/sortelement.js"></script>
        
        
        
        <script src="/js/vendor/exportarexcell/excellentexport.js"></script>
        <script src="/js/vendor/semanticui/semantic.min.js"></script>
        <style>
        body {
        font-family: 'Lato';
        }
        .fa-btn {
        margin-right: 6px;
        }
        </style>
    </head>
    <body id="app-layout">

        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        Reportes DTI
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li><a href="{{ url('/home') }}" >Home</a></li>
                        @if (!Auth::guest())
                        <!-- Reportes drop down para oralce/sistemas -->
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-      expanded="false">
                                <i ></i>Reportes<span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="/oracle">Oracle</a>
                                    <a href="/srvmast">SRVMAST</a>
                                    <a href="/vicalvaro">Vicalvaro</a>
                                    <a href="/francia">Francia</a>
                                    <a href="/australia">Australia</a>
                                    <a href="/china">China</a>
                                </li>
                            </ul>
                        </li>
                        @endif
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                        @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                        @endif
                    </ul>
                </div>
            @if(Session::has('modificado'))
                <script type="text/javascript">
                    sweetAlert("Modificado", "{{Session::get('modificado')}}", "success");
                </script>
            @endif
            @if(Session::has('creado'))
                <script type="text/javascript">
                    sweetAlert("Creado", "{{Session::get('creado')}}", "success");
                </script>
            @endif
           
            </div>
        </nav>
        @yield('content')
        <!-- JavaScripts -->
        
        <script src="/jquery-ui/jquery-ui.js"></script>
        <script src="/js/vendor/footable/footable.js"></script>
        <script src="/js/vendor/bootstrap/js/bootstrap.js"></script>
        <script src="/js/vendor/vue/vue.js"></script>
        <script src="/js/vendor/vue/vue-resource/dist/vue-resource.js"></script>
        <script src="/js/vendor/jquery.validate.js"></script>
        <script src="/js/customValidate.js"></script>
        <script src="/js/vendor/dropzone/dropzone.js"></script>
        {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
        @yield('scripts')
        <script>
        // Inicialiar la taba
        $(document).ready( function () {
        $('#bootstrap-table').bdt();
        });
        </script>
    </body>
</html>