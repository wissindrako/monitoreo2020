@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')


<section  id="contenido_principal">

<div class="box box-primary box-white">

     <div class="box-header">
        <h4 class="box-title">Usuarios</h4>	        
        <form   action="{{ url('reporte_usuarios') }}"  method="post"  >
					<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
					{{-- <div class="input-group input-group-sm">
						<input type="text" class="form-control" value="" id="dato_buscado" name="dato_buscado" required>
						<span class="input-group-btn">
						<input type="submit" class="btn btn-primary" value="buscar" >
						</span>
					</div> --}}
				</form>
    </div>

<div class="box-body box-white">

    <div class="table-responsive" >

	    <table  class="table table-hover table-striped" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th colspan="22" style="text-align:center">REPORTE DE LA ENCUESTA GASTRONOMIA</th>
				</tr>
				<tr>    
					<th>No.</th>
					@foreach ($platos_tarija as $platos)
					<th> {{$platos->id}} </th>
					@endforeach
					<th>Platos Preparados</th>
					<th>Platos Vendidos</th>
					<th>Prom_Platos</th>
					<th>Ingreso Platos</th>
				</tr>
			</thead>
	    <tbody>

	    @foreach($visitantes as $v)
		<tr role="row" class="odd">
			<td>{{$v->id}}</td>
			@foreach ($platos_tarija as $platos)
			@if ($v->plato == $platos->plato)
			<td>1</td>
			@else
			<td>0</td>
			@endif
			@endforeach
			<td>{{$v->preparados}}</td>
			<td>{{$v->vendidos}}</td>
			<td>{{$v->costo}}</td>
			<td>{{$v->ingreso_gastronomia}}</td>
		</tr>
	    @endforeach

		</tbody>
		</table>

	</div>
</div>




{{-- {{ $usuarios->links() }} --}}



</div></section>
@endsection