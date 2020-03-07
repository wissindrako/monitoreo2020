{{-- @extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection
--}}
@section('main-content') 
{{-- @yield('main-content') --}}

@can('crear_solicitud')
<section id="contenido_principal">
{{-- {{dd($personal)}} --}}
{{-- {{dd($gestiones)}} --}}
{{-- {{dd($ultima_gestion)}} --}}
    <div class="box box-success">
      <div class="box-header with-border">
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

              <h3 class="box-title"><b>Solicitud de vacaciones:  {{$personal[0]->unidad}}</b></h3><br>
              <h3 class="box-title">{{$personal[0]->nombre}} {{$personal[0]->paterno}} {{$personal[0]->materno}}</h3><br>
              <h3 class="box-title">Fecha de Ingreso: {{f_formato($personal[0]->fechaingreso)}} </h3>

              @if($personal[0]->fechabaja == null)
              {{-- <h3 class="box-title">Fecha de Ingreso: {{fecha2text($baja)}} </h3> --}}
              @else 
                 - <span class="badge bg-red"><h3 class="box-title">Fecha de Baja: {{fecha2text($baja)}}</h3></span> 
              @endif

              <br> <h3 class="box-title"> Antiguedad MDCyT: {{$a}} {{$m}} {{$d}} </h3>
  
          <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>

      </div>
{{-- Información sobre vacaciones --}}
{{-- {{dd($gestiones)}} --}}
{{-- @if ($gestiones->isEmpty()) --}}
@if (count($gestiones) == 0)

<div class="box col-xs-12">
    <div class='aprobado' style="margin-top:70px; text-align: center">
    <label style='color:#177F6B'>
        <span>No hay registros para esta Gestion</span>
    </label> 
    </div>
     <div class="margin" style="margin-top:20px; text-align:center;margin-bottom: 50px;">
        <div class="btn-group">
          {{-- 
            Sin ningun registro de gestiones --}}
          <a href="#"  onclick="cargar_formulario(4);" class="btn btn-success" value=" "> Agregar Gestion</a>
        </div>
        <div class="btn-group" style="margin-left:20px; " >
          <a href="{{ url('/') }}" class="btn btn-info" value=" "> cancelar </a>
        </div>
     </div> 
</div> 

@else
@php 
$disponible = 0;
$coun_gest=0;
$hasta = new DateTime($ultima_gestion->hasta);

$diferencia = dif_fechas($hoy, $hasta);

@endphp

    {{-- {{dd($saldo->total)}} --}}
    @if ( $hoy >= $hasta && $diferencia >=365){{--12/06/2018 <= 08/04/2019--}}
    {{-- {{date('Y-m-d', $expira)}} --}}
    
      @if($personal[0]->fechabaja == null)    
        <div class="box col-xs-12">
          <div class="margin" style="margin-top:20px; text-align:center;margin-bottom: 20px;">
             <div class="btn-group">{{-- form(4) ==> nueva Gestion --}}
               <a href="#"  onclick="cargar_formulario(4);" class="btn btn-success" value=" "> Agregar Gestion</a>
             </div>
             <div class="btn-group" style="margin-left:20px; " >
               <a href="{{ url('/') }}" class="btn btn-info" value=" "> cancelar </a>
             </div>
          </div> 
        </div> 
      @endif
    @endif
      <div class="box-body table-responsive no-padding">
        <table class="table table-striped table-responsive no-padding table-hover">
          <tbody>
          <tr>
              <th colspan="2"></th>
              <th colspan="3">Datos CAS</th>
              <th colspan="5">Días de Vacación otorgada en la gestión</th>
          </tr>
          <tr>
              <th>#</th>
              <th>Años Calificados</th>
              <th>Fecha de presentación</th>
              <th>No. de días segun Escala</th>
              <th>Desde Fecha</th>
              <th>Hasta Fecha</th>
              <th>Computo</th>
              <th>Saldo</th>
              {{-- <th style="width: 40px">Label</th> --}}
              <th>Fecha de Prescripción</th>
          </tr>
      @foreach ($gestiones as $gestion)
      {{-- @if ($gestion->cedula == Auth::user()->ci) --}}
      @php 
      $coun_gest++; 

      @endphp
          <tr>
            {{-- {{dd($gestiones)}} --}}
  
              <td>{{$coun_gest}}</td>
              <td>{{$gestion->year}}a {{$gestion->month}}m {{$gestion->day}}d</td>
              <td>{{$gestion->fecha_entrega}}</td>
              @php
              if (($gestion->year >= 5 && $gestion->day >=1) || ($gestion->year > 5 && $gestion->day >=0)) {
                $escala=escala($gestion->year, 0, $gestion->day);
              }else{
                $escala=escala(1, 1, 1);
              }
              @endphp
              <td>{{$escala}} días</td>
  
              <td>{{f_formato($gestion->desde)}}</td>
              <td>{{f_formato($gestion->hasta)}}</td>
              {{-- <td>{{$gestion->total}}</td>
              <td>{{$escala - $gestion->total}}</td> --}}
              <td>{{$gestion->computo}}</td>
              <td>{{$gestion->saldo}}</td>
              @if ($gestion->vigencia < date('Y-m-d'))
              <td><span class="badge bg-red">{{f_formato($gestion->vigencia)}}</span></td>
              @else
              @php
                $disponible = $disponible + $gestion->saldo;
              @endphp
              <td><span class="badge bg-green">{{f_formato($gestion->vigencia)}}</span></td>
              @endif
              
          </tr>
          {{-- @endif --}}
          @endforeach
          </tbody></table>
      </div>

<div id="div_notificacion_sol"></div>

    <!-- /.box-body -->
    {{-- {{dd($derecho)}} --}}

    {{-- @if ( $hasta > $hoy && (($antiguedad->y >= 1 && $antiguedad->d >=1 ) || ($antiguedad->y > 1 && $antiguedad->d >=0 )  )) --}}

    <!-- /.box-footer-->
    @if (count($saldo) > 0)
      @if ( $saldo->total > 0)
      <div class="box-footer">
        <a type="button" class="btn btn-app" id="btn-calendar">
          <i class="fa fa-calendar-plus-o"></i> Solicitar
        </a>
      </div>
      @endif
    @endif

    </div>

    <div class="box" id="div_calendar">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-calendar"></i><b> Solicitud de vacaciones</b></h3>
        </div>
        <div class="box-body">
            {{-- <section  id="contenido_principal"> --}}
                <div id="div_notificacion_sol"></div>
                <div id="div_notificacion_feriado"></div>
                <div class="row">
                    <div class="col-md-12" style="text-align:right; border:0px;"><b><span id="span_solicitud"></span></b></div>
                    
                    <div class="col-md-12">
                      <div class="col-md-3">
                        <div class="row">
                          <table class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                <th colspan="2">Estado de Días de vacación</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td scope="row"><b>Disponible</b></td>
                                <td><h4>{{$disponible}}</h4></td>
                              </tr>
                              <tr>
                                <td scope="row"><b>Solicitados</b></td>
                                <td><b><span id="total_solicitud"></span></b></td>
                              </tr>
                              <tr>
                                <td scope="row"><b>Saldo</b></td>
                                <td><b><span id="total_saldo"></span></b></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
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
                      <div class="col-md-6">
                        <div id="calendar" class="col-centered"></div>
                            
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
                                        <input hidden type="text" name="id_solicitud" id="id_solicitud" class="form-group">
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
                          
                          <!-- Modal -->
                          <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <form method="POST" action="editar_tiempo" id="f_editar_tiempo" class="formentrada">
                                <input hidden type="text" name="id_solicitud" id="id_solicitud_edit" class="form-group">
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


            {{-- </section> --}}
    
    <div class="col-md-12" style="margin-top:10px; margin-button:10px; text-align: center">
      <div class="row">
        <div class="btn-group">
            <a type="button" class="btn btn-app bg-green" id="btn-pdf">
              <i class="fa fa-save"></i> Confirmar
            </a>
        </div>
        <div class="btn-group" style="margin-left:50px;" >
          <a type="button" class="btn btn-app bg-red" id="btn-cancelar">
            <i class="fa fa-trash"></i> Cancelar
          </a>
        </div>
      </div>
    </div>
  </div>
        <!-- /.box-body -->
      </div>

@endif


</section> 
@else
<br/><div class='rechazado'><label style='color:#FA206A'>"no tiene permisos para esta seccion"</label>  </div> 
@endcan

@endsection


