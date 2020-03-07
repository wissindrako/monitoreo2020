<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

@section('htmlheader')
    @include('layouts.partials.htmlheader')
@show

<body class="" style="background-color: #1b6ba2;">

<div style="display: none;" id="cargador_empresa" align="center">
        <br>
         <label style="color:#FFF; background-color:#ABB6BA; text-align:center">&nbsp;&nbsp;&nbsp;Espere... &nbsp;&nbsp;&nbsp;</label>

         <img src="{{ url('/img/cargando.gif') }}" align="middle" alt="cargador"> &nbsp;<label style="color:#ABB6BA">Realizando tarea solicitada ...</label>

          <br>
         <hr style="color:#003" width="50%">
         <br>
</div>
<input type="hidden"  id="url_raiz_proyecto" value="{{ url("/") }}" />

<div id="capa_modal" class="div_modal" style="display: none;"></div>
<div id="capa_formularios" class="div_contenido" style="display: none;"></div>


<div class="">

    {{-- @include('layouts.partials.mainheader') --}}

    {{-- @include('layouts.partials.sidebar') --}}

    <!-- Content Wrapper. Contains page content -->
    {{-- <div class=""> --}}

        {{-- @include('layouts.partials.contentheader') --}}

        <!-- Main content -->
        <section  class="content" style="">
            <!-- Your Page Content Here -->

            @yield('main-content')
        </section><!-- /.content -->
    {{-- </div><!-- /.content-wrapper --> --}}

    {{-- @include('layouts.partials.controlsidebar')

    @include('layouts.partials.footer') --}}

</div><!-- ./wrapper -->

@section('scripts')
    @include('layouts.partials.scripts')
@show

</body>
</html>
