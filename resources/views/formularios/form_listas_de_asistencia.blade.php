@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')
<section  id="contenido_principal">

<div class="box box-success">
		<div class="box-header">
				<h3 class="box-title">Listas de Asitencia</h3>

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
				<th>Lista</th>
				<th>Fecha de la lista</th>
				<th>Detalle</th>
				<th>Revisar</th>
				<!--th>Eliminar</th-->
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
					<td>{{$lista->fecha}}</td>
					<td>{{$lista->detalle}}</td>
					@role('responsable_recinto')
					<td>
						<form action="{{ url('lista_de_asistencia_recinto') }}" method="post">
							<input type="hidden" name="fecha" value="{{ $lista->fecha }}">
							<button type="submit" class="btn btn-default btn-xs"><i class="fa fa-fw fa-eye"></i> Revisar</button>
						</form>
					</td>
					@endrole
					@role('admin')
					<td>
						<form action="{{ url('lista_de_asistencia') }}" method="post">
							<input type="hidden" name="fecha" value="{{ $lista->fecha }}">
							<button type="submit" class="btn btn-default btn-xs"><i class="fa fa-fw fa-eye"></i> Revisar</button>
						</form>
					</td>
					@endrole
					<!--td>
						<form action="{{ url('lista_de_asistencia') }}" method="post">
							<input type="hidden" name="fecha" value="{{ $lista->fecha }}">
							<button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-fw fa-close"></i> Eliminar</button>
						</form>
					</td-->
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
