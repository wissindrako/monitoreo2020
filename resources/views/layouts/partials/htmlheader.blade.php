<head>
    <meta charset="UTF-8">
    <title> MonitoreoElectoral - @yield('htmlheader_title', 'MonitoreoElectoral') </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    {{-- <meta name="description" content="@yield('description')"> --}}
    <meta name="description" content="Realiza el Control Electoral con el Sistema Monitoreo Electoral, Registrate en el sistema, confirma tu asistencia, selecciona tu(s) mesa(s) asignadas, selecciona el partido político al que ingresaras la cantidad de votos, continúa llenando para todos los partidos incluyendo Nulos y Blancos.">
    {{-- <meta name="keywords" content="@yield('keywords')"> --}}
    <meta name="keywords" content="Monitoreo Electoral, MonitoreoElectoral, elecciones 2019, elecciones bolivia, elecciones, ajllita, control">
    <!-- Bootstrap 3.3.4 -->
    <link href="{{ asset('/css/bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ url('css/mycustom.css') }}">
    <!-- Font Awesome Icons -->
    <link href="{{ asset('/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
 
    <!-- Theme style -->
    <link href="{{ asset('/css/AdminLTE.css') }}" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    {{-- <link href="{{ asset('/css/skins/skin-blue.css') }}" rel="stylesheet" type="text/css" /> --}}
    <link href="{{ asset('/css/skins/_all-skins.css') }}" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="{{ asset('/plugins/iCheck/square/blue.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('/plugins/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />


    <link href="{{ asset('/css/ajllita.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/css/alertify.css') }}" rel="stylesheet" type="text/css" />

    <!-- Favicon and touch icons -->
    <link rel="icon" type="/image/png" href="{{ asset('favicon.png') }}"/>

    {{--  --}}
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}"/>

    <link rel="stylesheet" href="{{ asset('/bower_components/fullcalendar/dist/fullcalendar.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('/bower_components/fullcalendar/dist/fullcalendar.print.min.css') }}" media="print"/>
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
