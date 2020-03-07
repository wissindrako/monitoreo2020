@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')
<section  id="contenido_principal">

<div class="box box-primary">
		<div class="box-header">
				<h3 class="box-title">Listado General de Votacion</h3>	
		</div>
		<!-- /.box-header -->
		{{-- {{dd($personas)}} --}}
		<div class="box-body table-responsive no-padding">
		  <table id="tabla_votacion_general" class="table table-hover table-striped table-bordered">
			<thead>
				<th style="font-size: 20px; background-color:#3c8dbc; text-align:center; color: #fff;">Presidenciales</th>
				{{-- <th style="font-size: 14px;">Presidenciales</th> --}}
				<th style="font-size: 20px;background-color:#3c8dbc; text-align:center; color: #fff;">Uninominales</th>
				{{-- <th>Recinto</th> --}}
				{{-- <th>Mesa</th>
				<th>Presidenciales</th>
				<th>P - N/B</th> --}}
			</thead>
			{{-- {{dd($votos_presidenciales_r)}} --}}
		<tbody>
			<tr>
				{{-- Presidenciales --}}
				<td>
			@foreach ($partidos as $p)
				
				@foreach ($votos_presidenciales as $v_p)
					
					@if ($v_p->id_partido == $p->id_partido)
					<div class="col-md-6">
						<div class="box box-widget widget-user-2">
							<!-- Add the bg color to the header using any of the bg-* classes -->
							<div class="widget-user-header bg-white">
								<div class="widget-user-image">
									<img class="img-circle" src={{url($p->logo)}} style="width:65px;height:65px;" alt="User Avatar">
								</div>
								<!-- /.widget-user-image -->
								<h3 class="widget-user-username"><b>{{$p->sigla}}</b></h3>
								<h3 class="widget-user-desc">Votos: <b>{{$v_p->validos}}</b></h3>
							</div>
						</div>
					</div>

					@endif
					
				@endforeach
				
				{{-- <td>{{$votos_presidenciales_r->validos}}</td> --}}

			@endforeach
			<div class="col-md-3">
					<div class="box box-widget widget-user-2">
						<!-- Add the bg color to the header using any of the bg-* classes -->
						<div class="widget-user-header bg-navy">
							<div class="widget-user-image">
								<img class="img-circle" src={{url('/img/nulo.png')}} style="width:65px;height:65px;" alt="User Avatar">
							</div>
							<!-- /.widget-user-image -->
							<h2 class="widget-user-username"><b>Nulos</b></h2>
							<h3 class="widget-user-desc"><b>{{$votos_presidenciales_r->nulos}}</b></h3>
						</div>
					</div>
				</div>
				<div class="col-md-3">

					<div class="box box-widget widget-user-2">
						<!-- Add the bg color to the header using any of the bg-* classes -->
						<div class="widget-user-header bg-navy">
							<div class="widget-user-image">
								<img class="img-circle" src={{url('/img/blanco.png')}} style="width:65px;height:65px;" alt="User Avatar">
							</div>
							<!-- /.widget-user-image -->
							<h2 class="widget-user-username"><b>Blancos</b></h2>
							<h3 class="widget-user-desc"><b>{{$votos_presidenciales_r->blancos}}</b></h3>
						</div>
					</div>
				</div>

				</td>

				{{-- Uninominales --}}
				<td>
				@foreach ($partidos as $p)
					
					@foreach ($votos_uninominales as $v_p)
						
						@if ($v_p->id_partido == $p->id_partido)
						<div class="col-md-6">
							<div class="box box-widget widget-user-2">
								<!-- Add the bg color to the header using any of the bg-* classes -->
								<div class="widget-user-header bg-white">
									<div class="widget-user-image">
										<img class="img-circle" src={{url($p->logo)}} style="width:65px;height:65px;" alt="User Avatar">
									</div>
									<!-- /.widget-user-image -->
									<h3 class="widget-user-username"><b>{{$p->sigla}}</b></h3>
									<h3 class="widget-user-desc">Votos: <b>{{$v_p->validos}}</b></h3>
								</div>
							</div>
						</div>
						@endif
						
					@endforeach
					
					{{-- <td>{{$votos_presidenciales_r->validos}}</td> --}}
	
				@endforeach
					<div class="col-md-3">
						<div class="box box-widget widget-user-2">
							<!-- Add the bg color to the header using any of the bg-* classes -->
							<div class="widget-user-header bg-navy">
								<div class="widget-user-image">
									<img class="img-circle" src={{url('/img/nulo.png')}} style="width:55px;height:65px;" alt="User Avatar">
								</div>
								<!-- /.widget-user-image -->
								<h2 class="widget-user-username"><b>Nulos</b></h2>
								<h3 class="widget-user-desc"><b>{{$votos_uninominales_r->nulos}}</b></h3>
							</div>
						</div>
					</div>
					<div class="col-md-3">

						<div class="box box-widget widget-user-2">
							<!-- Add the bg color to the header using any of the bg-* classes -->
							<div class="widget-user-header bg-navy">
								<div class="widget-user-image">
									<img class="img-circle" src={{url('/img/blanco.png')}} style="width:55px;height:65px;" alt="User Avatar">
								</div>
								<!-- /.widget-user-image -->
								<h2 class="widget-user-username"><b>Blancos</b></h2>
								<h3 class="widget-user-desc"><b>{{$votos_uninominales_r->blancos}}</b></h3>
							</div>
						</div>
					</div>
	
					</td>
				</tr>
		</tbody>
		</table>
		</div>
		<!-- /.box-body -->
	  </div>

</section>
@endsection


@section('scripts')

@parent

<script>
function activar_tabla_votacion_general() {
    var t = $('#tabla_votacion_general').DataTable({

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
        ajax: '{!! url('buscar_votacion_general') !!}',
        columns: [
            { data: 'circunscripcion', name: 'circunscripcion' },
            { data: 'distrito', name: 'distrito' },
			{ data: 'nombre', name: 'nombre' },
			{ data: 'codigo_mesas_oep', name: 'codigo_mesas_oep' },
			{ data: 'presidenciales.0.partidos', name: 'presidenciales.0.partidos' },
			{ data: 'presidenciales.0.nulos_blancos', name: 'presidenciales.0.nulos_blancos' },
			// { data: 'presidenciales_r', name: 'presidenciales_r' },
            // {data: null,
            //     render: function(data, type, row, meta) {
            //         var additionalRemedies = '';
            //         //loop through all the row details to build output string
            //         for (var item in row.presidenciales) {
            //             var r = row.additionalRemedies[item];
            //             additionalRemedies = additionalRemedies +  r.presidenciales + '</br>';
			// 			console.log(additionalRemedies);
						
            //         }
            //         return additionalRemedies;
 
            //     }
            // },
            // { data: 'contacto', name: 'contacto' },
            // { data: 'mesa_activa', name: 'mesa_activa' },

            // { data: null,  render: function ( data, type, row ) {
			// 		if  ( row.mesa_activa === null || row.mesa_activa === 0) {
			// 			return "<i class='fa fa-circle-o text-red'></i><p class='text-red'>No Asignado</p>"
			// 		} else {
			// 			return "<i class='fa fa-circle-o text-green'></i><p class='text-green'>Asignado</p>"
			// 		}
			// 	}  
			// },
        ],
		"order": [[3, 'asc']]
    });

}	
// activar_tabla_votacion_general();


</script>



@endsection


