@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')
<section  id="contenido_principal">

<div class="box box-success">
		<div class="box-header">
				<h3 class="box-title">Lista de medios de transporte</h3>

		  <div class="box-tools">
			{{-- <div class="input-group input-group-sm" style="width: 150px;">
			  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

			  <div class="input-group-btn">
				<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
			  </div>
			</div> --}}
		  </div>

			<div class="box-header">
				<h4 class="box-title">Medios de transporte</h4>
				<form   action="{{ url('buscar_transportes') }}"  method="post"  >
					<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
					<div class="input-group input-group-sm">
						<input type="text" class="form-control" name="dato_buscado" required>
						<span class="input-group-btn">
						<input type="submit" class="btn btn-primary" value="Buscar" >
						</span>
					</div>
				</form>
			</div>
		</div>
		<!-- /.box-header -->
		<div class="box-body table-responsive no-padding">
		  <table class="table table-hover table-striped table-bordered">
			<tbody>
			<tr>
				<th>Vehículo</th>
				<th>Distrito asignado</th>
				<th>Nombre del Conductor</th>
				<th>Teléfono del Conductor</th>
				<th>Nombre del Propietario</th>
			  <th>Teléfono del Propietario</th>
				<th>Organización</th>
				<th>Marca del Vehiculo</th>
				<th>Modelo del Vehiculo</th>
				<th>Placa del Vehiculo</th>
				<th colspan="2">Acción </th>
			</tr>
			@php
					$count = 0;
			@endphp
			@foreach ($transportes as $transporte)
				<tr>
					@php
							$count++;
					@endphp
					<td>{{$count}}</td>
					<td>{{$transporte->distrito}}</td>
					<td>{{$transporte->nombre." ".$transporte->paterno." ".$transporte->materno}}</td>
					<td>{{$transporte->telefono_celular." - ".$transporte->telefono_referencia}}</td>
					<td>{{$transporte->propietario}}</td>
					<td>{{$transporte->contacto_propietario}}</td>
					<td>{{$transporte->origen." - ".$transporte->nombre_sub_origen}}</td>
					<td>{{$transporte->marca}}</td>
					<td>{{$transporte->modelo}}</td>
					<td>{{$transporte->placa}}</td>
					@if ($transporte->placa != 1)
					<td><button type="button" class="btn btn-success btn-xs" onclick="verinfo_persona({{ $transporte->placa }}, 1)" ><i class="fa fa-pencil-square-o"></i></button></td>
					<td><button type="button" class="btn btn-danger btn-xs" onclick="verinfo_persona({{ $transporte->placa }}, 2)" ><i class="fa fa-fw fa-user-times"></i></button></td>
					@else
					<td><button disabled type="button" class="btn btn-success btn-xs" ><i class="fa fa-pencil-square-o"></i></button></td>
					<td><button disabled type="button" class="btn btn-danger btn-xs"  ><i class="fa fa-fw fa-user-times"></i></button></td>
					@endif
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
