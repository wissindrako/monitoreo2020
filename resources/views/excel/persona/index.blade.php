{{-- {{$data}} --}}
@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')
<section  id="contenido_principal">
                @if(session()->has('mensaje_exito'))
                    <div class="alert alert-success">
                    {{ session()->get('mensaje_exito') }}
                    </div>
                @endif
                @if(session()->has('mensaje_error'))
                    <div class="alert alert-warning">
                    {{ session()->get('mensaje_error') }}
                    </div>
                @endif

                <div class="col-md-12" >
                @if (count($errors) > 0)

                    <div class="alert alert-danger">
                        <strong>UPPS!</strong> Error al Registrar<br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>

                @endif
                </div>

    <form method="post" enctype="multipart/form-data" action="{{ route('guardar_import_contacto') }}">
        {{ csrf_field() }}
        <div class="form-group">
         <table class="table">
          <tr>
           <td width="70%" align="right"><label>Seleccione un archivo para subir</label></td>
           <td width="30">
            <input type="file" name="select_file" />
           </td>
           <td width="30%" align="left">
            <input type="submit" name="upload" class="btn btn-primary" value="Subir">
           </td>
          </tr>
          <tr>
           <td width="70%" align="right"></td>
           <td width="30"><span class="text-muted">.xls, .xslx</span></td>
           <td width="30%" align="left"></td>
          </tr>
         </table>
        </div>
    </form>

<div class="box-heading">
     <h3 class="box-title">Imformación del Usuario - Persona</h3>
</div>

<div class="box box-primary">
		<div class="box-header">
			<h3 class="box-title">Lista de Usuarios - Personas</h3>
		</div>
		<!-- /.box-header -->
		{{-- {{dd($personas)}} --}}
		<div class="box-body table-responsive no-padding">

		   <table class="table table-bordered" id="tabla-empresas" style='width: 100% !important;'>
		        <thead>
		           
		                <th>#</th>
		                <th>Username</th>
		                <th>Persona</th>
		                <th>Rol</th>
		                <th>Activo</th>
		         
		        </thead>
                @foreach($data as $key => $row)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $row->usuario ? $row->usuario->name : ''}}</td>
                    <td>
                        {{ $row->nombre}}
                        {{ $row->paterno ? $row->paterno : '' }}
                        {{ $row->materno ? $row->materno : '' }}
                    
                    </td>
                    <td>{{ $row->roles_persona->slug ? $row->roles_persona->slug : 'No asignado' }}</td>
                    <td>{{ $row->activo == 1 ? 'Activo' : 'Inactivo' }}</td>
                </tr>
                @endforeach
		    </table>
		 </div>   
	
</div>  


</section>
@endsection