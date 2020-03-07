@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')


<section  id="contenido_principal">

@include('menu.menu_directorio')


<div class="box box-primary">
		<div id='table_responsive' style='min-height: 700px;' >

		   <table class="table table-bordered" id="tabla-empresas" style='width: 100% !important;'>
		        <thead>
		           
		                <th>Id</th>
		                <th>empresa</th>
		                <th>encargado</th>
		                <th>telefono</th>
		                <th>email</th>
		                <th>ciudad</th>
		                <th>direccion</th>
		                <th>accion</th>
		         
		        </thead>
		    </table>
		 </div>   
	
</div>  


</section>

@section('scripts')



@parent

<script>
 function activar_tabla_empresas() {
    $('#tabla-empresas').DataTable({
        processing: true,
        serverSide: true,
        pageLength: 20,
        language: {
                 "url": '{!! asset('/plugins/datatables/latino.json') !!}'
                  } ,
        ajax: '{!! url('listado_empresas_data') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'nom_empresa', name: 'nom_empresa' },
            { data: 'encargado', name: 'encargado' },
            { data: 'telefono', name: 'telefono' },
            { data: 'email', name: 'email' },
            { data: 'ciudad', name: 'ciudad' },
            { data: 'direccion', name: 'direccion' },
            { data: null,  render: function ( data, type, row ) {
                return "<a href='{{ url('form_editar_contacto/') }}/"+ data.id +"' class='btn btn-xs btn-primary' >Editar</button>"  }  
            }
        ]
    });
}
activar_tabla_empresas();

</script>



@endsection


@endsection