
@extends('layouts.area')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')
<section  id="contenido_principal">
<section  id="content">

    <div class="" >
        <div class="container"> 
                      
                <div class="col-sm-12 " style="background-color:rgba(0, 0, 0, 0.35); height: 60px; " >
                    {{-- <br> --}}
                        {{-- <span style='font-size: 34px; color:white;' class=""> <b>MonitoreoElectoral</b> </span> --}}
                        {{-- <a class="mybtn-social pull-right" href="{{ url('/register') }}">
                            Register
                       </a> --}}
     
                       {{-- <a class="mybtn-social pull-right" href="{{ url('/login') }}"> --}}
                       <a class="mybtn-social pull-right" href="{{ url('/login') }}">
                        Ingresar al conteo de votos
                       </a>
                       {{-- <a class="mybtn-social pull-right" href="{{ url('/form_consulta') }}">
                        Consultar Mesas
                   </a> --}}
                    
                     </div>
            <div class="row">
              <div class="col-sm-8 col-sm-offset-2 myform-cont" >
                
                    <div class="myform-top" style="text-align:center">
                        <div style="float:center; text-align:center" class="box-body box-profile">
                           <img style="float:center; text-align:center" src="{{ url('img/comunidad-ciudadana.png') }}" class="profile-user-img img-responsive" />
                          <h3 style="float:center; color:gray"><b>Consulte que mesa se le asignó para el Control Electoral</b></h3>
                            {{-- <p>Ingrese su número de Carnet</p> --}}
                        </div>
                        {{-- <div class="myform_top_right_img"> --}}
                          {{-- <img  src="{{ url('img/comunidad.jpg') }}" style="width:100px;height:80px;" class="" /> --}}
                        {{-- </div> --}}
                    </div>


                    <div id="div_notificacion_sol" class="myform-bottom">

                      
                    <form action="{{ url('') }}"  method="post" id="f_enviar_agregar_persona" class="formentrada" >
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @if (Auth::guest())
                        <input type="hidden" id="admin" value="0">
                        @else
                            @if (Auth::user()->isRole('admin')==true || Auth::user()->isRole('super_admin')==true)
                            <input type="hidden" id="admin" value="1">
                            @else
                            <input type="hidden" id="admin" value="0">
                            @endif
                        @endif
                      <input type="hidden">
                      <div class="col-md-12"><br></div>
                      <div class="row">
                            <div class="col-md-12">
                                <div class="form-group" style="text-align:center">
                                    <label style='font-size: 20px; color:white; '>Ingrese su número de Carnet</label>
                                    <input style='font-size: 35px; color:black; height: 50px; font-weight:bold;' type="number" name="cedula" id="input_cedula" placeholder="" class="form-control" value="" pattern="[0-9]{6,9}" onkeydown="return event.keyCode !== 69"  required/>
                                </div>
                            </div>
                        </div>

                        {{-- <button type="submit" class="mybtn">Buscar</button> --}}

                        <div class="row">
                            <br>
                        </div>
                        <div class="row">
                            <div class="box box-default" id="div_usuarios_encontrados">
                                <div  class="box-header">
                                    <h3 class="box-title"><b>Resultados Encontrados</b></h3>
                                </div>
                                <div class="box-body table-responsive no-padding scrollable">
                                    <table class="table table-bordered" id="tabla_cedula">
                                        <thead>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <br><br>
                               
                        <div class="row">
                        <a href="{{ url('https://youtu.be') }}" target="_blank">
                        <div class="">
                            <div class="box box-widget widget-user-2" style="color:black; background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#09de5a), color-stop(100%,#138541)); -webkit-box-shadow: inset 0px 0px 6px #fff; border-radius: 10px;">
                                <div class="widget-user-header bg-white">
                                    <div class="widget-user-image">
                                        <img class="img-circle" src="{{ url('img/youtube.png') }}" style="width:65px;height:65px;" alt="User Avatar">
                                    </div>
                                    <h3 class=""><b></b></h3>
                                <h3 style="font-size: 20px;" class="widget-user-username"><b>Video tutorial de manejo del sistema <br> MonitoreoElectoral.com</b> <br> (Para delegados de mesa)</h3>
                                <h7 class=""><br></h7>
                                {{-- <h5 class=""><b></b></h5> --}}
                                {{-- <h3 class="widget-user-desc">Votos: <b>asdfadsfadsfs</b></h3> --}}

                            </div>
                            </div>
                        </div>
                        </a>
                        <a href="{{ url('/docs/Manual Monitoreo Electoral.pdf') }}" target="_blank">
                            <div class="">
                                <div class="box box-widget widget-user-2" style="color:black; background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#09de5a), color-stop(100%,#138541)); -webkit-box-shadow: inset 0px 0px 6px #fff; border-radius: 10px;">
                                    <div class="widget-user-header bg-white">
                                        <div class="widget-user-image">
                                            <img class="img-circle" src="{{ url('img/pdf.jpg') }}" style="width:65px;height:65px;" alt="User Avatar">
                                        </div>
                                        <h3 class=""><b></b></h3>
                                    <h3  style="font-size: 20px;" class="widget-user-username"><b>Manual de manejo del sistema <br> MonitoreoElectoral.com</b> <br> (Para delegados de mesa)</h3>
                                    <h7 class=""><br></h7>
                                    {{-- <h5 class=""><b>asdfadfadf</b></h5>
                                    <h3 class="widget-user-desc">Votos: <b>asdfadsfadsfs</b></h3> --}}
    
                                </div>
                                </div>
                            </div>
                        </a>
                        <a href="{{ url('/docs/Manual defensa del voto RESUMEN.pdf') }}" target="_blank">
                            <div class="">
                                <div class="box box-widget widget-user-2" style="color:black; background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#09de5a), color-stop(100%,#138541)); -webkit-box-shadow: inset 0px 0px 6px #fff; border-radius: 10px;">
                                    <div class="widget-user-header bg-white">
                                        <div class="widget-user-image">
                                            <img class="img-circle" src="{{ url('img/pdf.jpg') }}" style="width:65px;height:65px;" alt="User Avatar">
                                        </div>
                                        <h3 class=""><b></b></h3>
                                    <h3  style="font-size: 20px;" class="widget-user-username"><b>Manual de defensa del Voto (Resumen) <br> MonitoreoElectoral.com</b> <br> (Para delegados de mesa)</h3>
                                    <h7 class=""><br></h7>
                                    {{-- <h5 class=""><b>asdfadfadf</b></h5>
                                    <h3 class="widget-user-desc">Votos: <b>asdfadsfadsfs</b></h3> --}}
    
                                </div>
                                </div>
                            </div>
                        </a>
                        <a href="{{ url('/docs/Manual defensa del voto COMPLETO.pdf') }}" target="_blank">
                            <div class="">
                                <div class="box box-widget widget-user-2" style="color:black; background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#09de5a), color-stop(100%,#138541)); -webkit-box-shadow: inset 0px 0px 6px #fff; border-radius: 10px;">
                                    <div class="widget-user-header bg-white">
                                        <div class="widget-user-image">
                                            <img class="img-circle" src="{{ url('img/pdf.jpg') }}" style="width:65px;height:65px;" alt="User Avatar">
                                        </div>
                                        <h3 class=""><b></b></h3>
                                    <h3  style="font-size: 20px;" class="widget-user-username"><b>Manual de defensa del Voto (Completo) <br> MonitoreoElectoral.com</b> <br> (Para delegados de mesa)</h3>
                                    <h7 class=""><br></h7>
                                    {{-- <h5 class=""><b>asdfadfadf</b></h5>
                                    <h3 class="widget-user-desc">Votos: <b>asdfadsfadsfs</b></h3> --}}
    
                                </div>
                                </div>
                            </div>
                        </a>
                        <a href="{{ url('/docs/Manual Monitoreo Electoral.pdf') }}" target="_blank">
                            <div class="">
                                <div class="box box-widget widget-user-2" style="color:black; background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#09de5a), color-stop(100%,#138541)); -webkit-box-shadow: inset 0px 0px 6px #fff; border-radius: 10px;">
                                    <div class="widget-user-header bg-white">
                                        <div class="widget-user-image">
                                            <img class="img-circle" src="{{ url('img/pdf.jpg') }}" style="width:65px;height:65px;" alt="User Avatar">
                                            
                                        </div>
                                        <h3 class=""><b></b></h3>
                                    <h3  style="font-size: 20px;" class="widget-user-username"><b>Lista general de delegados de mesas</b></h3>
                                    <h7 class=""><br></h7>
                                    {{-- <h5 class=""><b>asdfadfadf</b></h5>
                                    <h3 class="widget-user-desc">Votos: <b>asdfadsfadsfs</b></h3> --}}
    
                                </div>
                                </div>
                            </div>
                        </a>
                    </div>
                        {{-- <a href="{{ url('https://youtu.be/tMWkeBIohBs') }}" target="_blank" class="btn btn-block btn-social btn-google btn-lg">
                                <i class="fa fa-youtube-play"></i> Video Tutorial
                            </a>
                            <br><br>
                            
                            <a href="{{ url('/docs/Manual Monitoreo Electoral.pdf') }}" target="_blank" class="btn btn-block btn-social btn-default btn-lg">
                                <i class="fa fa-file-pdf-o"></i> Manual Monitoreo Electoral
                            </a>
                            <br><br>
                            <a class="btn btn-block btn-social btn-default btn-lg">
                                <i class="fa fa-file-pdf-o"></i> Lista de Mesas Asignadas
                            </a> --}}
                      </form>
                    
                    </div>
              </div>
            </div>

        </div>
      </div>


 
</section>

</section>
@endsection


@section('scripts')
	
@parent
<script>
    
	function activar_mesas() {

    // Ocultando Divs al iniciar

    $("#div_usuarios_encontrados").hide();


    $( "#input_cedula" ).keyup(function() {
        
        $("#tabla_cedula tbody").html("");
        var cedula = $("#input_cedula").val();
        var cedula_sin_espacios = cedula.trim();
        if (cedula_sin_espacios == "") {
            $("#tabla_cedula tbody").html("");
            $("#div_usuarios_encontrados").hide();
        } else {
            // $.getJSON("consultaRecintosPorRecinto/"+recinto+"",{},function(objetosretorna){
            $.getJSON("consultaMesaAsignada/"+cedula_sin_espacios+"",{},function(objetosretorna){
                $("#tabla_cedula tbody").html("");
                $("#div_usuarios_encontrados").show();
                $("#error").html("");
                var admin = $("#admin").val();
                var TamanoArray = objetosretorna.length;
                $.each(objetosretorna, function(i,datos){
                    var mesas = "";
                    if (datos.mesas === null) {
                        mesas = "";
                    }else{
                        if (admin === '1') { //si es administrador
                            mesas = datos.mesas;
                        } else {
                            mesas = datos.mesas_oep;
                        }
                    }

                    var nuevaFila =
                    "<tr>"
                    // +"<td>"+datos.nombre_completo+"</td>"
                    +"<td colspan=2><div class='box box-widget widget-user'><div class='widget-user-header bg-orange'><h4 style='white-space: normal;'><b>"+datos.nombre_completo+"</b></h4><h4 style='white-space: normal;'>"+datos.description+"</h4></div></td>"
                    +"</tr>"
                    +"<tr>"
                    // +"<td>"+datos.ci+"</td>"
                    // +"<td>"+datos.fecha_nacimiento+"</td>"
                    // +"<td>"+datos.contacto+"</td>"
                    +"<td width='50%'><div class='description-block'><h3><b>C - "+datos.circunscripcion+"</b></h3></div></td>"
                    +"<td width='50%'><div class='description-block'><h3><b>D - "+datos.distrito+"</b></h3></div></td>"
                    +"</tr>"
                    +"<tr>"
                    +"<td  colspan=2><div class='description-block'><h3><b>Recinto</b></h3><p style='font-size: 20px; white-space: normal;'>"+datos.nombre_recinto+"</p></div></td>"
                    +"</tr>"
                    +"<tr>" 
                    +"<td  colspan=2><div class='description-block'><h3><b>Mesa Designada</b></h3><span style='font-size: 20px; white-space: normal;'>"+mesas+"</span></div></td>"
                    +"</tr>"
                    +"<tr>"
                    +"<td colspan=2><a href='"+datos.geolocalizacion+"' target='_blank' class='btn btn-success btn-lg btn-block'><i class='fa fa-map-marker'></i> ¿Cómo llegar?</a></td>"
                    +"</tr>";
                    $(nuevaFila).appendTo("#tabla_cedula tbody");
                });
                if(TamanoArray==0){
                    var nuevaFila =
                    "<tr><td colspan=6>No se encontraron resultados para su busqueda</td>"
                    +"</tr>";
                    $(nuevaFila).appendTo("#tabla_cedula tbody");
                }
            });
        }
        
    });
    

	
	}	
	activar_mesas();
	
	
	</script>
@endsection