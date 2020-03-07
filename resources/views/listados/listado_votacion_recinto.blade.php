@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')
<section  id="contenido_principal">

<div class="box box-primary">
		<div class="box-header">
				<h3 class="box-title">Listado de Votacion por Recinto</h3>	
				{{-- <h4 class="text-black" >NOMBRE: <b>{{$persona->nombre}} {{$persona->paterno}} {{$persona->materno}}</b></h4 class="text-black" >
				<h4 class="text-black" >CEDULA: <b>{{$persona->cedula_identidad}} {{$persona->complemento_cedula}} {{$persona->expedido}}</b></h4 class="text-black" > --}}
				<h4 class="text-black" >CIRCUNSCRIPCION: <b>{{$recinto[0]->circunscripcion}}</b></h4 class="text-black" >
				<h4 class="text-black" >DISTRITO: <b>{{$recinto[0]->distrito}}</b></h4 class="text-black" >
				<h4 class="text-black" >RECINTO: <b>#{{$recinto[0]->id_recinto}} - {{$recinto[0]->nombre}}</b></h4 class="text-black" >
		</div>
		<!-- /.box-header -->
		{{-- {{dd($personas)}} --}}
		<div class="box-body table-responsive no-padding">
		  <table id="tabla_votacion_general" class="table table-hover table-striped table-bordered">
			<thead>
					<tr>
						<th style="background-color:#111111; text-align:center; color:white" colspan="1"></th>
						<th style="background-color:#111111; text-align:center; color:white" colspan="4">Votos Presidenciales</th>
						<th style="background-color:#111111; text-align:center; color:white" colspan="4">Votos Uninominales</th>
						<th style="background-color:#111111; text-align:center; color:white" colspan="2">Datos del Responsable de Mesa</th>
					</tr>
					<tr>				

						{{-- <th># Recinto</th> --}}
						<th style="background-color:#3c8dbc; text-align:center; color:white">Mesa</th>
						<th style="background-color:#3c8dbc; text-align:center; color:white">Registrados</th>
						<th style="background-color:#3c8dbc; text-align:center; color:white">Esperados</th>
						<th style="background-color:#3c8dbc; text-align:center; color:white">Total</th>
						<th style="background-color:#3c8dbc; text-align:center; color:white">Estado</th>
						<th style="background-color:#3c8dbc; text-align:center; color:white">Registrados</th>
						<th style="background-color:#3c8dbc; text-align:center; color:white">Esperados</th>
						<th style="background-color:#3c8dbc; text-align:center; color:white">Total</th>
						<th style="background-color:#3c8dbc; text-align:center; color:white">Estado</th>
						<th style="background-color:#3c8dbc; text-align:center; color:white">Nombre</th>
						<th style="background-color:#3c8dbc; text-align:center; color:white">Contacto</th>
					</tr>
				{{-- <th>Estado</th>
				<th></th> --}}
			</thead>
		<tbody>
			{{-- {{dd($mesas)}} --}}
			@foreach ($mesas as $mesa)
				<tr>

				{{-- <td>{{$mesa->id_recinto}}</td> --}}
				<td style="text-align:center;">{{$mesa->codigo_mesas_oep}}</td>
				{{-- {{dd($votos_presidenciales)}} --}}
				@php
					$votos_pre = 0;
					$b_n = 0;
					$votos_uni = 0;
					$uni_b_n = 0;
				@endphp
				@foreach ($votos_presidenciales as $vp)

					@if ($mesa->id_mesa == $vp->id_mesa)
					@php
						$votos_pre = $vp->votos_presidenciales;
					@endphp
					@endif
				@endforeach
				@foreach ($votos_presidenciales_r as $vp)

					@if ($mesa->id_mesa == $vp->id_mesa)
					@php
						$b_n = $vp->votos_presidenciales_r;
					@endphp
					@endif
				@endforeach
				<td style="text-align:right;">{{$votos_pre + $b_n}}</td> {{-- Registrados --}}
				<td style="text-align:right;">{{($cantidad_partidos+1) - ($votos_pre + $b_n)}}</td> {{-- Esperados --}}
				<td style="text-align:right;">{{($cantidad_partidos+1)}}</td> {{-- Total --}}
				@if ($votos_pre + $b_n < $cantidad_partidos+1)
				<td style="text-align:center;"><a href="javascript:void(0);" onclick="verinfo_mesas({{ $mesa->id_mesa }}, 1)">
					<span class="badge bg-red">Incompleto</span></a>
				</td>	
				@else
				<td style="text-align:center;"><a href="javascript:void(0);" onclick="verinfo_mesas({{ $mesa->id_mesa }}, 1)">
					<span class="badge bg-green">&nbsp;Completo&nbsp;&nbsp;</span>
				</td>	
				@endif
				@foreach ($votos_uninominales as $v_uni)

					@if ($mesa->id_mesa == $v_uni->id_mesa)
					@php
						$votos_uni = $v_uni->votos_uninominales;
					@endphp
					@endif
				@endforeach
				@foreach ($votos_uni_r as $v_uni_r)

					@if ($mesa->id_mesa == $v_uni_r->id_mesa)
					@php
						$uni_b_n = $v_uni_r->votos_uninominales_r;
					@endphp
					@endif
				@endforeach
				{{-- {{$cantidad_partidos}} --}}
				<td style="text-align:right;">{{$votos_uni + $uni_b_n}}</td> {{-- Registrados --}}
				<td style="text-align:right;">{{($cantidad_partidos+1) - ($votos_uni + $uni_b_n)}}</td> {{-- Esperados --}}
				<td style="text-align:right;">{{($cantidad_partidos+1)}}</td> {{-- Total --}}

				@if ($votos_uni + $uni_b_n < $cantidad_partidos+1)
				<td style="text-align:center;"><a href="javascript:void(0);" onclick="verinfo_mesas({{ $mesa->id_mesa }}, 2)">
					<span class="badge bg-red">Incompleto</span></a>
				</td>
				@else
				<td style="text-align:center;"><a href="javascript:void(0);" onclick="verinfo_mesas({{ $mesa->id_mesa }}, 2)">
					<span class="badge bg-green">&nbsp;Completo&nbsp;&nbsp;</span>
				</td>
				@endif
				<td>{{$mesa->nombre_completo}}</td>
				<td>{{$mesa->contacto}}</td>

				</tr>
			@endforeach
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
        ajax: '{!! url('buscar_votacion_recinto') !!}',
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


