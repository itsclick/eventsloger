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
            
            <link rel="stylesheet" href="{{ asset('assets/css/app.min.css') }}">
            <link rel="stylesheet" href="{{ asset('assets/css/vendors.min.css') }}">
            <link rel="stylesheet" href="{{asset ('assets/plugins/jsvectormap/jsvectormap.min.css') }}"  />
            <link rel="stylesheet" href="{{asset ('assets/plugins/spinkit/spinkit.min.css') }}"  />


           

            
            

           


           
            

            

           
        <!-- Styles -->
        
        <script src="{{ asset('assets/js/config.js') }}"></script>
        <script src="{{ asset('assets/js/vendors.min.js') }}"></script>
          <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
            <script src="{{ asset('assets/plugins/jsvectormap/jsvectormap.min.js') }}"></script>
            <script src="{{ asset('assets/js/maps/us-aea-en.js') }}"></script>
            <script src="{{ asset('assets/js/maps/us-lcc-en.js') }}"></script>
           <script src="{{ asset('assets/js/maps/us-mill-en.js') }}"></script>
           <script src="{{ asset('assets/js/pages/custom-table.js') }}"></script>
           <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>
           <script src="{{ asset('assets/js/app.js') }}"></script>


          



           







     


    <!-- Apex Charts js -->
  

    <!-- Vector Map Js -->
  
    
    

    <!-- Custom table -->
    

    <!-- Dashboard js -->
    
        



        







        
       


        
        


      












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
