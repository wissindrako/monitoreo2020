@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')
<section  id="contenido_principal">

<div class="box box-primary">
		<div class="box-header">
				<h3 class="box-title">Listado de Personas</h3>
				<input type="hidden" id="rol_usuario" value="{{ $rol->slug }}">

			
		</div>
		<!-- /.box-header -->
		{{-- {{dd($personas)}} --}}
		<div class="box-body table-responsive no-padding">
		  <table id="tabla_personas" class="table table-hover table-striped table-bordered">
			<thead>
			
				<th>Nombre</th>
				<th>Paterno</th>
				<th>Materno</th>
				<th>Cedula</th>
				<th>Comp.</th>
				<th>Nacimiento</th>
				<th>Contacto</th>
				{{-- <th>Telefono - Celular</th>
				<th>Telefono Ref.</th> --}}
				<th>Dirección</th>
				<th>Compromiso</th>
				<th>Fecha de Registro</th>
				<th>Activo</th>
				<th>Circ.</th>
				<th>Distrito Municipal</th>
				<th>Distrito OEP</th>
				<th>Recinto</th>
				<th>Origen</th>
				<th>Sub Origen</th>
				<th>Rol</th>
				
				<th>Acción</th>
				
			</thead>
			{{-- <tbody> --}}
				Completo   
			{{-- <tr>
				<th>ID</th> --}}
				{{-- <th>Nombre Completo</th>
				<th>Cedula de Identidad</th>
				<th>Fecha nacimiento</th>
				<th>Telf. Cel.</th>
				<th>Telf. Ref.</th>
				<th>Dirección</th>
				<th>Compromiso</th>
				<th>Fecha de Registro</th>
				<th>Activo</th>
				<th>Recinto</th>
				<th>Origen</th>
				<th>Sub Origen</th>
				<th>Rol</th>
				<th colspan="2">Acción</th> --}}
			{{-- </tr> --}}
			{{-- // ->where('personal.idarea', $persona->idarea)
			// ->where('vacaciones.id_estado', '=' ,1) --}}

			{{-- @foreach ($personas as $p)
				<tr>
					<td>{{$p->id_persona}}</td>
					<td>{{$p->nombre.' '.$p->paterno.' '.$p->materno}}</td>
					<td>{{$p->cedula_identidad}} {{$p->complemento_cedula}} {{$p->expedido}}</td>
					<td>{{f_formato($p->fecha_nacimiento)}}</td>
					<td>{{$p->telefono_celular}}</td>
					<td>{{$p->telefono_referencia}}</td>
					<td>{{$p->direccion}}</td>
					<td>{{$p->grado_compromiso}}</td>
					<td>{{f_formato($p->fecha_registro)}}</td>
					<td>{{$p->activo}}</td>
					<td>{{$p->nombre_recinto}}</td>
					<td>{{$p->origen}}</td>
					<td>{{$p->sub_origen}}</td>
					<td>{{$p->nombre_rol}}</td>

					@if ($p->activo == 1)
					<td><button type="button" class="btn btn-success btn-xs" onclick="verinfo_persona({{ $p->id_persona }}, 1)" ><i class="fa fa-pencil-square-o"></i></button></td>
					<td><button type="button" class="btn btn-danger btn-xs" onclick="verinfo_persona({{ $p->id_persona }}, 2)" ><i class="fa fa-fw fa-user-times"></i></button></td>
					@else
					<td><button disabled type="button" class="btn btn-success btn-xs" ><i class="fa fa-pencil-square-o"></i></button></td>
					<td><button disabled type="button" class="btn btn-danger btn-xs"  ><i class="fa fa-fw fa-user-times"></i></button></td>
					@endif
				</tr>
			@endforeach --}}

			{{-- </tbody> --}}
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
            { data: 'contacto', name: 'contacto' },
            // { data: 'telefono_celular', name: 'telefono_celular' },
            // { data: 'telefono_referencia', name: 'telefono_referencia' },
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
            { data: 'description', name: 'description' },
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
		
		scrollY:"600px",
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
