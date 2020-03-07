@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')
<section  id="contenido_principal">

<div class="box box-primary">
		<div class="box-header">
				<h3 class="box-title">Listado de Responsables de Distrito</h3>	

		</div>
		<!-- /.box-header -->
		{{-- {{dd($personas)}} --}}
		<div class="box-body table-responsive no-padding">
		  <table id="tabla_recintos_mesas" class="table table-hover table-striped table-bordered">
			<thead>

				<th>Circ.</th>
				<th>Distrito</th>
				<th>Responsable</th>
				<th>Contacto</th>
				{{-- <th>Estado</th>
				<th></th> --}}

			</thead></table>

		</div>
		<!-- /.box-body -->
	  </div>

</section>
@endsection


@section('scripts')

@parent

<script>
function activar_tabla_recintos_mesas() {
    var t = $('#tabla_recintos_mesas').DataTable({

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
		// rowsGroup: [// Always the array (!) of the column-selectors in specified order to which rows groupping is applied
        //           // (column-selector could be any of specified in https://datatables.net/reference/type/column-selector)
        //           // 'first:name',
        //           0,
        //           1,
        //           2,
        //           3,
        //           4,
        //           5,
        //         ],
        language: {
                 "url": '{!! asset('/plugins/datatables/latino.json') !!}'
                  } ,
        ajax: '{!! url('buscar_distritos_responsables') !!}',
        columns: [
            { data: 'circunscripcion', name: 'circunscripcion' },
            { data: 'distrito', name: 'distrito' },
			{ data: 'nombre_completo', name: 'nombre_completo' },
			// { data: null,  render: function ( data, type, row ) {
			// 		if  ( row.mesa_activa === null || row.mesa_activa === 1) {
			// 			return row.nombre_completo
			// 		} else {
			// 			return ""
			// 		}
			// 	}
			// },
            { data: 'contacto', name: 'contacto' },
            // { data: 'mesa_activa', name: 'mesa_activa' },

            // { data: null,  render: function ( data, type, row ) {
			// 		if  ( row.mesa_activa === null || row.mesa_activa === 0) {
			// 			return "<i class='fa fa-circle-o text-red'></i><p class='text-red'>No Asignado</p>"
			// 		} else {
			// 			return "<i class='fa fa-circle-o text-green'></i><p class='text-green'>Asignado</p>"
			// 		}
			// 	}  
			// },
        ]
    });

}	
activar_tabla_recintos_mesas();


</script>



@endsection


