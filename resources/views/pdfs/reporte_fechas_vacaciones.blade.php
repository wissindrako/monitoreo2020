@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection

@section('main-content')

<section  id="contenido_principal">
{{-- {{dd($personal)}} --}}
<div class="box box-primary box-white">
     <div class="box-header">
        <h4 class="box-title">Reporte de vacaciones</h4>	        
		<form   action="{{ url('buscar_usuario_fechas') }}"  method="post"  >
			<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
			<div class="col-md-4">
				<div class="form-group">
					<label class="text-muted ">Fecha de Inicial</label>
					<input type="date" name="fechaingreso" placeholder="Fecha de Ingreso" class="form-control" value="{{ old('fechaingreso') }}" />
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label class="text-muted ">Fecha de Final</label>
					<input type="date" name="fechaingreso" placeholder="Fecha de Ingreso" class="form-control" value="{{ old('fechaingreso') }}" />
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label class="text-muted ">Nombre del Servidor Público</label>
					<div class="input-group">
						<input type="text" class="form-control" id="dato_buscado" name="dato_buscado" required>
						<span class="input-group-btn">
						<input type="submit" class="btn btn-primary" value="buscar" >
						</span>
					</div>
				</div>
			</div>
        </form>

    </div>

<div class="box-body box-white">

    <div class="table-responsive" >

	    <table  class="table table-hover table-striped" cellspacing="0" width="100%">
			<thead>
				<tr>    
					{{-- <th>Dirección</th> --}}
					<th>Unidad</th>
					<th>Nombre</th>
					<th width="10%">CAS</th>
					<th>Dias de Vacación Tomadas</th>
					<th>Dias de Vacación Disponibles</th>
				</tr>
			</thead>
	    <tbody>

	    @foreach($personal as $persona)
		<tr role="row" class="odd">
			{{-- <td>{{ $persona->direccion }}</td> --}}
			<td>{{ $persona->unidad }}</td>
			<td class="mailbox-messages mailbox-name"><a href="javascript:void(0);"  style="display:block"><i class="fa fa-user"></i>&nbsp;&nbsp;{{ $persona->nombre }} {{ $persona->paterno }} {{ $persona->materno }}</a></td>
			<td>{{ $persona->year }}a {{ $persona->month }}m {{ $persona->day }}d</td>
			<td>{{ $persona->computo }}</td>
			<td>{{ $persona->saldo_total }}</td>

		</tr>
	    @endforeach



		</tbody>
		</table>

	</div>
</div>




{{ $usuarios->links() }}

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