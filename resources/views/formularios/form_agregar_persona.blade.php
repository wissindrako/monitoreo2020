
@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')
<section  id="contenido_principal">
<section  id="content">

    <div class="" >
        <div class="container"> 
            <div class="row">
              <div class="col-sm-10 myform-cont" >
                
                     <div class="myform-top">
                        <div class="myform-top-left">
                           {{-- <img  src="" class="img-responsive logo" /> --}}
                          <h3>Agregar Persona</h3>
                            <p>Por favor llene los siguientes campos</p>
                        </div>
                        <div class="myform-top-right">
                          <i class="fa fa-user-plus"></i>
                        </div>
                    </div>

                  <div class="col-md-12" >
                    @if (count($errors) > 0)
                     
                        <div class="alert alert-danger">
                            <strong>UPPS!</strong> Error al Registrar<br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    
                    @endif
                   </div>

                    <div id="div_notificacion_sol" class="myform-bottom">
                        <div class="box box-default" id="div_usuarios_encontrados">
                            <div  style="background-color:#111111; text-align:center; color:white" class="box-header">
                                <h3 class="box-title"><b>Usuarios Encontrados</b></h3>
                            </div>
                            <div class="box-body table-responsive no-padding scrollable">
                                <table class="table table-bordered" id="tabla_cedula">
                                    <thead>
                                    <tr>
                                        <th style="background-color:#3c8dbc; text-align:center; color:white">Nombre</th>
                                        <th style="background-color:#3c8dbc; text-align:center; color:white">Carnet</th>
                                        <th style="background-color:#3c8dbc; text-align:center; color:white">Nacimiento</th>
                                        <th style="background-color:#3c8dbc; text-align:center; color:white">Contacto</th>
                                        {{-- <th style="background-color:#3c8dbc; text-align:center; color:white">Circ.</th>
                                        <th style="background-color:#3c8dbc; text-align:center; color:white">Distrito</th> --}}
                                        <th style="background-color:#3c8dbc; text-align:center; color:white">Recinto</th>
                                        <th style="background-color:#3c8dbc; text-align:center; color:white">Rol</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                      
                    <form action="{{ url('agregar_persona') }}"  method="post" id="f_enviar_agregar_persona" class="" enctype="multipart/form-data">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <div class="col-md-8">
                            <div class="form-group">
                                <label >Carnet</label>
                                <input type="input" name="cedula" id="input_cedula" placeholder="" class="form-control" value="{{ old('cedula') }}" pattern="[0-9]{6,9}" required/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label >Complemento SEGIP</label>
                                <input type="input" name="complemento" placeholder="" class="form-control" value="{{ old('complemento') }}" />
                            </div>
                        </div>
                        {{-- <div class="col-md-4">
                            <div class="form-group">
                                <label >Expedido</label>
                                <select class="form-control" name="expedido">
                                    <option>LP</option>
                                    <option>OR</option>
                                    <option>PT</option>
                                    <option>CB</option>
                                    <option>SC</option>
                                    <option>BN</option>
                                    <option>PA</option>
                                    <option>TJ</option>
                                    <option>CH</option>
                                </select>
                            </div>
                        </div> --}}
                        <div class="col-md-12">
                            <div class="form-group">
                                <label >Nombres</label>
                                <input type="input" name="nombres" placeholder="" class="form-control" value="{{ old('nombres') }}"  required/>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label >Paterno</label>
                                <input type="input" name="paterno" placeholder="" class="form-control" value="{{ old('paterno') }}" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label >Materno</label>
                                <input type="input" name="materno" placeholder="" class="form-control" value="{{ old('materno') }}" />
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class=" ">Fecha de nacimiento</label>
                                <input style='line-height: initial;' type="date" name="nacimiento" placeholder="" min="1939-01-01" max="2002-01-01" class="form-control" value="{{ old('nacimiento') }}" required />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label >Celular - Contacto de Ref.</label>
                                <input type="input" name="telefono" placeholder="" class="form-control" value="{{ old('telefono') }}" pattern="[0-9]{6,9}" onkeydown="return event.keyCode !== 69" title="Introduzca un número valido" required/>
                            </div>
                        </div>
                        {{-- <div class="col-md-6">
                            <div class="form-group">
                                <label >Contacto de Referencia</label>
                                <input type="text" name="telefono_ref" placeholder="" class="form-control" value="{{ old('telefono_ref') }}" pattern="[0-9]{8}" data-inputmask="&quot;mask&quot;: &quot;99999999&quot;" data-mask="" title="Introduzca un número valido" required/>
                            </div>
                        </div> --}}
                        {{-- <div class="col-md-12">
                            <div class="form-group">
                                <label >Dirección</label>
                                <input type="input" name="direccion" placeholder="Domicilio" class="form-control" value="{{ old('direccion') }}" required/>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label >Email</label>
                                <input type="email" name="email" placeholder="Correo electrónico" class="form-control" value="{{ old('email') }}" />
                            </div>
                        </div> --}}
                        {{-- <div class="col-md-12">
                            <div class="form-group">
                                <label >Grado de apoyo y compromiso en las Elecciones - (1 al 5)</label>
                                <select class="form-control" name="grado_compromiso" required>
                                    <option value="" selected> --- SELECCIONE UN NIVEL --- </option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                        </div> --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-black">Designación</label>
                                <div class="form-group bg-gray">
                                    <select  class="form-control" name="rol_slug" id="rol_slug"  required>
                                        <option value="" selected> --- SELECCIONE UNA TAREA --- </option>

                                        @if (Auth::user()->isRole('admin')==true || Auth::user()->isRole('super_admin')==true)
                                        @foreach ($roles as $rol)
                                            {{-- <option value={{$rol->slug}} {{$rol->slug == 'militante' ? 'selected' : ''}}>{{$rol->description}}</option> --}}
                                            <option value={{$rol->slug}}>{{$rol->description}}</option>
                                        @endforeach
                                        @else
                                        @foreach ($roles as $rol)
                                            @if ($rol->id >= 20 && $rol->id <= 22)
                                            <option value={{$rol->slug}}>{{$rol->description}}</option>                                                
                                            @endif
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-black">Titularidad</label>
                                <div class="form-group bg-gray">
                                    <select class="form-control" name="titularidad" required>
                                        <option value="" selected> --- SELECCIONE SU SITUACIÓN --- </option>
                                        <option value="TITULAR">TITULAR</option>
                                        <option value="SUPLENTE">SUPLENTE</option>
                                        <option value="APOYO-1">APOYO 1</option>
                                        <option value="APOYO-2">APOYO 2</option>
                                        <option value="APOYO-3">APOYO 3</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label >Buscar Recinto</label>
                                <input type="text" id="input_recinto" placeholder="Ingrese el Recinto a Buscar" class="form-control" value=""/>
                            </div>
                        </div>
                        {{-- <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-black ">Circunscripción</label>
                                <select class="form-control" name="id_circunscripcion" id="id_circunscripcion" required>
                                    <option value="" selected> --- SELECCIONE UNA CIRCUNSCRIPCIÓN --- </option>
                                    @foreach ($circunscripciones as $circ)
                                <option value="{{$circ->circunscripcion}}">{{$circ->circunscripcion}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group distrito_json_select">
                                <label class="">Distrito</label>
                                <select class="form-control" name="id_distrito" id="id_distrito" required>
                                </select>
                            </div>
                        </div> --}}
                        <div class="col-md-12">
                            <div class="form-group recinto_json_select">
                                <label class="text-black">Recinto</label>
                                <select class="form-control" name="recinto" id="id_recinto" required>
                                  </select>
                            </div>
                        </div>


                        {{-- <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-black">Es Informático?</label>
                                <div class="form-group bg-gray">
                                    <select class="form-control" name="informatico" required>
                                        <option value="" selected> --- ELIJA UNA OPCIÓN --- </option>
                                        <option value="SI">SI</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </div>
                            </div>
                        </div> --}}
                        <div class="col-md-12" id="div_mesas">
                            <div class="" id="div_mesas_detalle">
                                    <h5 class="box-title"><b>Detalle de Mesas: </b></h5>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <h3 style="background-color:#ffffff; font-size: 14px; text-align: center; padding: 7px 10px; margin-top: 0;">
                                        <b>Asignadas:</b> <b><span id="mesas_asignadas"></span></b>
                                    </h3>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <h3 style="background-color:#ffffff; font-size: 14px; text-align: center; padding: 7px 10px; margin-top: 0;">
                                        <b>Sin Asignar:</b> <b><span id="mesas_sin_asignar"></span></b>
                                    </h3>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <h3 style="background-color:#ffffff; font-size: 14px; text-align: center; padding: 7px 10px; margin-top: 0;">
                                        <b>Total:</b> <b><span id="mesas_total"></span></b>
                                    </h3>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="text-black">Mesas - Recinto</label>
                                <div class="form-group bg-gray mesas_json">
                                    <select size="7" multiple="" class="form-control" name="mesas[]" id="id_mesa" style="font-family:'FontAwesome', \'Helvetica Neue\', Helvetica, sans-serif; ">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" id="div_casa_campana">
                            <div class="form-group">
                                <label class="text-black">Casa de Campaña</label>
                                <div class="form-group bg-gray">
                                    <select  class="form-control" name="id_casa_campana" id="id_casa_campana">
                                        <option value="" selected> --- SELECCIONE UNA CASA DE CAMPAÑA --- </option>
                                        @foreach ($casas as $casa)
                                        <option value="{{$casa->id_casa_campana}}">C:{{$casa->circunscripcion}} - D:{{$casa->distrito}} - {{$casa->nombre_casa_campana}} {{$casa->direccion}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" id="div_vehiculo">
                            <div class="form-group">
                                <label class="text-black">Vehiculo</label>
                                <div class="form-group bg-gray">
                                    <select  class="form-control" name="id_vehiculo" id="id_vehiculo">
                                        <option value="" selected> --- SELECCIONE UN VEHICULO --- </option>
                                        @foreach ($vehiculos as $vehiculo)
                                        <option value="{{$vehiculo->id_transporte}}">{{$vehiculo->id_transporte}} - {{$vehiculo->marca}} {{$vehiculo->modelo}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-black ">Organización de Origen</label>
                                <select class="form-control" name="id_origen" id="id_origen" required>
                                        <option value="" selected> --- SELECCIONE UNA ORGANIZACIÓN --- </option>
                                    @foreach ($origenes as $origen)
                                <option value="{{$origen->id_origen}}">{{$origen->id_origen}} - {{$origen->origen}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group sub_origen_json">
                                <label class="text-black">Sub Origen</label>
                                <select class="form-control" name="id_sub_origen">
                                    <option value="0" selected> --- SELECCIONE UNA SUB ORGANIZACIÓN --- </option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-black ">Tipo de Evidencia</label>
                                <select class="form-control" name="evidencia" id="evidencia" required>
                                    <option value="" selected> --- SELECCIONE UNA EVIDENCIA --- </option>
                                @foreach ($evidencias as $evidencia)
                            <option value="{{$evidencia->id}}">{{$evidencia->nombre}}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-black ">Subir </label>
                                <input name="archivo" id="archivo" type="file" class="text-white" accept="image/*"/>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <br>
                        </div>
                        <button type="submit" class="mybtn">Registrar</button>
                      </form>
                    
                    </div>
              </div>
            </div>

        </div>
      </div>

        <!-- Modal -->
        <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Mesas - Usuario</h4>
                </div>
                <div class="modal-body">
                        <div class="box-body table-responsive no-padding">
                            <div class="scrollable">
                                <table class="table table-bordered table-striped scrollable" id="tabla_mesas_json">
                                <thead>
                                <tr  style="background-color:#3c8dbc; text-align:center">
                                    <th>#</th>
                                    <th>Código Mesa</th>
                                    <th>Nombre</th>
                                    <th>Contacto</th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                                </table>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
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
    $("#div_circ").hide();
    $("#div_distrito").hide();
    $("#div_recinto").hide();
    $("#div_mesas").hide();
    $("#div_casa_campana").hide();
    $("#div_vehiculo").hide();


    $("#rol_slug").change(function(){

        // alert('aksd');
        
        
        //id obtenido de la base de datos "campo : slug"
        var rol_slug = $("#rol_slug").val();
        if (rol_slug == 'militante') {
            $("#div_circ").hide();
            $("#div_distrito").hide();
            $("#div_recinto").hide();
            $("#div_mesas").hide();
            $("#div_casa_campana").hide();
            $("#div_vehiculo").hide();
            $("#btn_registrar").prop('disabled', true);
        }else if(rol_slug == 'conductor'){
            alertify.success(rol_slug);
            $("#div_circ").hide();
            $("#div_distrito").hide();
            $("#div_recinto").hide();
            $("#div_mesas").hide();
            $("#div_casa_campana").hide();
            $("#div_vehiculo").show();
            $("#btn_registrar").prop('disabled', false);
        }else if(rol_slug == 'registrador'){
            alertify.success(rol_slug);
            $("#div_circ").hide();
            $("#div_distrito").hide();
            $("#div_recinto").hide();
            $("#div_mesas").hide();
            $("#div_casa_campana").show();
            $("#div_vehiculo").hide();
            $("#btn_registrar").prop('disabled', false);
        }else if(rol_slug == 'call_center'){
            $("#div_circ").hide();
            $("#div_distrito").hide();
            $("#div_recinto").hide();
            $("#div_mesas").hide();
            $("#div_casa_campana").hide();
            $("#div_vehiculo").hide();
            $("#btn_registrar").prop('disabled', false);
        }else if(rol_slug == 'responsable_mesa'){
            $("#div_mesas_detalle").hide();
            $("#div_circ").show();
            $("#div_distrito").show();
            $("#div_recinto").show();
            $("#div_mesas").show();
            $("#div_casa_campana").hide();
            $("#div_vehiculo").hide();
            $("#btn_registrar").prop('disabled', false);
            cargaMesasRecinto();
        }else if(rol_slug == 'responsable_recinto'){
            $("#div_circ").show();
            $("#div_distrito").show();
            $("#div_recinto").show();
            $("#div_mesas").hide();
            $("#div_casa_campana").hide();
            $("#div_vehiculo").hide();
            $("#btn_registrar").prop('disabled', false);
        }else if(rol_slug == 'responsable_distrito'){
            $("#div_circ").show();
            $("#div_distrito").show();
            $("#div_recinto").hide();
            $("#div_mesas").hide();
            $("#div_casa_campana").hide();
            $("#div_vehiculo").hide();
            $("#btn_registrar").prop('disabled', false);
        }else if(rol_slug == 'responsable_circunscripcion'){
            $("#div_circ").show();
            $("#div_distrito").hide();
            $("#div_recinto").hide();
            $("#div_mesas").hide();
            $("#div_casa_campana").hide();
            $("#div_vehiculo").hide();
            $("#btn_registrar").prop('disabled', false);
        }else {
            
        }
    });
  
    $("#id_recinto").change(function(){
        cargaMesasRecinto();
    });

    function cargaMesasRecinto(){
        // alertify.success('dasf');
        
        $(".mesas_json select").html("");
        $("#div_mesas_detalle").show();
        $("#mesas_asignadas").text("");
        $("#mesas_sin_asignar").text("");
        $("#mesas_total").text("");
        var id_recinto = $("#id_recinto").val();
        var mesas_asignadas = 0;
        var mesas_sin_asignar = 0;
        var mesas_total = 0;
        // console.log($("#anio").val());
        $.getJSON("consultaMesasRecinto/"+id_recinto+"",{},function(objetosretorna){
            $("#error").html("");
            
            var TamanoArray = objetosretorna.length;
            // $(".mesas_json select").append('<input type="checkbox" disabled="">');
            $.each(objetosretorna, function(i,value){
                
                if (value.mesa_activa === 0 || value.mesa_activa === null) {
                    mesas_sin_asignar++;
                    $(".mesas_json select").append('<option value="'+value.id_mesa+'">R:'+value.id_recinto+' - '+value.codigo_mesas_oep+'-'+value.codigo_ajllita+'</option>');                    
                } else {
                    mesas_asignadas++;
                    // $(".mesas_json select").append('<option disabled value="'+value.id_mesa+'">R:'+value.id_recinto+'-'+value.id_mesa+'-'+value.codigo_mesas_oep+' &#xf007; '+value.nombre_completo+' &#xf095; '+value.telefono_celular+'</option>');                    
                    $(".mesas_json select").append('<option value="'+value.id_mesa+'">R:'+value.id_recinto+' - '+value.codigo_mesas_oep+'-'+value.codigo_ajllita+' &#xf007; '+value.nombre_completo+' &#xf095; '+value.telefono_celular+' ('+value.responsables+') </option>');
                }
                mesas_total++;

            });
            $("#mesas_asignadas").text(mesas_asignadas);
            $("#mesas_sin_asignar").text(mesas_sin_asignar);
            $("#mesas_total").text(mesas_total);
        });
    };
    
    $("#id_circunscripcion").change(function(){
        cargaDistritos();
    });

    $("#id_distrito").change(function(){
        cargaRecintos();
    });

    function cargaDistritos(){
        $(".distrito_json_select select").html("");
        var id_circunscripcion = $("#id_circunscripcion").val();

        // console.log($("#anio").val());
        $.getJSON("consultaDistritos/"+id_circunscripcion+"",{},function(objetosretorna){
            $("#error").html("");
            var TamanoArray = objetosretorna.length;
            $(".distrito_json_select select").append('<option value=""> --- SELECCIONE EL DISTRITO --- </option>');
            $.each(objetosretorna, function(i,value){
                $(".distrito_json_select select").append('<option value="'+value.distrito+'">'+value.distrito+'</option>');
            });
        });
    };


    $( "#input_recinto" ).keyup(function() {
        $(".recinto_json_select select").html("");
        var recinto = $("#input_recinto").val();
        var recinto_sin_espacios = recinto.trim();
        if (recinto_sin_espacios == "") {
            
        } else {
            $.getJSON("consultaRecintosPorRecinto/"+recinto+"",{},function(objetosretorna){
                $("#error").html("");
                var TamanoArray = objetosretorna.length;
                $(".recinto_json_select select").append('<option value=""> --- SELECCIONE EL RECINTO --- </option>');
                $.each(objetosretorna, function(i,value){
                    $(".recinto_json_select select").append('<option value="'+value.id_recinto+'"> C: '+value.circunscripcion+' - Dist. Municipal: '+value.distrito+' - Dist. OEP: '+value.distrito_referencial+' - # '+value.id_recinto+' - Recinto: '+value.nombre+' - Zona: '+value.zona+'</option>');
                });
            });
        }
    });

    $( "#input_cedula" ).keyup(function() {
        
        
        $("#tabla_cedula tbody").html("");
        var cedula = $("#input_cedula").val();
        var cedula_sin_espacios = cedula.trim();
        if (cedula_sin_espacios == "") {
            
        } else {
            // $.getJSON("consultaRecintosPorRecinto/"+recinto+"",{},function(objetosretorna){
            $.getJSON("consultaUsuarioRegistrado/"+cedula_sin_espacios+"",{},function(objetosretorna){
                $("#div_usuarios_encontrados").show();
                $("#error").html("");
                var TamanoArray = objetosretorna.length;
                $.each(objetosretorna, function(i,datos){

                    var nuevaFila =
                    "<tr>"
                    +"<td>"+datos.nombre_completo+"</td>"
                    +"<td>"+datos.ci+"</td>"
                    +"<td>"+datos.fecha_nacimiento+"</td>"
                    +"<td>"+datos.contacto+"</td>"
                    +"<td>"+datos.recinto+"</td>"
                    // +"<td>"+datos.circunscripcion+"</td>"
                    // +"<td>"+datos.distrito+"</td>"
                    // +"<td>"+datos.nombre_recinto+"</td>"
                    +"<td>"+datos.description+"</td>"
                    +"</tr>";
                    $(nuevaFila).appendTo("#tabla_cedula tbody");
                });
                if(TamanoArray==0){
                    var nuevaFila =
                    "<tr><td colspan=6>No se encontraron parametros para su busqueda</td>"
                    +"</tr>";
                    $(nuevaFila).appendTo("#tabla_cedula tbody");
                }
            });
        }
        
    });
    
    $('#id_mesa').dblclick(function(){
        var selectBox = document.getElementById("id_mesa");
        var id_mesa = selectBox.options[selectBox.selectedIndex].value;

        $("#tabla_mesas_json tbody").html("");
    $.getJSON("consultaMesasUsuario/"+id_mesa+"",{},function(objetosretorna){
        // alert(objetosretorna);
        $("#error").html("");
        var TamanoArray = objetosretorna.length;
        var indice = 0;
        $.each(objetosretorna, function(i,items){
        indice ++;
        var nuevaFila =
        "<tr>"
        // +"<td>"+indice+"</td>"
        
        +"<td>"+items.codigo_mesas_oep+"</td>"
        +"<td>"+items.codigo_ajllita+"</td>"
        +"<td>"+items.nombre_completo+"</td>"
        +"<td>"+items.telefono_celular+"</td>"
        +"</tr>";

        $(nuevaFila).appendTo("#tabla_mesas_json tbody");
        });

        if(TamanoArray==0){
        var nuevaFila =
        "<tr><td colspan=6>Seleccione un día</td>"
        +"</tr>";
        $(nuevaFila).appendTo("#tabla_mesas_json tbody");
        }
    });
        
        $('#ModalAdd').modal('show');
    });

    function cargaRecintos(){
        $(".recinto_json_select select").html("");
        var id_circunscripcion = $("#id_circunscripcion").val();
        var id_distrito = $("#id_distrito").val();

        // console.log($("#anio").val());
        $.getJSON("consultaRecintos/"+id_distrito+"/"+id_circunscripcion+"",{},function(objetosretorna){
            $("#error").html("");
            var TamanoArray = objetosretorna.length;
            $(".recinto_json_select select").append('<option value=""> --- SELECCIONE EL RECINTO --- </option>');
            $.each(objetosretorna, function(i,value){
                $(".recinto_json_select select").append('<option value="'+value.id_recinto+'"> R:'+value.id_recinto+' - '+value.nombre+'</option>');
            });
        });
    };
	
	}	
	activar_mesas();
	
	
	</script>
@endsection