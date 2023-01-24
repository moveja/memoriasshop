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
    @livewireStyles
    <!-- estilos -->

</head>
<body class="dashboard-analytics">
    <!-- BEGIN LOADER -->
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>


    <!--  HEADER NAVBAR  -->
    <div>
    @include('layouts.theme.header')
    </div>
    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  MENU SIDEBAR  -->
        <div>
        @include('layouts.theme.sidebar')
        </div>
        <!--  MENU SIDEBAR  -->
        
        <!--  AREA DE CONTENIDO  -->
        <div id="content" class="main-content">

        <div class="layout-px-spacing"> 
            
            <!--  MENU SIDEBAR  -->
            <div>
            @yield('content')
            </div>
        </div>

        <!--  FOOTER  -->
        <div>
        @include('layouts.theme.footer')
        </div>


        </div>
        <!--  AREA DE CONTENIDO  -->

    </div>
    
    <div>

    <!-- SCRIPTS -->
    
    
    @include('layouts.theme.scripts')
    @livewireScripts
    </div>

</body>
</html>