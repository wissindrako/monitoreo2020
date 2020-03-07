{{-- @can('aprobar_solicitud') --}}
<section  class="content">

{{-- Información sobre vacaciones --}}

<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">Control de Suspensión de Vacaciones</h3>

        <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fa fa-minus"></i></button>
        </div>
    </div>
    <div class="box-body">
        <div class="col-md-12">
            <div class="row">
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
                    <h3 class="box-title"><b>Datos del Servidor Público: </b></h3><br><br>
                    <h3 class="box-title">{{$personal[0]->unidad}}</h3><br>
                    <h3 class="box-title">{{$personal[0]->nombre}} {{$personal[0]->paterno}} {{$personal[0]->materno}}</h3><br>
                    <h3 class="box-title">Fecha de Ingreso: {{f_formato($personal[0]->fechaingreso)}} </h3>
                    @if($personal[0]->fechabaja == null)
                    {{-- <h3 class="box-title">Fecha de Ingreso: {{fecha2text($baja)}} </h3> --}}
                    @else 
                        - <span class="badge bg-red"><h3 class="box-title">Fecha de Baja: {{fecha2text($baja)}}</h3></span> 
                    @endif
                
                    <br> <h3 class="box-title"> Antiguedad MDCyT: {{$a}} {{$m}} {{$d}} </h3>
                </div>
            </div>
        </div>
    </div>
</div>

    <form  action="{{ url('aprobar_solicitud') }}"  method="post" id="f_aprobar_solicitud" class="formentrada" >
<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">Detalle de días solicitados </h3>
        
        <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fa fa-minus"></i></button>
        </div>
    </div>

    <!-- /.box-header -->
    <div class="box-body">

        
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
        <input type="hidden" id="id_solicitud" name="id_solicitud" value="{{ $personal[0]->id_solicitud}}"> 
        <!-- text input -->
        {{-- <div class="col-md-3"></div> --}}
        <div class="col-md-9">
          <div class="box-body">
              @foreach ($usadas as $item)
                <ul>
                  <li>{{$item->title}}</li>
                    <ul>
                      <li>{{f_formato_array($item->inicio)}}</li>
                    </ul>
                </ul>
              @endforeach
            </div>
        </div>
        <!-- /.box-header -->
        <div class="row">
            <div class="col-md-6" style="text-align:center";>
            <h5><b>Días disponibles: {{$disponibles[0]->saldo}}</b></h5>
            </div>
            <div class="col-md-6" style="text-align:center";>
            <h5><b>Total días solicitados: {{$total[0]->total}}</b></h5>
            </div>

        </div>
    </div>
    <!-- /.box-body -->
</div>

<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">Detalle de días a suspender</h3>

        <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fa fa-minus"></i></button>
        </div>
    </div>
    <div class="box-body" style="">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
        <input type="hidden" id="id_solicitud" name="id_solicitud" value="{{ $personal[0]->id_solicitud}}"> 
        <!-- text input -->
        {{-- <div class="col-md-3"></div> --}}
        <div class="col-md-9">
          <div class="box-body">
              @foreach ($suspendidas as $item)
                <ul>
                  <li>{{$item->title}}</li>
                    <ul>
                      <li>{{f_formato_array($item->fechas_sus)}}</li>
                    </ul>
                </ul>
              @endforeach
            </div>
        </div>
        <!-- /.box-header -->
        <div class="row">
            {{-- <div class="col-md-6" style="text-align:center";>
            <h5><b>Días disponibles: {{$disponibles[0]->saldo - $total[0]->total}}</b></h5>
            </div>
            <div class="col-md-6" style="text-align:center";>
            <h5><b>Total días solicitados: {{$total[0]->total}}</b></h5>
            </div> --}}
        </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer" style="">
        <button type="button" class="btn btn-default" id="cerrar_modal">Cerrar</button>
    </div>
    </div>

</form>
</div>

</section>
{{-- @else
<br/><div class='rechazado'><label style='color:#FA206A'>"no tiene permisos para esta seccion"</label>  </div> 
@endcan --}}

<script>

$('#btn-reprobar').click(function(){
    var div_resul="capa_formularios";
    var id_solicitud = $("#id_solicitud").val();
    var obs = $("#obs").val();
    $.ajax({
      type:'POST',
      url:"reprobar_solicitud", // sending the request to the same page we're on right now
      data:{'id_solicitud':id_solicitud, 'obs':obs},
         success: function(result){
              if (result == 'ok') {
                refrescar();
              }
              else if(result == 'obs'){
                $("#"+div_resul+"").html('<div class="box box-danger col-xs-12"><div class="rechazado" style="margin-top:70px; text-align: center">    <span class="label label-success">Error de Solicitud<i class="fa fa-check"></i></span><br/>  <label style="color:#177F6B">  Debe llenar el campo Observación  </label>   </div></div> ');
                refrescar();
              }
              else{
                $("#"+div_resul+"").html('<div class="box box-danger col-xs-12"><div class="rechazado" style="margin-top:70px; text-align: center">    <span class="label label-success">Error de Solicitud<i class="fa fa-check"></i></span><br/>  <label style="color:#177F6B">  No se pudo enviar la solicitud, revise su conexión </label>   </div></div> ');
                refrescar();
              }
          }
      }
  )

  });
</script>