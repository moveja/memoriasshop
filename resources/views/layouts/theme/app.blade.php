<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>MEMORIAS SUPPLY</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico"/>
    
    
    <!-- BEGIN estilos -->
    @include('layouts.theme.styles')
    <!-- estilos -->

</head>
<body class="dashboard-analytics">
    <!-- BEGIN LOADER -->
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>


    <!--  HEADER NAVBAR  -->
    @include('layouts.theme.header')

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  MENU SIDEBAR  -->
        @include('layouts.theme.sidebar')
        <!--  MENU SIDEBAR  -->
        
        <!--  AREA DE CONTENIDO  -->
        <div id="content" class="main-content">

        <div class="layout-px-spacing"> 
            
            <!--  MENU SIDEBAR  -->
            @yield('content')
     


        </div>

        <!--  FOOTER  -->
        @include('layouts.theme.footer')


        </div>
        <!--  AREA DE CONTENIDO  -->

    </div>
 

    <!-- SCRIPTS -->
    @include('layouts.theme.scripts')

</body>
</html>