<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Membership Management System</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
            <!-- App favicon -->
            <link src="{{ asset('assets/images/favicon.ico') }}" rel="stylesheet">
            <!-- App css -->
            <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
            <link rel="stylesheet" href="{{ asset('assets/css/app.min.css') }}">
            <link rel="stylesheet" href="{{ asset('assets/css/icons.min.css') }}">


           
            

            <link rel="stylesheet" href="{{ asset('assets/libs/jsvectormap/css/jsvectormap.min.css') }}">

           
        <!-- Styles -->
        
        <script src="{{ asset('assets/js/app.js') }}"></script>
        <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
        <script src="{{ asset('assets/js/pages/index.init.js') }}"></script>
        <script src="{{ asset('assets/data/stock-prices.js') }}"></script>
        <script src="{{ asset('assets/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
        <script src="{{ asset('assets/libs/jsvectormap/maps/world.js') }}"></script>
       


        
        


      












        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
       <div id="app"></div>

       @vite(['resources/css/app.css','resources/js/app.js'])
        </div>
    </body>
</html>
