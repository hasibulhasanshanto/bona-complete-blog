<!doctype html> 
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Bona Blog') }}</title>
    <!-- Scripts -->
    <!-- Font -->        
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
        
<!-- Toastr Css -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <!-- Stylesheets -->        
    <link href="{{ asset('/frontend/css/bootstrap.css') }}" rel="stylesheet">        
    <link href="{{ asset('/frontend/css/swiper.css') }}" rel="stylesheet">        
    <link href="{{ asset('/frontend/css/ionicons.css') }}" rel="stylesheet">
        
    @stack('css')


</head>

<body> 

    @include('frontend.includes.nav')
    
    @yield('hero')

    @yield('main-body')
   
    @include('frontend.includes.footer')

<script src="{{ asset('/frontend/js/jquery-3.1.1.min.js')}}"></script>
        
<script src="{{ asset('/frontend/js/tether.min.js')}}"></script>
        
<script src="{{ asset('/frontend/js/bootstrap.js')}}"></script>
        
<script src="{{ asset('/frontend/js/swiper.js')}}"></script>
        
<script src="{{ asset('/frontend/js/scripts.js')}}"></script>
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
</body>

</html>