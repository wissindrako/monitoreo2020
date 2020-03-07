{{-- @section('main-content') 
@yield('main-content') --}}

@can('crear_solicitud')
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

        <h3 class="box-title"><b>Solicitud de suspensión de vacaciones:  {{$personal[0]->unidad}}</b></h3><br>
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
    <div id="div_calendar_suspension" class="box col-md-12">
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
                              {{-- <div class="external-event ui-draggable ui-draggable-handle" style="background-color: #C6FF00; position: relative;">Feriado</div> --}}
                              <div class="external-event ui-draggable ui-draggable-handle" style="background-color: #F50057; color: rgb(255, 255, 255); position: relative;">Solicitud Reservada </div>
                              <div class="external-event ui-draggable ui-draggable-handle" style="background-color: #099df7c7; color: rgb(255, 255, 255); position: relative;">Suspensión Solicitada</div>
                              <div class="external-event ui-draggable ui-draggable-handle" style="background-color: #ffb100d1; color: rgb(255, 255, 255); position: relative;">Suspensión Aprobada</div>
                              <div class="external-event ui-draggable ui-draggable-handle" style="background-color: #00de78eb; color: rgb(255, 255, 255); position: relative;">Suspensión Autorizada</div>
                            </div>
                          </div>
                          <!-- /.box-body -->
                        </div>
                      </div>
                    </div>
                    <div class="col-md-5">
                      <div id="calendar_suspension" class="col-centered"></div>
                          
                        <!-- Modal -->
                        <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog" role="document">
                          <div class="modal-content">
                          <form method="POST" action="editar_solicitud" id="f_editar_solicitud" class="formentrada">
                          <input  type="hidden" name="id_solicitud" id="id_solicitud" class="form-group" value="{{$id_sol}}">
                            <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Suspender Fecha</h4>
                            </div>
                            <div class="modal-body">
                            
                              <div class="form-group">
                                <label for="tiempo" class="col-sm-12 control-label text-yellow"><h4><b>¿Seguro que quiere suspender la vacación?</b> </h4></label>
                                  <div class="checkbox">
                                  <label class="text-red"><input type="checkbox" name="delete"><b><i class="icon fa fa-warning"></i> Confirmar</b></label>
                                </div>
                                </div>
                              
                              <input type="hidden" name="id" class="form-control" id="id">

                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="submit" id="btn_quita_fecha" class="btn btn-primary">Aceptar</button>
                            </div>
                          </form>
                          </div>
                          </div>
                        </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="">Observación</label>
                      <textarea class="form-control" name="obs" id="obs" rows="3"></textarea>
                    </div>
                  </div>

                </div>
              </div>

          {{-- </section> --}}
        
        <div class="col-md-12" style="margin-top:10px; margin-button:10px; text-align: center">
          <div class="row">
            <div class="btn-group">
                <a type="button" class="btn btn-app bg-green" id="btn-pdf_suspension" >
                  <i class="fa fa-save"></i> Confirmar
                </a>
            </div>
            <div class="btn-group" style="margin-left:50px;" >
              <a type="button" class="btn btn-app bg-red" id="btn-cancelar_suspension">
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
      
      url: 'calendar_datos_suspension/'+id_sol,
      type: 'GET', // Send post data
      error: function() {
          alert('No se encontró ninguna fecha.');
      }
    };
    $('#calendar_suspension').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,listYear'
        },
        // defaultDate: '2016-01-12',
        // allDay : false,
        aspectRatio: 1,
        weekends: false,
        editable: true,
        eventLimit: true, // allow "more" link when too many events
        selectable: true,
        selectHelper: true,

        eventRender: function(event, element) {
            element.bind('dblclick', function() {
                $('#btn_quita_fecha').attr("disabled", false);
                $('#ModalEdit #id').val(event.id);
                $('#ModalEdit #title').val(event.title);
                $('#ModalEdit #color').val(event.color);
                $('#ModalEdit').modal('show');
            });
        },
        events: defaultEvents,
        eventOverlap: false,
        // eventRender: false   
    });

    $('#btn-pdf_suspension').click(function(){
      $('#btn-pdf_suspension').attr("disabled", true);//desabilitando despues del click
      id_sol = $("#id_solicitud").val();
      guardar_suspension();
      // window.open('pdf_suspension_vacacion/'+id_sol);
    });

    $('#btn_quita_fecha').click(function(){
      $('#ModalEdit').modal('hide');
    });

    $('#btn-cancelar_suspension').click(function(){
    $('#btn-cancelar_suspension').attr("disabled", true);//desabilitando despues del click
    var div_resul="div_notificacion_sol";
    var id_sol = $("#id_solicitud").val();
      $.ajax({
      type:'POST',
      //url:"borrar_sol", // sending the request to the same page we're on right now
      url:"cancelar_suspension",
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

function guardar_suspension(){
  var div_resul="div_notificacion_sol";
  var id_sol = $("#id_solicitud").val();
  var obs = $('#obs').val();
  $.ajax({
  type:'POST',
  //url:"borrar_sol", // sending the request to the same page we're on right now
  url:"guardar_suspension",
  data:{'id_sol':id_sol, 'obs':obs},
    success: function(result){
        if (result == 'ok') {
          recargar();//recarga rapida
        }
        else if(result == 'vacio'){
          alert('No seleccionó ninguna fecha para suspender!');
          $('#btn-pdf_suspension').attr("disabled", false);
        }
        else{
          $("#"+div_resul+"").html(result);
        }
      }
  })
}

function refresh_calendar(id_sol){
  var events = {
      url: 'calendar_datos_suspension/'+id_sol,
      type: 'GET', // Send post data
      error: function() {
          alert('No se encontró ninguna fecha.');
      }
  };

  $('#calendar_suspension').fullCalendar('removeEventSource', events);
  $('#calendar_suspension').fullCalendar('addEventSource', events);
  $('#calendar_suspension').fullCalendar('refetchEvents');
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