@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')
<section  id="contenido_principal">

<div class="box box-success">
		<div class="box-header">
				<h3 class="box-title">Lista de Suspensión de vacaciones</h3>	
		
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
				<th>ID Suspensión</th>
				<th>ID Vacación</th>
				<th>Fecha Solicitud</th>
				<th>Fechas Solicitadas</th>
				<th># Días a Suspender</th>
				<th>Observación</th>
				<th>Estado</th>
			  <th>Acción</th>
			</tr>

			@php
					$count = 0;
			@endphp
			@foreach ($personal as $p)
				<tr>
						<td>{{$p->id_suspension}}</td>
						<td>{{$p->id_solicitud}}</td>
						<td>{{f_formato($p->fecha_sol_susp)}}</td>
						<td>{{f_formato_array($p->fechas)}}</td>
						<td>{{$p->dias}}</td>
						<td>{{$p->observacion }}</td>
						@if ($p->estado == 'SOLICITADA')
						<td><span class="badge bg-blue">{{$p->estado}}</span></td>
						<td><button type="button" class="btn btn-default btn-xs" disabled ><i class="fa fa-fw fa-print"></i></button>
						@endif
						@if ($p->estado == 'APROBADA')
						<td><span class="badge bg-yellow">{{$p->estado}}</span></td>
						<td><button type="button" class="btn btn-default btn-xs" onclick="window.open('pdf_sol_suspension/'+{{ $p->id_suspension }})" ><i class="fa fa-fw fa-print"></i></button>
						@endif
						@if ($p->estado == 'AUTORIZADA')
						<td><span class="badge bg-green">{{$p->estado}}</span></td>
						<td><button type="button" class="btn btn-default btn-xs" disabled ><i class="fa fa-fw fa-print"></i></button>
						@endif
						@if ($p->estado == 'REPROBADA')
						<td><span class="badge bg-red">{{$p->estado}}</span></td>
						<td><button type="button" class="btn btn-default btn-xs" disabled ><i class="fa fa-fw fa-print"></i></button>
						@endif
	
					</tr>
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