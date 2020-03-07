@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection

@section('main-content')
<section  id="contenido_principal">

{{-- <div class="box box-success">
	<div class="box-header">
		<h3 class="box-title">Ranking de vacaciones</h3>
	</div>
	<div class="box-body">
		<div class="col-md-3">
			<div class="form-group">
				<label for="">Ministerio</label>
				<select class="form-control" name="" id="id_min">
					<option value=""> --- SELECCIONE UN MINISTERIO --- </option>
					@foreach ($ministerios as $mins)
						<option value="{{$mins->id}}"> {{$mins->nombre}} </option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group dir_json">
				<label for="">Dirección</label>
				<select class="form-control" name="" id="id_dir">
				</select>
			</div> 
		</div>
		<div class="col-md-3">
			<div class="form-group uni_json">
				<label for="">Unidad</label>
				<select class="form-control" name="" id="id_uni">
				</select>
			</div> 
		</div> 
		<div class="col-md-3">
			<div class="form-group">
				<label for=""></label>
				<a name="" id="" class="btn btn-primary" href="#" role="button">Generar</a>
			</div>
		</div>              
	</div>
</div> --}}


		<div class="box box-success">
				<div class="box-header">
						<h3 class="box-title">Usuarios Parametrizados</h3>
				</div>
				<div class="box-body table-responsive no-padding scrollable">
						<table class="table table-bordered" id="tabla_ranking">
								<thead><tr>
									<!-- <th>ID Usuario</th> -->
									<th>Unidad</th>
									<th>Nombre</th>
									<th>Fecha Ingreso</th>
									<th>Item</th>
									<th>Gestión</th>
									<th>Prescribe</th>
									<th>Escala según CAS</th>
									<th>Días Solicitados</th>
									<th>Días de Vacación Disponibles</th>
								</tr>
								</thead>
								<tbody>
								@foreach ($ranking as $rank)	
								<tr>
								
									<td>{{$rank->unidad}}</td>
									<td>{{$rank->nombre}} {{$rank->paterno}} {{$rank->materno}}</td>
									<td>{{$rank->fechaingreso}}</td>
									<td>{{$rank->item}}</td>
									<td></td>
									<td>{{$rank->vigencia}}</td>
									<td>{{$rank->dias + $rank->total_saldo}}</td>
									<td>{{$rank->dias}}</td>
									<td>{{$rank->total_saldo}}</td>
								
								</tr>
								@endforeach
							{{-- {{dd($ranking)}}	 --}}
							</tbody>
						</table>
						
				</div>
				{{-- <div class="box-footer" align="right"> --}}
					<!-- <form action="excel.php" method="post" target="_blank" id="frmExport">
					<a class="btn btn-app botonExcel">
						<i class="fa fa-file-excel-o"></i> Exportar
					</a>
					<input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
					</form> -->
				{{-- </div> --}}
		</div>
		<!-- /.box -->

</section>
@endsection
