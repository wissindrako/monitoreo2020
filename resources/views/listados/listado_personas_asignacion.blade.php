@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')
<section  id="contenido_principal">

<div class="box box-primary">
		<div class="box-header">
				<h3 class="box-title">Listado de Personas - Asignacion</h3>	

		</div>
		<!-- /.box-header -->
		{{-- {{dd($personas)}} --}}
		<div class="box-body table-responsive no-padding">
		  <table id="tabla_personas_asigancion" class="table table-hover table-striped table-bordered">
			<thead>

				{{-- <th>ID</th> --}}
				<th>Nombre</th>
				<th>Paterno</th>
				<th>Materno</th>
				<th>Código</th>
				<th>Cedula</th>
				<th>Complemento</th>
				<th>Compromiso</th>
				<th>Fecha Nacimiento</th>
				<th>Fecha de Registro</th>
				<th>Persona Activo</th>
				<th>Usuario Activo</th>
				<th>Asignado</th>
				<th>Circ.</th>
				<th>Distrito</th>
				<th>Recinto</th>
				<th>Origen</th>
				<th>Sub Origen</th>
				<th>Rol</th>
				<th>Asignar</th>
			{{-- // ->where('personal.idarea', $persona->idarea)
			// ->where('vacaciones.id_estado', '=' ,1) --}}

			{{-- @foreach ($personas as $p)
				<tr>
					<td>{{$p->id_persona}}</td>
					<td>{{$p->nombre.' '.$p->paterno.' '.$p->materno}}</td>
					<td>{{$p->codigo_usuario}}</td>
					<td>{{$p->cedula_identidad}} {{$p->complemento_cedula}} {{$p->expedido}}</td>
					<td>{{$p->grado_compromiso}}</td>
					<td>{{f_formato($p->fecha_registro)}}</td>
					@if ($p->usuario_activo == '0' || $p->usuario_activo == 1)
						<td>{{$p->activo}}/{{$p->usuario_activo}}</td>
					@else
						<td>{{$p->activo}}/--</td>
					@endif
					<td>{{$p->nombre_recinto}}</td>
					<td>{{$p->origen}}</td>
					<td>{{$p->sub_origen}}</td>
					<td>{{$p->nombre_rol}}</td>
					
					@if (($p->activo == 1 && $p->asignado == 0) && ($p->usuario_activo != '0') )
					<td><button type="button" class="btn btn-success btn-xs" onclick="verinfo_usuario({{ $p->id_persona }}, 20)" ><i class="fa fa-arrow-right"></i></button>
					<button disabled type="button" class="btn btn-default btn-xs" ><i class="fa fa-rotate-left "></i></button></td>
					@else
					<td><button disabled type="button" class="btn btn-success btn-xs" ><i class="fa fa-arrow-right"></i></button>
						@if ($p->activo == 1 && $p->asignado == 1 && $p->usuario_activo != '0')
						<button type="button" class="btn btn-warning btn-xs" onclick="liberar_responsabilidad({{ $p->id_persona }})" ><i class="fa fa-rotate-left "></i></button></td>
						@else
						<button disabled type="button" class="btn btn-default btn-xs" ><i class="fa fa-rotate-left "></i></button></td>
						@endif
					@endif

				</tr>
			@endforeach --}}

			</thead></table>
			{{-- @if (count($personas) == 0)
			<div class="box box-primary col-xs-12">
				<div class='aprobado' style="margin-top:70px; text-align: center">
				<label style='color:#177F6B'>
					... Realizar nueva busqueda ...
				</label> 
				</div>
			</div> 
			@endif --}}
		</div>
		<!-- /.box-body -->
	  </div>

</section>
@endsection


@section('scripts')

@parent

<script>
function activar_tabla_personas_asignacion() {
    var t = $('#tabla_personas_asigancion').DataTable({

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
        ajax: '{!! url('buscar_persona_asignacion') !!}',
        columns: [
            { data: 'nombre', name: 'nombre' },
            { data: 'paterno', name: 'paterno' },
            { data: 'materno', name: 'materno' },
            { data: 'codigo_usuario', name: 'codigo_usuario' },
            { data: 'cedula_identidad', name: 'cedula_identidad' },
            { data: 'complemento_cedula', name: 'complemento_cedula' },
			{ data: 'grado_compromiso', name: 'grado_compromiso' },
            { data: 'fecha_nacimiento', name: 'fecha_nacimiento' },
            // { data: 'telefono_celular', name: 'telefono_celular' },
            // { data: 'telefono_referencia', name: 'telefono_referencia' },
            // { data: 'direccion', name: 'direccion' },
            
            { data: 'fecha_registro', name: 'fecha_registro' },
            { data: 'activo', name: 'activo' },
            { data: 'usuario_activo', name: 'usuario_activo' },
            { data: 'asignado', name: 'asignado' },
            { data: 'circunscripcion', name: 'circunscripcion' },
            { data: 'distrito', name: 'distrito' },
            { data: 'nombre_recinto', name: 'nombre_recinto' },
            { data: 'origen', name: 'origen' },
            { data: 'sub_origen', name: 'sub_origen' },
            { data: 'nombre_rol', name: 'nombre_rol' },
            { data: null,  render: function ( data, type, row ) {
				if ( row.activo === 1) {
						// return "<td><button type='button' class='btn btn-success btn-xs' onclick='verinfo_persona("+data.id_persona+","+1+")' ><i class='fa fa-pencil-square-o'></i></button></td><td><button type='button' class='btn btn-danger btn-xs' onclick='verinfo_persona("+data.id_persona+","+2+")' ><i class='fa fa-rotate-left'></i></button></td>"
						if  ( row.usuario_activo === null || row.usuario_activo === 1) {
								// return "<td><button type='button' class='btn btn-info btn-xs' onclick='verinfo_usuario("+data.id_persona+","+20+")' ><i class='fa fa-arrow-right'></i></button></td><td><button type='button' class='btn btn-danger btn-xs' onclick='liberar_responsabilidad("+data.id_persona+")' ><i class='fa fa-rotate-left'></i></button></td>"
							if  ( row.asignado === 0) {
								return "<td><button type='button' class='btn btn-success btn-xs' onclick='verinfo_usuario("+data.id_persona+","+20+")' ><i class='fa fa-arrow-right'></i></button></td><td><button disabled type='button' class='btn btn-warning btn-xs'><i class='fa fa-rotate-left'></i></button></td>"
							} else {
								return "<td><button disabled type='button' class='btn btn-success btn-xs'><i class='fa fa-arrow-right'></i></button></td><td><button type='button' class='btn btn-warning btn-xs' onclick='liberar_responsabilidad("+data.id_persona+")' ><i class='fa fa-rotate-left'></i></button></td>"
							}
						} else {
							return "<td><button disabled type='button' class='btn btn-success btn-xs'><i class='fa fa-arrow-right'></i></button></td><td><button disabled type='button' class='btn btn-warning btn-xs'><i class='fa fa-rotate-left '></i></button></td>"	
						}
					} else {
						return "<td><button disabled type='button' class='btn btn-success btn-xs'><i class='fa fa-arrow-right'></i></button></td><td><button disabled type='button' class='btn btn-warning btn-xs'><i class='fa fa-rotate-left '></i></button></td>"
					}
				}  
			},
        ]
    });

}	
activar_tabla_personas_asignacion();


</script>



@endsection


