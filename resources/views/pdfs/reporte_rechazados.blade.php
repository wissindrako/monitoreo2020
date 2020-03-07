@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')
<section  id="contenido_principal">

	<div class="box box-success">
			<div class="box-header">
				<h3 class="box-title">Reporte de Suspensión de vacaciones </h3>	
					
			
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
			<div class="box-body table-responsive no-padding">
				<table class="table table-hover">
				<tbody><tr>
					<th>Formulario</th>
					{{-- <th>ID Vacación</th> --}}
					<th>Unidad</th>
					<th>Nombre</th>
					<th>Fecha Ingreso</th>
					<th>Item</th>
					<th>Fecha Solicitud</th>
					<th>Fechas Solicitadas</th>
					<th># Días a Suspender</th>
					<th>Observación</th>
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
						{{-- <td>{{$p->id_solicitud}}</td> --}}
						<td>{{$p->unidad}}</td>
						<td>{{$p->nombre.' '.$p->paterno.' '.$p->materno}}</td>
						<td>{{f_formato($p->fechaingreso)}}</td>
						<td>{{$p->item}}</td>
						<td>{{f_formato($p->fecha_sol_susp)}}</td>
						<td>{{f_formato_array($p->fechas)}}</td>
						<td>{{$p->dias}}</td>
						<td>{{$p->observacion }}</td>
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