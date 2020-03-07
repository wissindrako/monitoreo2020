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
					<th colspan="22" style="text-align:center">REPORTE DE LA ENCUESTA VISITANTE</th>
				</tr>
				<tr>    
					<th>No.</th>
					{{-- <th>Sexo</th> --}}
					@foreach ($sexos as $sexo)
					<th> {{$sexo->genero}} </th>
					@endforeach
					@foreach ($medios_comunicacion as $m_c)
					<th> {{$m_c->medio}} </th>
					@endforeach
					@foreach ($medios_transporte as $m_t)
					<th> {{$m_t->medio}} </th>
					@endforeach
					@foreach ($grado_satisfaccion as $g)
					<th> {{$g->grado}} </th>
					@endforeach
					@foreach ($platos_tarija as $platos)
					{{-- <th> {{$platos->plato}} </th> --}}
					<th> {{$platos->id}} </th>
					@endforeach
					{{-- <th>Plato preferido</th> --}}
					{{-- <th>Fecha ingreso</th>
					<th>Fecha de Retiro</th>
					<th width="10%">Acción</th> --}}
				</tr>
			</thead>
	    <tbody>

	    @foreach($visitantes as $v)
		<tr role="row" class="odd">
			<td>{{$v->id}}</td>
			{{-- <td>{{$v->sexo}}</td> --}}
			@foreach ($sexos as $sexo)
			@if ($v->sexo == $sexo->genero)
			<td>1</td>
			@else
			<td>0</td>
			@endif
			@endforeach
			@foreach ($medios_comunicacion as $m_c)
			@if ($v->medio_comunicacion == $m_c->medio)
			<td>1</td>
			@else
			<td>0</td>
			@endif
			@endforeach
			@foreach ($medios_transporte as $m_t)
			@if ($v->medio_transporte == $m_t->medio)
			<td>1</td>
			@else
			<td>0</td>
			@endif
			@endforeach
			@foreach ($grado_satisfaccion as $g)
			@if ($v->grado_satisfaccion == $g->grado)
			<td>1</td>
			@else
			<td>0</td>
			@endif
			@endforeach
			@foreach ($platos_tarija as $platos)
			@if ($v->plato_preferido == $platos->plato)
			<td>1</td>
			@else
			<td>0</td>
			@endif
			@endforeach
			{{-- <td>{{$v->grado_satisfaccion}}</td> --}}
		</tr>
	    @endforeach

		</tbody>
		</table>

	</div>
</div>




{{-- {{ $usuarios->links() }} --}}



</div></section>
@endsection