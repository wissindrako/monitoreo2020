@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')


<section  id="contenido_principal">

<div class="box box-primary box-white">

     <div class="box-header">
        <h4 class="box-title">Usuarios</h4>	        
        <form   action="{{ url('buscar_usuario_duo') }}"  method="post">
				<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
				<div class="input-group input-group-sm">
					<input type="text" class="form-control" value="" id="dato_buscado" name="dato_buscado" required>
					<span class="input-group-btn">
					<input type="submit" class="btn btn-primary" value="buscar" >
					</span>

				</div>
						
        </form>

{{-- 
		<div class="margin" id="botones_control">
			<a href="javascript:void(0);" class="btn btn-xs btn-primary" onclick="cargar_formulario(1);">Agregar Usuario</a>
			<a href="{{ url("/listado_usuarios") }}"  class="btn btn-xs btn-primary" >Listado Usuarios</a> 
			<a href="javascript:void(0);" class="btn btn-xs btn-primary" onclick="cargar_formulario(2);">Roles</a> 
			<a href="javascript:void(0);" class="btn btn-xs btn-primary" onclick="cargar_formulario(3);" >Permisos</a>                                 
		</div> --}}

    </div>

<div class="box-body box-white">

    <div class="table-responsive" >

	    <table  class="table table-hover table-striped" cellspacing="0" width="100%">
			<thead>
				<tr>    
					{{-- <th colspan="5" style="text-align: center">INFORMACION GENERAL</th> --}}
					<th colspan="10" style="text-align:center">CALCULO DE PAGO DE VACACIONES</th>
				</tr>
				<tr>    
					<th>CI</th>
					<th>Nombre</th>
					<th>Dependencia</th>
					<th>Fecha ingreso</th>
					<th>Fecha de Retiro</th>
					<th>Dias Trabajados</th>
					<th>Vacaciones segun CAS</th>
					<th>Calculo de dias segun formula</th>
					<th>Calculo de dias Redondeado</th>
					<th>Monto a pagar</th>
					</tr>
			</thead>
	    <tbody>

	@foreach($usuarios as $usuario)
		<tr role="row" class="odd">
			<td>{{ $usuario->ci }}</td>
			<td>{{ $usuario->nombre.' '. $usuario->paterno.' '.$usuario->materno }}</td>
			<td>{{ $usuario->unidad }}</td>
			<td>{{ $usuario->fechaingreso}}</td>
			<td>{{ $usuario->fechabaja}}</td>
			{{-- {{redondeo_dias(6.6881)}} --}}
			{{-- @php
				$count_vt = 0;
			@endphp
			@foreach ($vac_tomadas as $vt)
				@if ($vt->id_usuario == $usuario->id_usuario)
					@php
						$count_vt = $count_vt + $vt->usadas;
					@endphp				
				@endif
			@endforeach --}}

			@foreach ($ultima_gestion as $ug)
				@if ($ug->id_usuario == $usuario->id_usuario)
					@php
							$desde = new DateTime($ug->desde);
							$hasta = new DateTime($ug->hasta);
							$trabajados = dif_fechas($hasta, $desde);
					@endphp	
				@endif
			@endforeach

			{{-- @php
				$trabajados = dias_trabajados($usuario->fechabaja, $count_vt);
			@endphp --}}
			{{-- {{dd($hasta)}} --}}
		<td>{{$trabajados}}</td>
		@foreach ($cas as $c)
				@if ($c->id_usuario == $usuario->id_usuario)
				@php
					$calif = $c->year;
				@endphp	
				@endif
		@endforeach		
		<td>{{escala($calif,1,1)}}</td>
		@php $segun_formula = round(dias_segun_formula($trabajados, escala($calif,1,1)), 2); @endphp
		<td>{{$segun_formula}}</td>
		@php $redondeado = redondeo_dias(dias_segun_formula($trabajados, escala($calif,1,1))); @endphp
		<td>{{$redondeado}}</td>
		<td>{{$usuario->haber*$redondeado}}</td>
		</tr>
	    @endforeach

		</tbody>
		</table>

	</div>
</div>




{{-- {{ $usuarios->links() }} --}}

@if(count($usuarios)==0)


<div class="box box-primary col-xs-12">

<div class='aprobado' style="margin-top:70px; text-align: center">
 
<label style='color:#177F6B'>
              ... no se encontraron resultados para su busqueda...
</label> 

</div>

 </div> 


@endif

</div></section>
@endsection