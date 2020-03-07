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
		</div>
		<!-- /.box-header -->
		<div class="box-body table-responsive no-padding">
		  <table class="table table-hover table-striped table-bordered">
			<tbody>
			<tr>
				<th>Vehículo</th>
				<th>Distrito asignado</th>
				<th>Asistencia</th>
				<th>Nombre del Conductor</th>
				<th>Teléfono del Conductor</th>
				<th>Nombre del Propietario</th>
			  <th>Teléfono del Propietario</th>
				<th>Organización</th>
				<th>Marca del Vehiculo</th>
				<th>Modelo del Vehiculo</th>
				<th>Placa del Vehiculo</th>
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
					<td>
						@if($transporte->asistencia==0)
							<p style="width: 2rem; height: 2rem; border-radius: 50%; background: red;	justify-content: center; margin:0px auto;"></p>
						@else
							<p style="width: 2rem; height: 2rem; border-radius: 50%; background: green;	justify-content: center; margin:0px auto;"></p>
						@endif
					</td>
					<td>{{$transporte->conductor}}</td>
					<td>{{$transporte->contacto_conductor}}</td>
					<td>{{$transporte->propietario}}</td>
					<td>{{$transporte->contacto_propietario}}</td>
					<td>{{$transporte->origen." - ".$transporte->nombre}}</td>
					<td>{{$transporte->marca}}</td>
					<td>{{$transporte->modelo}}</td>
					<td>{{$transporte->placa}}</td>
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
