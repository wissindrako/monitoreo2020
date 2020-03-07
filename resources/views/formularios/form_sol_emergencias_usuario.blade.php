{{-- @section('main-content') 
@yield('main-content') --}}

@can('autorizar_solicitud')
<section class="content" id="contenido_principal">
{{-- {{dd($personal)}} --}}
{{-- {{dd($gestiones)}} --}}
    <div class="box box-success">
      <div class="box-header">
        @php
            $hoy = new DateTime(date('Y-m-d'));
            $alta = new DateTime($personal[0]->fechaingreso);
            
            if($personal[0]->fechabaja == null){//con baja
            $antiguedad = $alta->diff($hoy);
            }
            else {
            
            $baja = new DateTime($personal[0]->fechabaja);
            $antiguedad = $alta->diff($baja);
            }
            $a = $antiguedad->y. 'a ';
            $m = $antiguedad->m. 'm ';
            $d = $antiguedad->d. 'd ';
        @endphp

        <h3 class="box-title"><b>Solicitud de vacaciones de Emergencia:  {{$personal[0]->unidad}}</b></h3><br>
        <h3 class="box-title">{{$personal[0]->nombre}} {{$personal[0]->paterno}} {{$personal[0]->materno}}</h3><br>
        <h3 class="box-title">Fecha de Ingreso: {{f_formato($personal[0]->fechaingreso)}} </h3>

        @if($personal[0]->fechabaja == null)
        {{-- <h3 class="box-title">Fecha de Ingreso: {{fecha2text($baja)}} </h3> --}}
        @else 
            - <span class="badge bg-red"><h3 class="box-title">Fecha de Baja: {{fecha2text($baja)}}</h3></span> 
        @endif

        <br> <h3 class="box-title"> Antiguedad MDCyT: {{$a}} {{$m}} {{$d}} </h3>

        {{-- <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fa fa-minus"></i></button>
        </div> --}}

      </div>
{{-- Información sobre vacaciones --}}
{{-- {{dd($gestiones)}} --}}
{{-- @if ($gestiones->isEmpty()) --}}

<div id="div_notificacion_sol"></div>

<div class="box">
    <div id="div_calendar_emergencias" class="box col-md-12">
        {{-- <div class="box-header with-border">
        <h3 class="box-title">Solicitud de Vacaciones</h3>
    
            <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fa fa-minus"></i></button>
            </div>
        </div> --}}
    
        <!-- /.box-header -->
        <div class="box-body">
          {{-- <section  id="contenido_principal"> --}}
            <div id="div_notificacion_sol"></div>
              <div class="row">
                  <div class="col-md-12" style="text-align:right; border:0px;"><b><span id="span_solicitud"></b></span></div>
                  
                  <div class="col-md-12">
                    <div class="col-md-3">
                      <div class="row">
                        <div class="box box-solid">
                          <div class="box-header with-border">
                            <h4 class="box-title"><b>Referencia de colores</b></h4>
                          </div>
                          <div class="box-body">
                            <!-- the events -->
                            <div id="external-events">
                                <div class="external-event ui-draggable ui-draggable-handle" style="background-color: #C6FF00; position: relative;">Feriado</div>
                              <div class="external-event ui-draggable ui-draggable-handle" style="background-color: #F50057; color: rgb(255, 255, 255); position: relative;">Solicitud Reservada </div>
                              {{-- <div class="external-event ui-draggable ui-draggable-handle" style="background-color: #8C9EFF; color: rgb(255, 255, 255); position: relative;">Todo el día</div>
                              <div class="external-event ui-draggable ui-draggable-handle" style="background-color: #B388FF; color: rgb(255, 255, 255); position: relative;">Sólo en la mañana</div>
                              <div class="external-event ui-draggable ui-draggable-handle" style="background-color: #EA80FC; color: rgb(255, 255, 255); position: relative;">Sólo en la tarde</div> --}}
                              <div class="external-event bg-blue ui-draggable ui-draggable-handle" style="position: relative;">Vacación Solicitada</div>
                              <div class="external-event bg-yellow ui-draggable ui-draggable-handle" style="position: relative;">Vacación Aprobada</div>
                              <div class="external-event bg-green ui-draggable ui-draggable-handle" style="position: relative;">Vacación Autorizada</div>
                              <div class="external-event ui-draggable ui-draggable-handle" style="background-color: #f31600; color: rgb(255, 255, 255); position: relative;">Vacación Rechazada</div>
                              <div class="external-event ui-draggable ui-draggable-handle" style="background-color: #607D8B; color: rgb(255, 255, 255); position: relative;">Anulada</div>
                              <div class="external-event ui-draggable ui-draggable-handle" style="background-color: #00a0ffd9; color: rgb(255, 255, 255); position: relative;">Suspensión Solicitada</div>
                              <div class="external-event ui-draggable ui-draggable-handle" style="background-color: #ffb100d1; color: rgb(255, 255, 255); position: relative;">Suspensión Aprobada</div>
                              <div class="external-event ui-draggable ui-draggable-handle" style="background-color: #00de78eb; color: rgb(255, 255, 255); position: relative;">Suspensión Autorizada</div>
                            </div>
                          </div>
                          <!-- /.box-body -->
                        </div>
                      </div>
                    </div>
                    <div class="col-md-5">
                      <div id="calendar_emergencias" class="col-centered" style="overflow: auto;"></div>

                    <!-- Modal -->
                    <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <form method="POST" action="agregar_fechas" id="f_agregar_fechas" class="formentrada">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Agregar día de Vacación</h4>
                          </div>
                          <div class="modal-body">
                              <div id="div_notificacion_modal"></div>
                              <div class="form-group">
                                <input hidden type="text" name="id_solicitud" id="id_solicitud" class="form-group" value="{{$id_sol}}">
                                <label for="start" class="col-sm-2 control-label">Fecha</label>
                                <div class="col-sm-10">
                                  <input type="text" name="start" class="form-control" id="start" readonly>
                                  <input type="hidden" name="end" class="form-control" id="end">
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="tiempo" class="col-sm-2 control-label">Tiempo</label>
                                <div class="col-sm-10">
                                  <select name="tiempo" class="form-control" id="tiempo">
                                    <option selected style="color:#E91E63;" value="1">&#9724; Todo el día</option>
                                    <option style="color:#9C27B0;" value="2">&#9724; Mañana</option>
                                    <option style="color:#651FFF;" value="3">&#9724; Tarde</option>
                                  </select>
                                </div>
                              </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary" id="btn_guarda_fecha">Guardar</button>
                          </div>
                        </form>
                        </div>
                      </div>
                    </div>

                    <!-- Modal Editar-->
                    <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                      <div class="modal-content">
                      <form method="POST" action="editar_tiempo" id="f_editar_tiempo" class="formentrada">
                          <input hidden type="text" name="id_solicitud" id="id_solicitud" class="form-group" value="{{$id_sol}}">
                        <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Editar Tiempo</h4>
                        </div>
                        <div class="modal-body">
                        
                          <div class="form-group">
                          <label for="tiempo" class="col-sm-2 control-label">Tiempo</label>
                          <div class="col-sm-10">
                            <select name="tiempo" class="form-control" id="tiempo">
                              <option style="color:#E91E63;" value="1">&#9724; Todo el Día</option>
                              <option style="color:#9C27B0;" value="2">&#9724; En la Mañana</option>
                              <option style="color:#651FFF;" value="3">&#9724; En la Tarde</option>						  
                            </select>
                          </div>
                          </div>
                            <div class="form-group"> 
                            <div class="col-sm-offset-2 col-sm-10">
                              <div class="checkbox">
                              <label class="text-red"><input type="checkbox"  name="delete"><b><i class="icon fa fa-warning"></i> Borrar día</b></label>
                              </div>
                            </div>
                          </div>
                          
                          <input type="hidden" name="id" class="form-control" id="id">

                        
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary" id="btn_edita_fecha">Aceptar</button>
                        </div>
                      </form>
                      </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div id="estado-calendario" class="col-centered">
                        <div class="box-body table-responsive no-padding">
                            <div class="scrollable">
                              <table class="table table-bordered table-striped scrollable" id="tablajson">
                                <thead>
                                  <tr>
                                    <th colspan="3">Número de Días</th>
                                  </tr>
                                  <tr>
                                  <th>#</th>
                                  <th>Seleccionados</th>
                                  <th>Tiempo</th>
                                </tr>
                              </thead>
                              <tbody></tbody>
                              </table>
                            </div>

                          </div>
                        </div>
                    </div>

                </div>
              </div>

          {{-- </section> --}}
        
        <div class="col-md-12" style="margin-top:10px; margin-button:10px; text-align: center">
          <div class="row">
            <div class="btn-group">
                <a type="button" class="btn btn-app bg-green" id="btn-pdf_emergencias" >
                  <i class="fa fa-save"></i> Confirmar
                </a>
            </div>
            <div class="btn-group" style="margin-left:50px;" >
              <a type="button" class="btn btn-app bg-red" id="btn-cancelar_emergencias">
                <i class="fa fa-trash"></i> Cancelar
              </a>
            </div>
          </div>
        </div>
      </div>

    </div>     
    
  </div>
    <!-- /.box-body -->
    {{-- {{dd($derecho)}} --}}

    <!-- /.box-footer-->
    </div>

</section>
@else
<br/><div class='rechazado'><label style='color:#FA206A'>"no tiene permisos para esta seccion"</label>  </div> 
@endcan

{{-- @endsection --}}

<script>
  $(document).ready(function() {
    var id_sol = $("#id_solicitud").val();
  
    var defaultEvents = {
      
      url: 'calendar_datos_emergencias/'+id_sol,
      type: 'GET', // Send post data
      error: function() {
          alert('No se encontró ninguna fecha.');
      }
    };
    
    $('#calendar_emergencias').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,listYear'
        },
        // defaultDate: '2016-01-12',
        // allDay : false,
        aspectRatio: 1,
        weekends: false,
        // editable: true,
        eventLimit: true, // allow "more" link when too many events
        // selectable: true,
        selectHelper: true,
        eventTextColor: 'Black',
        dayClick: function(date) {

            var feriados =  new Array(); 

            $('#calendar_emergencias').fullCalendar('clientEvents', function(event) {
                if (event.feriado) {
                    feriados.push (moment(event.start).format('YYYY-MM-DD'));
                }
            });
            
            if (feriados.indexOf(moment(date).format('YYYY-MM-DD')) >= 0) {
                alertify.success('No puede tomar vacaciones en Feriado!');
                // alert(moment(date).format('YYYY-MM-DD')+' - '+feriados[i]);
            }
            else{
                $('#ModalAdd #start').val(moment(date).format('YYYY-MM-DD'));
                $('#ModalAdd #end').val(moment(date).format('YYYY-MM-DD'));
                $('#ModalAdd').modal('show');
            }
        },
        eventRender: function(event, element) {
            element.bind('dblclick', function() {
                if(event.feriado){
                    alert('feriado');
                }
                else{
                    $('#ModalEdit #id').val(event.id);
                    $('#ModalEdit #title').val(event.title);
                    $('#ModalEdit #color').val(event.color);
                    $('#ModalEdit').modal('show');
                }
            });
            // element.bind('click', function ()
            // {
            //     alert('Clicked !');
            // });
        },
        eventDrop: function(event, delta, revertFunc) { // si changement de position
            edit(event);
        },
        // eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // si changement de longueur
        //     edit(event);
        // },  
        eventOverlap: function(stillEvent, movingEvent) {
            return stillEvent.allDay && movingEvent.allDay;
        },
        events: defaultEvents,
        eventOverlap: false,
        // eventRender: false    
    });

        
    $('#btn-pdf_emergencias').click(function(){
      $('#btn-pdf_emergencias').attr("disabled", true);//desabilitando despues del click
      id_sol = $("#id_solicitud").val();
      guardar_emergencias();
      // window.open('pdf_emergencias_vacacion/'+id_sol);

    });

    $('#btn_quita_fecha').click(function(){
      $('#ModalEdit').modal('hide');
    });

    $('#btn-cancelar_emergencias').click(function(){
    $('#btn-cancelar_emergencias').attr("disabled", true);//desabilitando despues del click
    var div_resul="div_notificacion_sol";
    var id_sol = $("#id_solicitud").val();
      $.ajax({
      type:'POST',
      //url:"borrar_sol", // sending the request to the same page we're on right now
      url:"cancelar_emergencias",
      data:{'id_sol':id_sol},
        success: function(result){
            if (result == 'ok') {
              refrescar();
            }
            else{
              $("#"+div_resul+"").html(result);
            }
        }
      })
    });

  });

function guardar_emergencias(){
  var div_resul="div_notificacion_sol";
  var id_sol = $("#id_solicitud").val();
  $.ajax({
  type:'get',
  //url:"borrar_sol", // sending the request to the same page we're on right now
  url:"agregar_solicitud",
  data:{'id_sol':id_sol},
    success: function(result){
        if (result == 'ok') {
          recargar();//recarga rapida
        }
        else if(result == 'vacio'){
          alert('No seleccionó ninguna fecha para suspender!');
          $('#btn-pdf_emergencias').attr("disabled", false);
        }
        else{
          $("#"+div_resul+"").html(result);
        }
      }
  })
}



function estado_calendario(arg){//get con Json
  $("#tablajson tbody").html("");
  $.getJSON("estado_calendario/"+arg+"",{},function(objetosretorna){
    $("#error").html("");
    var TamanoArray = objetosretorna.length;
    var total = 0;
    var indice = 0;
    var disponible = '';
    $.each(objetosretorna, function(i,items){
      total = total + parseFloat(items.usadas);
      disponible = 'Días disponibles: '+(parseFloat(items.disponible) - total);
      indice ++;
      var nuevaFila =
    "<tr>"
    +"<td>"+indice+"</td>"
    +"<td>"+items.start+"</td>"
    +"<td>"+items.title+"</td>"
    +"</tr>";
    
      $(nuevaFila).appendTo("#tablajson tbody");
    });
    $("#total_disponible").text(disponible);
    $("#total_solicitud").text('Total días solicitados: '+total);
    if(TamanoArray==0){
      var nuevaFila =
      "<tr><td colspan=6>Seleccione un día</td>"
      +"</tr>";
      $(nuevaFila).appendTo("#tablajson tbody");
    }
  });
}
</script>