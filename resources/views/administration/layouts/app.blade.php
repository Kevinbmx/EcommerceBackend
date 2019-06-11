<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trovare - @yield('title') </title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
</head>
<body>
  <!-- Wrapper-->
    <div id="wrapper">

        <!-- Navigation -->
        @include('administration.layouts.navigation')

        <!-- Page wraper -->
        <div id="page-wrapper" class="gray-bg">

            <!-- Page wrapper -->
            @include('administration.layouts.topnavbar')
    
            <!-- Main view  -->
            @yield('content')

            <!-- Footer -->
            @include('administration.layouts.footer')

        </div>
     
    </div>
    <!-- End wrapper-->

    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>
</html>
