@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')
<section  id="contenido_principal">

<div class="box box-success">
		<div class="box-header">
				@if (count($personal) > 0)
				<h3 class="box-title">Control de Vacaciones:  {{$personal[0]->unidad}}</h3>
				@endif
				
		
		  <div class="box-tools">
			{{-- <div class="input-group input-group-sm" style="width: 150px;">
			  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

			  <div class="input-group-btn">
				<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
			  </div>
			</div> --}}
		  </div>
		</div>
		<!-- /.box-header -->
		{{-- {{dd($personal)}} --}}
		<div class="box-body table-responsive no-padding" id="div-suspension">
		  <table class="table table-hover">
			<tbody><tr>
				<th>ID Suspensión</th>
			  <th>ID Vacación</th>
				<th>Nombre</th>
				<th>Fecha Ingreso</th>
			  <th>Item</th>
				<th>Fecha Solicitud</th>
				<th>Fechas Solicitadas</th>
				<th># Días a Suspender</th>
				<th>Observación</th>
				<th>Estado</th>
			  <th width="10%">Acción</th>
			</tr>
			{{-- // ->where('personal.idarea', $persona->idarea)
			// ->where('vacaciones.id_estado', '=' ,1) --}}
			@php
					$count = 0;
			@endphp
			@foreach ($personal as $p)
				@if ($p->id_usuario != $usuario->id)
				<tr>
					<td>{{$p->id_suspension}}</td>
					<td>{{$p->id_solicitud}}</td>
					<td>{{$p->nombre.' '.$p->paterno.' '.$p->materno}}</td>
					<td>{{f_formato($p->fechaingreso)}}</td>
					<td>{{$p->item}}</td>
					<td>{{f_formato($p->fecha_sol_susp)}}</td>
					<td>{{f_formato_array($p->fechas)}}</td>
					<td>{{$p->dias}}</td>
					<td>{{$p->observacion }}</td>
					@if ($p->estado == 'SOLICITADA')
					<td><span class="badge bg-blue">{{$p->estado}}</span></td>
					<td>
						<button type="button" class="btn  btn-success btn-xs" onclick="aceptar_suspension_unidad({{  $p->id_suspension }})" ><i class="fa fa-fw fa-check"></i></button>
						<button type="button" class="btn  btn-default btn-xs" onclick="verinfo_usuario({{  $p->id_suspension }}, 10)" ><i class="fa fa-fw fa-eye"></i></button>
					</td>
					@endif
					@if ($p->estado == 'APROBADA')
					<td><span class="badge bg-yellow">{{$p->estado}}</span></td>
					<td>
						<button type="button" class="btn  btn-success btn-xs" disabled onclick="aceptar_suspension_unidad({{  $p->id_suspension }})" ><i class="fa fa-fw fa-check"></i></button>
						<button type="button" class="btn  btn-default btn-xs" disabled onclick="verinfo_usuario({{  $p->id_suspension }}, 10)" ><i class="fa fa-fw fa-eye"></i></button>
					</td>
					@endif
					@if ($p->estado == 'AUTORIZADA')
					<td><span class="badge bg-green">{{$p->estado}}</span></td>
					<td>
						<button type="button" class="btn  btn-success btn-xs" disabled onclick="aceptar_suspension_unidad({{  $p->id_suspension }})" ><i class="fa fa-fw fa-check"></i></button>
						<button type="button" class="btn  btn-default btn-xs" disabled onclick="verinfo_usuario({{  $p->id_suspension }}, 10)" ><i class="fa fa-fw fa-eye"></i></button>
					</td>
					@endif
					@if ($p->estado == 'REPROBADA')
					<td><span class="badge bg-red">{{$p->estado}}</span></td>
					<td>
						<button type="button" class="btn  btn-success btn-xs" disabled onclick="aceptar_suspension_unidad({{  $p->id_suspension }})" ><i class="fa fa-fw fa-check"></i></button>
						<button type="button" class="btn  btn-default btn-xs" disabled onclick="verinfo_usuario({{  $p->id_suspension }}, 10)" ><i class="fa fa-fw fa-eye"></i></button>
					</td>
					@endif
				</tr>
				@endif
					@php
						$count++;
					@endphp
			@endforeach

			</tbody></table>
			@if ($count == 0)
			<div class="box box-primary col-xs-12">
				<div class='aprobado' style="margin-top:70px; text-align: center">
				<label style='color:#177F6B'>
											... no se encontraron resultados para su busqueda...
				</label> 
				</div>
			</div> 
		@endif
		</div>
		<!-- /.box-body -->
	  </div>

</section>
@endsection