@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')


<section  id="contenido_principal">

<div class="box box-primary box-white">

     <div class="box-header">
        <h4 class="box-title">Visitantes</h4>	        
        <form   action="{{ url('reporte_usuarios') }}"  method="post"  >
			<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
			{{-- <div class="input-group input-group-sm">
				<input type="text" class="form-control" value="" id="dato_buscado" name="dato_buscado" required>
				<span class="input-group-btn">
				<input type="submit" class="btn btn-primary" value="buscar" >
				</span>
			</div> --}}
		</form>
{{-- {{$usuarios}} --}}
{{-- 
		<div class="margin" id="botones_control">
			<a href="javascript:void(0);" class="btn btn-xs btn-primary" onclick="cargar_formulario(1);">Agregar Usuario</a>
			<a href="{{ url("/listado_usuarios") }}"  class="btn btn-xs btn-primary" >Listado Usuarios</a> 
			<a href="javascript:void(0);" class="btn btn-xs btn-primary" onclick="cargar_formulario(2);">Roles</a> 
			<a href="javascript:void(0);" class="btn btn-xs btn-primary" onclick="cargar_formulario(3);" >Permisos</a>                                 
		</div> --}}

    </div>

<div class="box-body box-white">

		<canvas id="pieChart" style="height:200px"></canvas>

		{{-- <div style="text-align:center" ><label for="">{{$total['total']}} Asistentes en Total</label></div> --}}
		<br><hr><br>
		<div style="text-align:center" class="row">

			<div style="text-align:center" class="col-md-3">
				<!-- small box -->
				<div class="small-box bg-green">
					<div class="inner">
						<h3>{{$total['total']}}<sup style="font-size: 20px"></sup></h3>

						<p>Total Visitantes</p>
					</div>
					<div class="icon">
						<i class="ion ion-stats-bars"></i>
					</div>
					<a href="#" class="small-box-footer">
						<i class="fa fa-arrow-circle-right"></i>
					</a>
				</div>
			</div>

		</div>
</div>

</div></section>
@endsection
