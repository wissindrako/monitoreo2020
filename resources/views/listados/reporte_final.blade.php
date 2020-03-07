@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')


<section  id="contenido_principal">

<div class="box box-primary box-white">

     <div class="box-header">
        {{-- <h4 class="box-title">La información estará disponible a la conculsión del evento.</h4>	         --}}
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
		<img src="img/reports.jpg" style="width:100%" class="" alt="">
	{{-- "<iframe src='docs/reporte_final.pdf' width=1000 height=700>" --}}
		{{-- <iframe style="width:100%" height="500" src="{{asset('docs/reporte_final.pdf')}}" frameborder="0"></iframe> --}}		
</div>
</div>




{{-- {{ $usuarios->links() }} --}}


</div></section>
@endsection