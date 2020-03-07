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
					<th colspan="22" style="text-align:center">REPORTE DE LA ENCUESTA SERVICIOS TURISTICOS</th>
				</tr>
				<tr>    
					<th>No.</th>
					<th>Destino más consultado</th>
					<th>Paquetes Vendidos/Reservados</th>
					<th>Ingreso generado</th>
				</tr>
			</thead>
	    <tbody>

	    @foreach($turismo as $tur)
		<tr role="row" class="odd">
			<td>{{$tur->id}}</td>
			<td>{{$tur->lugar}}</td>
			<td>{{$tur->venta_paquete}}</td>
			<td>{{$tur->ingreso_turismo}}</td>
		</tr>
	    @endforeach

		</tbody>
		</table>

	</div>
</div>




{{-- {{ $usuarios->links() }} --}}



</div></section>
@endsection