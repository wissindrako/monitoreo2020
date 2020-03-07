@can('aprobar_solicitud')
<section  class="content">

{{-- Información sobre vacaciones --}}
<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">CONTROL DE VACACIONES</h3>

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
                    <h3 class="box-title"><b>DATOS DEL SERVIDOR PÚBLICO: </b></h3><br><br>
                    <div class="row">
                        <div class="col-md-3 col-sm-4 col-xs-12"><h3 class="box-title"><b>Unidad Organizacional: </b></h3></div><div class="col-md-9 col-sm-8 col-xs-12"><h3 class="box-title">{{$personal[0]->unidad}}</h3></div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-sm-4 col-xs-12"><h3 class="box-title"><b>Nombre: </b></h3></div><div class="col-md-9 col-sm-8 col-xs-12"><h3 class="box-title">{{$personal[0]->nombre}} {{$personal[0]->paterno}} {{$personal[0]->materno}}</h3></div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-sm-4 col-xs-12"><h3 class="box-title"><b>Fecha de Ingreso: </b></h3></div><div class="col-md-9 col-sm-8 col-xs-12"><h3 class="box-title">{{f_formato($personal[0]->fechaingreso)}}</h3></div>
                    </div>
                    @if($personal[0]->fechabaja == null)
                    {{-- <h3 class="box-title">Fecha de Ingreso: {{fecha2text($baja)}} </h3> --}}
                    @else 
                        - <span class="badge bg-red"><h3 class="box-title">Fecha de Baja: {{fecha2text($baja)}}</h3></span> 
                    @endif
                    <div class="row">
                        <div class="col-md-3 col-sm-4 col-xs-12"><h3 class="box-title"><b>Antiguedad MDCyT: </b></h3></div><div class="col-md-9 col-sm-8 col-xs-12"><h3 class="box-title">{{$a}} {{$m}} {{$d}}</h3></div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-sm-4 col-xs-12"><h3 class="box-title"><b>CAS: </b></h3></div><div class="col-md-9 col-sm-8 col-xs-12"><h3 class="box-title">{{$a}} {{$m}} {{$d}}</h3></div>
                    </div>
                </div>
            </div>
        </div>

    <form  action="{{ url('aprobar_solicitud') }}"  method="post" id="f_aprobar_solicitud" class="formentrada" >

        <div class="col-md-12">
            <hr>
            <h4 class="box-title"><b>DÍAS DE VACACIÓN: </b></h4>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <h3 style="background-color:#b388ff; font-size: 18px; text-align: center; padding: 7px 10px; margin-top: 0;">
                    Disponibles: {{$disponibles[0]->saldo}}
                </h3>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <h3 style="background-color:#8c9eff; font-size: 18px; text-align: center; padding: 7px 10px; margin-top: 0;">
                    Solicitados: {{$total[0]->total}}
                </h3>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <h3 style="background-color:#82b1ff; font-size: 18px; text-align: center; padding: 7px 10px; margin-top: 0;">
                    Saldo: {{$disponibles[0]->saldo - $total[0]->total}}
                </h3>
            </div>
            <hr><hr><hr>
        </div>
        <div class="col-md-12">
            <h4 class="box-title"><b>DETALLE DE DÍAS SOLICITADOS:</b></h4>
        </div>
        <div class="col-md-12">
            <div class="box-body table-responsive no-padding">
                <table class="table table-striped table-responsive table-bordered">
                    <thead>
                        <tr>
                            @foreach ($usadas as $item)
                            <th>{{$item->title}}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        @foreach ($usadas as $item)
                            @if ($item->tiempo == 1)
                            <td>{{f_formato_array($item->inicio)}}</td>
                            @endif
                            @if ($item->tiempo == 2)
                            <td>{{f_formato_array($item->inicio)}}</td>
                            @endif
                            @if ($item->tiempo == 3)
                            <td>{{f_formato_array($item->inicio)}}</td>
                            @endif
                        @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
        <input type="hidden" id="id_solicitud" name="id_solicitud" value="{{ $personal[0]->id_solicitud}}"> 
        <!-- text input -->
        {{-- <div class="col-md-3"></div> --}}
        <hr>
    <div class="" style="">
            
        <div class="col-md-5 col-sm-4 col-xs-12">
            {{-- <div class="row">
                <div class="form-group"> --}}
                    {{-- <label>Autoriza la vacación por:</label> --}}
                    {{-- <input type="number" class="form-control" name="dias_autorizados" value="{{$personal[0]->dias_solicitados}}" placeholder="días" min="1" max="{{$personal[0]->dias_solicitados}}"> --}}
                {{-- </div>
            </div> --}}
            <div class="row">
                <div class="form-group">
                    <label>Observaciones</label>
                    <textarea class="form-control" id="obs" name='obs' rows="3" placeholder=""></textarea>
                </div>
            </div>
        </div>
        <div class="col-md-7 col-sm-8 col-xs-12">
            <label>Autorización</label>
            <div style="border:1px solid #b1cada;">
                <div class="row"><br></div>    
                <div class="row">       
                    <div class="col-xs-6" style="text-align: center;">
                        <button type="submit" class="btn btn-primary">Aprobar Solicitud</button>
                    </div>
                    <div class="col-xs-6" style="text-align: center;">
                        <button type="button" id="btn-reprobar" class="btn btn-default">Rechazar Solicitud</button>
                    </div>
                </div>
                <div class="row"><br></div>    
            </div>
        </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer" style="">
        {{-- Footer --}}
    </div>
    </div>

</form>
</div>

</section>
@else
<br/><div class='rechazado'><label style='color:#FA206A'>"no tiene permisos para esta seccion"</label>  </div> 
@endcan

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