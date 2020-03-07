
<section>

    <div  id="div_notificacion_sol">


<div class="" >
    <div class="container"> 
        <div class="row">
          <div class="col-sm-12 myform-cont" >
            
                <div class="myform-top ">
                    <div class="myform-top-left">
                        {{-- <img  src="" class="img-responsive logo" /> --}}
                        <h3>Tareas Asignadas <i class="fa fa-pencil-square-o"></i></h3>
                        {{-- <p>Por favor llene los siguientes campos</p> --}}
                    </div>
                    <div class="">
                        
                    </div>
                </div>


                <div class="myform-bottom">
                  
                <form action="{{ url('editar_asignacion_persona') }}"  method="post" id="f_enviar_editar_persona" class="formentrada" >
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <input type="hidden" name="id_persona" value="{{ $persona->id_persona }}">
{{-- 
                    <div class="col-md-5">
                        <div class="form-group">
                            <label class="text-black" >Grado de apoyo y compromiso - (1 al 5)</label>
                            <select class="form-control" name="grado_compromiso" required>
                                    <option value="" selected> --- SELECCIONE UN NIVEL --- </option>
                                    <option value="1" {{ $persona->grado_compromiso == '1' ? 'selected' : '' }}>1</option>
                                    <option value="2" {{ $persona->grado_compromiso == '2' ? 'selected' : '' }}>2</option>
                                    <option value="3" {{ $persona->grado_compromiso == '3' ? 'selected' : '' }}>3</option>
                                    <option value="4" {{ $persona->grado_compromiso == '4' ? 'selected' : '' }}>4</option>
                                    <option value="5" {{ $persona->grado_compromiso == '5' ? 'selected' : '' }}>5</option>
                                </select>
                        </div>
                    </div> --}}
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="text-black">Designacion</label>
                            <div class="form-group bg-gray">
                                <select  class="form-control" name="rol_slug" id="rol_slug"  required>
                                    <option value="" selected> --- SELECCIONE UNA TAREA --- </option>

                                    @if (Auth::user()->isRole('admin')==true || Auth::user()->isRole('super_admin')==true)
                                    @foreach ($roles as $rol)
                                        {{-- <option value={{$rol->slug}} {{$rol->slug == 'militante' ? 'selected' : ''}}>{{$rol->description}}</option> --}}
                                        <option value={{$rol->slug}} {{ $persona->id_rol == $rol->id ? 'selected' : '' }}>{{$rol->description}}</option>
                                    @endforeach
                                    @else
                                    @foreach ($roles as $rol)
                                        @if ($rol->id >= 20 && $rol->id <= 22)
                                        <option value={{$rol->slug}} {{ $persona->id_rol == $rol->id ? 'selected' : '' }}>{{$rol->description}}</option>                                                
                                        @endif
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="text-black">Titularidad</label>
                            <div class="form-group bg-gray">
                                <select class="form-control" name="titularidad" required>
                                    <option value="" selected> --- SELECCIONE SU SITUACIÓN --- </option>
                                    <option value="TITULAR" {{ $persona->titularidad == 'TITULAR' ? 'selected' : '' }}>TITULAR</option>
                                    <option value="SUPLENTE" {{ $persona->titularidad == 'SUPLENTE' ? 'selected' : '' }}>SUPLENTE</option>
                                    <option value="APOYO-1" {{ $persona->titularidad == 'APOYO-1' ? 'selected' : '' }}>APOYO 1</option>
                                    <option value="APOYO-2" {{ $persona->titularidad == 'APOYO-2' ? 'selected' : '' }}>APOYO 2</option>
                                    <option value="APOYO-3" {{ $persona->titularidad == 'APOYO-3' ? 'selected' : '' }}>APOYO 3</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="text-black ">Tipo de Evidencia</label>
                            <select class="form-control" name="evidencia" id="evidencia" required>
                                <option value="" selected> --- SELECCIONE UNA EVIDENCIA --- </option>
                            @foreach ($evidencias as $evidencia)
                        <option value={{$evidencia->id}} {{ $evidencia->id == $persona->evidencia ? 'selected' : '' }}>{{$evidencia->nombre}}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label >Buscar Recinto</label>
                            <input type="text" id="input_recinto" placeholder="Ingrese el Recinto a Buscar" class="form-control" value=""/>
                        </div>
                    </div>
                    {{-- <div class="col-md-3">
                        <div class="form-group">
                            <label class="text-black ">Circunscripción</label>
                            <select class="form-control" name="id_circunscripcion" id="id_circunscripcion" required>
                                <option value="" selected> --- SELECCIONE UNA CIRCUNSCRIPCIÓN --- </option>
                                @foreach ($circunscripciones as $circ)
                                <option value={{$circ->circunscripcion}} {{ $persona->circunscripcion == $circ->circunscripcion ? 'selected' : '' }}>{{$circ->circunscripcion}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group distrito_json">
                            <label class="text-black" class="">Distrito</label>
                            <select class="form-control" name="id_distrito" id="id_distrito" required>
                                @foreach ($distritos as $dist)
                                <option value={{$dist->distrito}} {{ $persona->distrito == $dist->distrito ? 'selected' : '' }}>{{$dist->distrito}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> --}}

                    <div class="col-md-12">
                        <div class="form-group recinto_json_select">
                            <label class="text-black">Recinto</label>
                            <select class="form-control" name="recinto" id="id_recinto" required>
                                @foreach ($recintos as $recinto)
                                <option value={{$recinto->id_recinto}} {{ $persona->id_recinto == $recinto->id_recinto ? 'selected' : '' }}>{{$recinto->id_recinto}} - {{$recinto->nombre_recinto}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="text-black">Organización de Origen</label>
                            <select class="form-control" name="id_origen" id="id_origen">
                                @foreach ($origenes as $origen)
                            <option value={{$origen->id_origen}} {{ $persona->id_origen == $origen->id_origen ? 'selected' : '' }}>{{$origen->origen}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group sub_origen_json">
                            <label class="text-black">Sub Origen</label>
                            <select class="form-control" name="id_sub_origen">
                                <option value="" selected> --- SELECCIONE UN ORIGEN--- </option>
                                @foreach ($sub_origenes as $sub_origen)
                                <option value={{$sub_origen->id_sub_origen}} {{ $persona->id_sub_origen == $sub_origen->id_sub_origen ? 'selected' : '' }}>{{$sub_origen->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- <div class="col-md-4">
                        <div class="form-group">
                            <label class="text-black">Es Informático?</label>
                            <div class="form-group bg-gray">
                                <select class="form-control" name="informatico" required>
                                    <option value="" selected> --- ELIJA UNA OPCIÓN --- </option>
                                    <option value="SI" {{ $persona->informatico == 'SI' ? 'selected' : '' }}>SI</option>
                                    <option value="NO" {{ $persona->informatico == 'NO' ? 'selected' : '' }}>NO</option>
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
                                    @foreach ($mesas_usuario as $mesa)
                                    <option value="{{$mesa->id_mesa}}"> {{$mesa->id_mesa}} C:{{$mesa->circunscripcion}} - D:{{$mesa->distrito}} - R:{{$mesa->nombre_recinto}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" id="div_casa_campana">
                        <div class="form-group">
                            <label class="text-black">Casa de Campaña</label>
                            <div class="form-group bg-gray">
                                <select  class="form-control" name="id_casa_campana" id="id_casa_campana">
                                    <option value=""> --- SELECCIONE UNA CASA DE CAMPAÑA --- </option>
                                    @foreach ($casas as $casa)
                                        @if ($casa_campana != null)
                                        <option value={{$casa->id_casa_campana}} {{$casa_campana->id_casa_campana == $casa->id_casa_campana ? 'selected' : '' }}>C:{{$casa->circunscripcion}} - D:{{$casa->distrito}} - {{$casa->nombre_casa_campana}} {{$casa->direccion}}</option>
                                        @else
                                        <option value="{{$casa->id_casa_campana}}">C:{{$casa->circunscripcion}} - D:{{$casa->distrito}} - {{$casa->nombre_casa_campana}} {{$casa->direccion}}</option>
                                        @endif

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
                                    @if ($usuario_vehiculo != null)
                                    <option value={{$vehiculo->id_transporte}} {{$vehiculo->id_transporte == $usuario_vehiculo->id_transporte ? 'selected' : '' }}>{{$vehiculo->id_transporte}} - {{$vehiculo->marca}} {{$vehiculo->modelo}}</option>
                                    @else
                                    <option value="{{$vehiculo->id_transporte}}">{{$vehiculo->id_transporte}} - {{$vehiculo->marca}} {{$vehiculo->modelo}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <br>
                    </div>
                    <button type="submit" class="mybtn">Guardar</button>
                  </form>
                
                </div>
          </div>
        </div>

    </div>
  </div>

  <div class="" >
    <div class="container"> 
        <div class="row">
          <div class="col-sm-12 myform-cont" >
            
                <div class="myform-top ">
                    <div class="myform-top-left">
                        {{-- <img  src="" class="img-responsive logo" /> --}}
                        <h3>Evidencias <i class="fa fa-pencil-square-o"></i></h3>
                        {{-- <p>Por favor llene los siguientes campos</p> --}}
                    </div>
                    <div class="">
                        
                    </div>
                </div>


                <div class="myform-bottom">

                        <div class="row margin-bottom">
                            <!-- /.col -->
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-sm-6">
                                    @if ($persona->archivo_evidencia != "")
                                    <img class="img-responsive" src="{{ url($persona->archivo_evidencia) }}" alt="Photo">
                                    @else
                                        <h4>No tiene evidencia</h4>
                                    @endif
                                    {{-- <img class="img-circle" src="{{ url($partido->logo) }}" style="width:65px;height:65px;" alt="User Avatar"> --}}

                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-6">
                                    {{-- <img class="img-responsive" src="../../dist/img/photo4.jpg" alt="Photo">
                                    <br>
                                    <img class="img-responsive" src="../../dist/img/photo1.png" alt="Photo"> --}}
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <div class="col-sm-6">
                                <form action="{{ url('editar_evidencia_persona') }}"  method="post" id="f_editar_evidencia_persona" class="formarchivo" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="id_persona" value="{{ $persona->id_persona }}">
                                    <label style="font-size: 20px">Subir imagen</label><br><br>
                                    <input name="archivo" id="archivo" type="file" class="text-white" accept="image/*"/>
                    
                                        <div class="col-md-12">
                                            <br>
                                        </div>
                                        <button type="submit" class="mybtn">Guardar</button>
                                </form>
                            </di<v>

                                <!-- /.col -->
                              </div>
                  

                
                </div>
          </div>
        </div>

    </div>
  </div>

    </div>

    <div class="" >
            <div class="container"> 
                <div class="row">
                  <div class="col-sm-12 myform-cont" >
                    
                         <div class="myform-top">
                            <div class="myform-top-left">
                               {{-- <img  src="" class="img-responsive logo" /> --}}
                              <h3>Datos Personales <i class="fa fa-pencil-square-o"></i></h3>
                                {{-- <p>Por favor llene los siguientes campos</p> --}}
                            </div>
                            <div class="">
                              
                            </div>
                          </div>
    
                        <div class="myform-bottom">
                          
                        <form action="{{ url('editar_persona') }}"  method="post" id="f_enviar_editar_persona" class="formentrada" >
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <input type="hidden" name="id_persona" value="{{ $persona->id_persona }}">
                          <input type="hidden" id="id_usuario" name="id_usuario" value="{{ $usuario->id }}">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label >Nombres</label>
                                    <input type="input" name="nombres" placeholder="" class="form-control" value="{{ $persona->nombre }}"  required/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label >Paterno</label>
                                    <input type="input" name="paterno" placeholder="" class="form-control" value="{{ $persona->paterno }}" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label >Materno</label>
                                    <input type="input" name="materno" placeholder="" class="form-control" value="{{ $persona->materno }}" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label >Carnet</label>
                                    <input type="input" name="cedula" placeholder="" class="form-control" value="{{ $persona->cedula_identidad }}" pattern="[0-9]{6,9}" required/>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                        <label >Comp. SEGIP</label>
                                    <input type="input" name="complemento" placeholder="" class="form-control" value="{{ $persona->complemento_cedula }}" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label >Exp.</label>
                                    <select class="form-control" name="expedido">
                                        <option value="LP" {{ $persona->expedido == 'LP' ? 'selected' : '' }}>LP</option>
                                        <option value="OR" {{ $persona->expedido == 'OR' ? 'selected' : '' }}>OR</option>
                                        <option value="PT" {{ $persona->expedido == 'PT' ? 'selected' : '' }}>PT</option>
                                        <option value="CB" {{ $persona->expedido == 'CB' ? 'selected' : '' }}>CB</option>
                                        <option value="SC" {{ $persona->expedido == 'SC' ? 'selected' : '' }}>SC</option>
                                        <option value="BN" {{ $persona->expedido == 'BN' ? 'selected' : '' }}>BN</option>
                                        <option value="PA" {{ $persona->expedido == 'PA' ? 'selected' : '' }}>PA</option>
                                        <option value="TJ" {{ $persona->expedido == 'TJ' ? 'selected' : '' }}>TJ</option>
                                        <option value="CH" {{ $persona->expedido == 'CH' ? 'selected' : '' }}>CH</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class=" ">Fecha de nacimiento</label>
                                    <input type="date" name="nacimiento" placeholder=""  min="1939-01-01" max="2002-01-01" class="form-control" value="{{ $persona->fecha_nacimiento }}" required />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label >Telefono</label>
                                    <input type="input" name="telefono" placeholder="" class="form-control" value="{{ $persona->telefono_celular }}" pattern="[0-9]{8}" data-inputmask="&quot;mask&quot;: &quot;99999999&quot;" data-mask="" title="Introduzca un número valido" required/>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label >Telefono de Referencia</label>
                                    <input type="input" name="telefono_ref" placeholder="" class="form-control" value="{{ $persona->telefono_referencia }}" pattern="[0-9]{8}" data-inputmask="&quot;mask&quot;: &quot;99999999&quot;" data-mask="" title="Introduzca un número valido" required/>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label >Direccion</label>
                                    <input type="input" name="direccion" placeholder="Domicilio" class="form-control" value="{{ $persona->direccion }}" required/>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label >Email</label>
                                    <input type="email" name="email" placeholder="Correo electrónico" class="form-control" value="{{ $persona->email }}" />
                                </div>
                            </div>

                            <div class="col-md-12">
                                <br>
                            </div>
                            <button type="submit" class="mybtn">Guardar</button>
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

<script>
  $(document).ready(function() {
    var id_sol = $("#id_solicitud").val();

    activar_roles();
    $("#rol_slug").change(function(){
        activar_roles();
    });
    
    $("#id_origen").change(function(){
        cargaSubOrigen();
    });


    function cargaSubOrigen(){
        $(".sub_origen_json select").html("");
        var id_origen = $("#id_origen").val();
    
        // console.log($("#anio").val());
        $.getJSON("consultaSubOrigen/"+id_origen+"",{},function(objetosretorna){
            $("#error").html("");
            var TamanoArray = objetosretorna.length;
            $(".sub_origen_json select").append('<option value="0"> --- SELECCIONE EL SUB ORIGEN --- </option>');
            $.each(objetosretorna, function(i,value){
                $(".sub_origen_json select").append('<option value="'+value.id_sub_origen+'">'+value.nombre+'</option>');
            });
        });
    };
    
    $("#id_circunscripcion").change(function(){
        cargaDistritos();
    });

    $("#id_distrito").change(function(){
        cargaRecintos();
    });

    function cargaDistritos(){
    $(".distrito_json select").html("");
    var id_circunscripcion = $("#id_circunscripcion").val();

    // console.log($("#anio").val());
    $.getJSON("consultaDistritos/"+id_circunscripcion+"",{},function(objetosretorna){
        $("#error").html("");
        var TamanoArray = objetosretorna.length;
        $(".distrito_json select").append('<option value=""> --- SELECCIONE EL DISTRITO --- </option>');
        $.each(objetosretorna, function(i,value){
            $(".distrito_json select").append('<option value="'+value.distrito+'">'+value.distrito+'</option>');
        });
    });
    };
    
    $("#id_recinto").change(function(){
        var rol_slug = $("#rol_slug").val();
        if (rol_slug == 'responsable_mesa') {
            cargaMesasRecinto();
        }
    });

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
    $(".recinto_json select").html("");
    var id_circunscripcion = $("#id_circunscripcion").val();
    var id_distrito = $("#id_distrito").val();

    // console.log($("#anio").val());
    $.getJSON("consultaRecintos/"+id_distrito+"/"+id_circunscripcion+"",{},function(objetosretorna){
            $("#error").html("");
            var TamanoArray = objetosretorna.length;
            $(".recinto_json select").append('<option value=""> --- SELECCIONE EL RECINTO --- </option>');
            $.each(objetosretorna, function(i,value){
                $(".recinto_json select").append('<option value="'+value.id_recinto+'">'+value.id_recinto+' - '+value.nombre+'</option>');
            });
        });

    };

  });

  function cargaMesasRecinto(){
        // alertify.success('dasf');
        
        $(".mesas_json select").html("");
        $("#div_mesas_detalle").show();
        $("#mesas_asignadas").text("");
        $("#mesas_sin_asignar").text("");
        $("#mesas_total").text("");
        var id_usuario = $("#id_usuario").val();
        // alertify.warning(id_usuario);
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
                    if (value.id_usuario == id_usuario) {
                        $(".mesas_json select").append('<option selected value="'+value.id_mesa+'">R:'+value.id_recinto+'-'+value.codigo_mesas_oep+'-'+value.codigo_ajllita+' &#xf007; '+value.nombre_completo+' &#xf095; '+value.telefono_celular+'</option>');                    
                    }else{
                        $(".mesas_json select").append('<option value="'+value.id_mesa+'">R:'+value.id_recinto+'-'+value.codigo_mesas_oep+'-'+value.codigo_ajllita+' &#xf007; '+value.nombre_completo+' &#xf095; '+value.telefono_celular+'</option>');                    
                    }
                }
                mesas_total++;

            });
            $("#mesas_asignadas").text(mesas_asignadas);
            $("#mesas_sin_asignar").text(mesas_sin_asignar);
            $("#mesas_total").text(mesas_total);
        });
    };

  function activar_roles(){

    //id obtenido de la base de datos "campo : slug"
    var rol_slug = $("#rol_slug").val();
        if (rol_slug == 'militante') {
            alertify.success(rol_slug);
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
            alertify.success(rol_slug);
            $("#div_circ").hide();
            $("#div_distrito").hide();
            $("#div_recinto").hide();
            $("#div_mesas").hide();
            $("#div_casa_campana").hide();
            $("#div_vehiculo").hide();
            $("#btn_registrar").prop('disabled', false);
        }else if(rol_slug == 'responsable_mesa'){
            alertify.success(rol_slug);
            cargaMesasRecinto();
            $("#div_circ").show();
            $("#div_distrito").show();
            $("#div_recinto").show();
            $("#div_mesas").show();
            $("#div_casa_campana").hide();
            $("#div_vehiculo").hide();
            $("#btn_registrar").prop('disabled', false);
        }else if(rol_slug == 'responsable_recinto'){
            alertify.success(rol_slug);
            $("#div_circ").show();
            $("#div_distrito").show();
            $("#div_recinto").show();
            $("#div_mesas").hide();
            $("#div_casa_campana").hide();
            $("#div_vehiculo").hide();
            $("#btn_registrar").prop('disabled', false);
        }else if(rol_slug == 'responsable_distrito'){
            alertify.success(rol_slug);
            $("#div_circ").show();
            $("#div_distrito").show();
            $("#div_recinto").hide();
            $("#div_mesas").hide();
            $("#div_casa_campana").hide();
            $("#div_vehiculo").hide();
            $("#btn_registrar").prop('disabled', false);
        }else if(rol_slug == 'responsable_circunscripcion'){
            alertify.success(rol_slug);
            $("#div_circ").show();
            $("#div_distrito").hide();
            $("#div_recinto").hide();
            $("#div_mesas").hide();
            $("#div_casa_campana").hide();
            $("#div_vehiculo").hide();
            $("#btn_registrar").prop('disabled', false);
        }else {
            
        }

  }
</script>