@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')
<section  id="contenido_principal">

<div class="box box-success">
		<div class="box-header">
				<h3 class="box-title">Listado de Personas</h3>
				<input type="hidden" id="rol_usuario" value="{{ $rol->slug }}">

			
		</div>
		<!-- /.box-header -->
		
		<div class="box-body table-responsive">
		  <table id="tabla_personas" class="table table-hover table-striped table-bordered">
			<thead>
				<th>Circ.</th>	
				<th>Distrito</th>
				<th>Recinto</th>
				<th>Nombre</th>

				<th>Cedula</th>
				<th>Nacimiento</th>
				<th>Contacto</th>

				<th>Origen</th>
				<th>Sub Origen</th>
				<th>Designacion</th>
				<th>Titularidad</th>
				<th>Evidencia</th>
				
				<th>Acción</th>
				
			</thead>
				Completo   

		</table>
			@if (count($personas) == 0)
			<div class="box box-primary col-xs-12">
				<div class='aprobado' style="margin-top:70px; text-align: center">
				<label style='color:#177F6B'>
					... no se encontraron resultados para su busqueda...
				</label>
				</div>
			</div>
			@endif
		</div>
		<!-- /.box-body -->
	  </div>

</section>
@endsection

@section('scripts')

@parent

<script>
 function activar_tabla_personas() {
    var t = $('#tabla_personas').DataTable({
		
		scrollY:"600px",
		scrollX: true,
		dom: 'Bfrtip',
        processing: true,
        serverSide: true,
		// pageLength: 100,
		pageLength: 100,
		buttons: [
			'excel', 'pdf', 'print'
		],
		// buttons: [
        //           {
        //               extend: 'pdfHtml5',
        //               orientation: 'landscape',
        //               pageSize: 'LEGAL'
        //           }
        //         ],
        language: {
                 "url": '{!! asset('/plugins/datatables/latino.json') !!}'
                  } ,
        ajax: '{!! url('buscar_persona') !!}',
        columns: [
			{ data: 'circunscripcion', name: 'circunscripcion' },
            { data: 'distrito', name: 'distrito' },
            // { data: 'distrito_referencial', name: 'distrito_referencial' },
            { data: 'nombre_recinto', name: 'nombre_recinto' },
            // { data: 'nombre', name: 'nombre' },
            // { data: 'paterno', name: 'paterno' },
            // { data: 'materno', name: 'materno' },
            { data: 'nombre_completo', name: 'nombre_completo' },
            { data: 'cedula_identidad', name: 'cedula_identidad' },
            // { data: 'complemento_cedula', name: 'complemento_cedula' },
            { data: 'fecha_nacimiento', name: 'fecha_nacimiento' },
            { data: 'telefono_celular', name: 'telefono_celular' },
            // { data: 'telefono_celular', name: 'telefono_celular' },
            // { data: 'telefono_referencia', name: 'telefono_referencia' },
            // { data: 'direccion', name: 'direccion' },
            // { data: 'grado_compromiso', name: 'grado_compromiso' },
            // { data: 'fecha_registro', name: 'fecha_registro' },
            // { data: 'activo', name: 'activo' },

            { data: 'origen', name: 'origen' },
            { data: 'sub_origen', name: 'sub_origen' },
            { data: 'description', name: 'description' },
            { data: 'titularidad', name: 'titularidad' },
            { data: 'nombre_evidencia', name: 'nombre_evidencia' },
			
			{ data: null,  render: function ( data, type, row ) {
					if ($("#rol_usuario").val() === 'admin' || $("#rol_usuario").val() === 'super_admin') {
						if ( row.activo === 1) {
						// return "<a href='{{ url('form_editar_contacto/') }}/"+ data.id +"' class='btn btn-xs btn-primary' >Editar</button>"
							return "<td><button type='button' class='btn btn-success btn-xs' onclick='verinfo_persona("+data.id_persona+","+1+")' ><i class='fa fa-pencil-square-o'></i></button></td><td><button type='button' class='btn btn-danger btn-xs' onclick='verinfo_persona("+data.id_persona+","+2+")' ><i class='fa fa-fw fa-user-times'></i></button></td>"
						} else {
							return "<td><button disabled type='button' class='btn btn-success btn-xs'><i class='fa fa-pencil-square-o'></i></button></td><td><button disabled type='button' class='btn btn-danger btn-xs'><i class='fa fa-fw fa-user-times'></i></button></td>"
						}
					} else {
						if ($("#rol_usuario").val() === 'registrador' || $("#rol_usuario").val() === 'responsable_circunscripcion') {
							if ( row.activo === 1) {
							// return "<a href='{{ url('form_editar_contacto/') }}/"+ data.id +"' class='btn btn-xs btn-primary' >Editar</button>"
								return "<td><button type='button' class='btn btn-success btn-xs' onclick='verinfo_persona("+data.id_persona+","+1+")' ><i class='fa fa-pencil-square-o'></i></button></td>"
							} else {
								return "<td><button disabled type='button' class='btn btn-success btn-xs'><i class='fa fa-pencil-square-o'></i></button></td>"
							}
						}
					}
				}
			},
        ]
    });

}	
activar_tabla_personas();
function activar_tabla_prueba() {
    // Setup - add a text input to each footer cell
    $('#tabla_personas tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    });
 
    // DataTable
	var table = $('#tabla_personas').DataTable({
		
		scrollY:"50px",
		scrollX: true,
		dom: 'Bfrtip',
        processing: true,
        serverSide: true,
		pageLength: 100,
		buttons: [
			'excel', 'pdf', 'print'
		],
		// buttons: [
        //           {
        //               extend: 'pdfHtml5',
        //               orientation: 'landscape',
        //               pageSize: 'LEGAL'
        //           }
        //         ],
        language: {
                 "url": '{!! asset('/plugins/datatables/latino.json') !!}'
                  } ,
        ajax: '{!! url('buscar_persona') !!}',
        columns: [
            { data: 'nombre', name: 'nombre' },
            { data: 'paterno', name: 'paterno' },
            { data: 'materno', name: 'materno' },
            { data: 'cedula_identidad', name: 'cedula_identidad' },
            { data: 'complemento_cedula', name: 'complemento_cedula' },
            { data: 'fecha_nacimiento', name: 'fecha_nacimiento' },
            { data: 'telefono_celular', name: 'telefono_celular' },
            { data: 'telefono_referencia', name: 'telefono_referencia' },
            { data: 'direccion', name: 'direccion' },
            { data: 'grado_compromiso', name: 'grado_compromiso' },
            { data: 'fecha_registro', name: 'fecha_registro' },
            { data: 'activo', name: 'activo' },
            { data: 'circunscripcion', name: 'circunscripcion' },
            { data: 'distrito', name: 'distrito' },
            { data: 'distrito_referencial', name: 'distrito_referencial' },
            { data: 'nombre_recinto', name: 'nombre_recinto' },
            { data: 'origen', name: 'origen' },
            { data: 'sub_origen', name: 'sub_origen' },
            { data: 'nombre_rol', name: 'nombre_rol' },
            { data: null,  render: function ( data, type, row ) {
				if ( row.activo === 1) {
						// return "<a href='{{ url('form_editar_contacto/') }}/"+ data.id +"' class='btn btn-xs btn-primary' >Editar</button>"
						return "<td><button type='button' class='btn btn-success btn-xs' onclick='verinfo_persona("+data.id_persona+","+1+")' ><i class='fa fa-pencil-square-o'></i></button></td><td><button type='button' class='btn btn-danger btn-xs' onclick='verinfo_persona("+data.id_persona+","+2+")' ><i class='fa fa-fw fa-user-times'></i></button></td>"
					} else {
						return "<td><button disabled type='button' class='btn btn-success btn-xs'><i class='fa fa-pencil-square-o'></i></button></td><td><button disabled type='button' class='btn btn-danger btn-xs'><i class='fa fa-fw fa-user-times'></i></button></td>"
					}
				}  
			},
        ]
    });
 
    // Apply the search
    table.columns().every( function(){
        var that = this;
 
        $('input', this.footer()).on( 'keyup change clear', function(){
            if ( that.search() !== this.value ) {
                that
                    .search(this.value)
                    .draw();
            }
        } );
    });
}	
// activar_tabla_prueba();


</script>



@endsection
