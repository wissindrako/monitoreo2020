@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection

@section('main-content')


<section  id="contenido_principal">

<div class="wrap-content">
	<div class="box-body box-white">

		<div class="table-responsive" >
	
			<table  class="table table-hover table-striped" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Id</th>
						<th>Dirección</th>
					</tr>
				</thead>
			<tbody>
	
			@foreach($areas as $area)
				<tr role="row" class="odd">
					<td>{{ $area->id }}
						@foreach ($area->unidades as $unidad)
							- <small>{{$unidad->nombreunidad}}</small>
						@endforeach
					</td>
                    <td>{{ $area->sigla }}</td>
				</tr>
			@endforeach
	
			</tbody>
			</table>
	
		</div>
	</div>

</div>


@endsection