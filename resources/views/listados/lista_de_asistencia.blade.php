@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')
<section  id="contenido_principal">

<div class="box box-success">
		<div class="box-header">
		<h3 class="box-title">Lista de Asistencia a: <b>{{$listas[0]->detalle}} </b></h3><br>
		<h3 class="box-title">Fecha: <b>{{$fecha}}</b> </h3>

		  <div class="box-tools">
			{{-- <div class="input-group input-group-sm" style="width: 150px;">
			  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

			  <div class="input-group-btn">
				<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
			  </div>
			</div> --}}
		  </div>


			<div class="box-header">
				<h4 class="box-title">Buscar</h4>
				<form   action="{{ url('lista_de_asistencia_buscar') }}"  method="post"  >
					<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
					<input type="hidden" name="fecha" value="{{$fecha}}">
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
				<th>Nro</th>
				<th>Circunscripción</th>
				<th>Distrito</th>
				<th>Zona</th>
				<th>Recinto</th>
				<th>Dirección del Recinto</th>
				<th>Asistencia</th>
				<th>Usuario</th>
				<th>Tipo de Usuario</th>
				<th>Nombre Completo</th>
				<th>Cédula</th>
				<th>Contacto</th>
				<th>Dirección</th>
				<th>Organización</th>
			</tr>
			@php
					$count = 0;
			@endphp
			@foreach ($listas as $lista)
				<tr>
					@php
							$count++;
					@endphp
					<td>{{$count}}</td>
					<td>{{$lista->circunscripcion}}</td>
					<td>{{$lista->distrito}}</td>
					<td>{{$lista->zona}}</td>
					<td>{{$lista->recinto}}</td>
					<td>{{$lista->direccion_recinto}}</td>
					<td>
						@if($lista->asistencia==0)
							<p style="width: 2rem; height: 2rem; border-radius: 50%; background: red;	justify-content: center; margin:0px auto;"></p>
						@else
							<p style="width: 2rem; height: 2rem; border-radius: 50%; background: green;	justify-content: center; margin:0px auto;"></p>
						@endif
					</td>
					<td>{{$lista->name." / ".$lista->email}}</td>
					<td>{{$lista->rol}}</td>
					<td>{{$lista->nombre_usuario." ".$lista->paterno." ".$lista->materno}}</td>
					<td>{{$lista->cedula_identidad." ".$lista->complemento_cedula." ".$lista->expedido}}</td>
					<td>{{$lista->telefono_celular." - ".$lista->telefono_referencia}}</td>
					<td>{{$lista->direccion_usuario}}</td>
					<td>{{$lista->origen." - ".$lista->nombre_sub_origen}}</td>
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
