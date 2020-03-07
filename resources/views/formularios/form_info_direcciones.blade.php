@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection

@section('main-content')


<section  id="contenido_principal">

<div class="wrap-content">
	<div class="box-body box-white">

		<div class="table-responsive" >
	
			<table  class="table table-hover table-striped" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Id</th>
						<th>Dirección</th>
					</tr>
				</thead>
			<tbody>
	
			@foreach($direcciones as $direccion)
				<tr role="row" class="odd">
					<td>{{ $direccion->iddireccion }}</td>
					<td>{{ $direccion->nombredireccion }}</td>
				</tr>
			@endforeach
	
			</tbody>
			</table>
	
		</div>
	</div>
	
	
	
	
	{{ $direcciones->links() }}
	
	@if(count($direcciones)==0)
	
	
	<div class="box box-primary col-xs-12">
	
		<div class='aprobado' style="margin-top:70px; text-align: center">
		
			<label style='color:#177F6B'>
						... no se encontraron resultados para su busqueda...
			</label> 
	
		</div>
	
		</div> 
	@endif
</div>

<div class="wrap-content">
	<div class="box-body box-white">
		<div class="table-responsive" >
			<table  class="table table-hover table-striped" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Id</th>
						<th>Dirección</th>
					</tr>
				</thead>
			<tbody>
			@foreach($unidades as $unidad)
				<tr role="row" class="odd">
					<td>{{ $unidad->idunidad }}</td>
					<td>{{ $unidad->nombreunidad }}</td>
				</tr>
			@endforeach
			</tbody>
			</table>
	
		</div>
	</div>
	
	
	
	
	{{-- {{ $unidades->links() }} --}}
	
	@if(count($unidades)==0)
	
	
	<div class="box box-primary col-xs-12">
		<div class='aprobado' style="margin-top:70px; text-align: center">
			<label style='color:#177F6B'>
				... no se encontraron resultados para su busqueda...
			</label> 
		</div>
	</div> 
</div>

@endif


@endsection