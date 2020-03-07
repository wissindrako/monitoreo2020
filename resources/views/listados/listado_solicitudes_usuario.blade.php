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
		{{-- {{dd($personal[1]->fechas)}} --}}
		{{-- {{dd($dias)}} --}}
		<div class="box-body table-responsive no-padding">
		  <table class="table table-hover">
			<tbody>
				<tr>
					<th colspan="3"></th>
					<th colspan="3" style="text-align:center;">Días de Vacacion</th>
					<th colspan="1"></th>
					<th colspan="1"></th>
				</tr>
				<tr>
			  <th>ID</th>
				{{-- <th>Nombre</th>
				<th>Fecha Ingreso</th>
			  <th>Item</th> --}}
				<th>Fecha Solicitud</th>
				<th>Fechas Solicitadas</th>
				<th>Disponibles</th>
				<th>Solicitados</th>
				<th>Saldo</th>
				<th>Estado</th>
			  <th width="10%">Acción</th>
			</tr>

			@php
					$count = 0;
			@endphp
			@foreach ($personal as $p)
				<tr>
						<td>{{$p->id_solicitud}}</td>
						{{-- <td>{{$p->nombre.' '.$p->paterno.' '.$p->materno}}</td>
						<td>{{$p->fechaingreso}}</td>
						<td>{{$p->item}}</td> --}}
						<td>{{f_formato($p->fecha_solicitud)}}</td>
						<td>{{f_formato_array($p->fechas)}}</td>
						<td>{{$dias[0]->disponibles}}</td>
						<td>{{$p->dias}}</td>
						<td>{{$dias[0]->disponibles - $p->dias}}</td>
						@if ($p->estado == 'SOLICITADA')
						<td><span class="badge bg-blue">&nbsp;{{$p->estado}}&nbsp;</span></td>
						<td><button type="button" class="btn btn-default btn-xs" disabled><i class="fa fa-fw fa-print"></i></button>
							<button type="button" class="btn btn-default btn-xs" disabled><i class="fa fa-calendar-minus-o"></i></button>
							<button type="button" class="btn btn-default btn-xs" onclick="verinfo_usuario({{ $p->id_solicitud }}, 12)" ><i class="fa fa-times-circle"></i></button></td>
						@endif
						@if ($p->estado == 'APROBADA')
						<td><span class="badge bg-yellow">&nbsp;&nbsp;{{$p->estado}}&nbsp;&nbsp;</span></td>
						<td>
							<button type="button" class="btn btn-default btn-xs" onclick="window.open('pdf_sol_vacacion/'+{{ $p->id_solicitud }})" ><i class="fa fa-fw fa-print"></i></button>
							<button type="button" class="btn btn-default btn-xs" disabled><i class="fa fa-calendar-minus-o"></i></button>
							<button type="button" class="btn btn-default btn-xs" onclick="verinfo_usuario({{ $p->id_solicitud }}, 12)"><i class="fa fa-times-circle"></i></button></td>
						@endif
						@if ($p->estado == 'AUTORIZADA')
						<td><span class="badge bg-green">{{$p->estado}}</span></td>
						<td>
							<button type="button" class="btn btn-default btn-xs" disabled><i class="fa fa-fw fa-print"></i></button>
							<button type="button" class="btn btn-default btn-xs" onclick="verinfo_usuario({{ $p->id_solicitud }}, 9)" ><i class="fa fa-calendar-minus-o"></i></button>
						</td>
						@endif
						@if ($p->estado == 'RECHAZADA')
						<td><span class="badge bg-red">{{$p->estado}}</span></td>
						{{-- <td><button type="button" class="btn btn-default btn-xs" disabled ><i class="fa fa-fw fa-edit"></i></button></td> --}}
						@endif
						@if ($p->estado == 'ANULADA')
						<td><span class="badge bg-gray">&nbsp;&nbsp;&nbsp;&nbsp;{{$p->estado}}&nbsp;&nbsp;&nbsp;</span></td>
						<td></td>
						{{-- <td><button type="button" class="btn btn-default btn-xs" disabled ><i class="fa fa-fw fa-edit"></i></button></td> --}}
						@endif	
						{{-- <td><button type="button" class="btn btn-default btn-xs" onclick="verinfo_usuario({{  $p->id_solicitud }}, 8)" ><i class="fa fa-fw fa-edit"></i></button></td> --}}
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