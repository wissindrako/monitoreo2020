@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')
<section  id="contenido_principal">

<div class="box box-success">
		<div class="box-header">
				<h3 class="box-title">Lista de solicitud de vacaciones</h3>	
		
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
		  <table class="table table-hover table-striped table-bordered">
			<tbody>
			<tr>
				<th colspan="5" style="text-align:center;">Datos del Servidor Publico</th>
				<th colspan="2" style="text-align:center;">Fecha</th>
				<th colspan="3" style="text-align:center;">Días de Vacación</th>
				<th colspan="2" style="text-align:center;"></th>
			</tr>
			<tr>
				<th>ID</th>
				<th>Unidad</th>
				<th>Nombre</th>
				<th>Fecha Ingreso</th>
			  <th>Item</th>
				<th>Fecha Solicitud</th>
				<th>Fechas Solicitadas</th>
				<th>Dias Solicitados</th>
				<th>Estado</th>
			  <th>Acción</th>
			</tr>
			{{-- // ->where('personal.idarea', $persona->idarea)
			// ->where('vacaciones.id_estado', '=' ,1) --}}
			@php
					$count = 0;
			@endphp
			@foreach ($personal as $p)
				@if ($p->id_usuario != $usuario->id)
				<tr>
					<td>{{$p->id_solicitud}}</td>
					<td>{{$p->sigla}}</td>
					<td>{{$p->nombre.' '.$p->paterno.' '.$p->materno}}</td>
					<td>{{f_formato($p->fechaingreso)}}</td>
					<td>{{$p->item}}</td>
					<td>{{f_formato($p->fecha_solicitud)}}</td>
					<td>{{f_formato_array($p->fechas)}}</td>
					<td>{{$p->dias}}</td>
					@if ($p->estado == 'SOLICITADA')
					<td><span class="badge bg-blue">{{$p->estado}}</span></td>
					<td><button type="button" class="btn  btn-default btn-xs" disabled><i class="fa fa-fw fa-edit"></i></button></td>
					@endif
					@if ($p->estado == 'APROBADA')
					<td><span class="badge bg-yellow">{{$p->estado}}</span></td>
					<td><button type="button" class="btn  btn-default btn-xs" onclick="verinfo_usuario({{  $p->id_solicitud }}, 8)"  ><i class="fa fa-fw fa-edit"></i></button></td>
					@endif
					@if ($p->estado == 'AUTORIZADA')
					<td><span class="badge bg-green">{{$p->estado}}</span></td>
					<td><button type="button" class="btn  btn-default btn-xs" disabled ><i class="fa fa-fw fa-edit"></i></button></td>
					@endif
					@if ($p->estado == 'RECHAZADA')
					<td><span class="badge bg-red">{{$p->estado}}</span></td>
					<td><button type="button" class="btn  btn-default btn-xs" disabled ><i class="fa fa-fw fa-edit"></i></button></td>
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