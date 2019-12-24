<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Bona | @yield('title')</title>
    <!-- Favicon-->
    <link rel="icon" href="" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet"
        type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <!-- Toastr Css -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <!-- Sweetalert2 Css -->
    {{-- <link rel="stylesheet" href="sweetalert2/dist/sweetalert2.min.css"> --}}
    <!-- Bootstrap Core Css -->
    <link href="{{ asset('/backend/css/bootstrap.css')}}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{ asset('/backend/css/waves.css')}}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{ asset('/backend/css/animate.css')}}" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{ asset('/backend/css/style.css')}}" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{ asset('/backend/css/all-themes.css')}}" rel="stylesheet" />
    @stack('css')
</head>

<body class="theme-purple">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->

    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->

    <!-- Nav Bar -->
    @include('backend.includes.nav')
    <!-- #END# Nav Bar -->

    <!-- Aside Bar -->
    @include('backend.includes.aside')
    <!-- #END# Aside Bar -->


    @yield('content')


    <!-- Jquery Core Js -->
    <script src="{{ asset('/backend/js/jquery.min.js') }}"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{ asset('/backend/js/bootstrap.js') }}"></script>

    <!-- Select Plugin Js -->
    <script src="{{ asset('/backend/js/bootstrap-select.js') }}"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="{{ asset('/backend/js/jquery.slimscroll.js') }}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{ asset('/backend/js/waves.js') }}"></script>

    <!-- Custom Js -->
    <script src="{{ asset('/backend/js/admin.js') }}"></script>

    <!-- Demo Js -->
    <script src="{{ asset('/backend/js/demo.js') }}"></script>
    <!-- Sweet Alert2 Js -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.5.3/dist/sweetalert2.all.min.js"></script>
    <!-- Toastr Js -->
    <script src="https://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::message() !!}
    <script>
        @if ($errors->any())  
            @foreach ($errors->all() as $error)
                toastr.error('{{ $error }}', 'Error',{
                    closeButton:true,
                    progressBar: true,
                });
            @endforeach 
        @endif
    </script>

    @stack('js')

</body>

</html>