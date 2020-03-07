@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection

@section('main-content')


<section  id="contenido_principal">

{{--  --}}
<div class="box box-warning">
        <div class="box-header with-border">
          <h3 class="box-title">Area</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <form role="form">
            <!-- text input -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Ministerio</label>
                            <select class="form-control">
                                @foreach ($ministerios as $min)
                                    <option>{{$min->nombre}}</option>
                                @endforeach
                            </select>
                        <label>Dirección</label>
                        <select class="form-control">
                            @foreach ($direcciones as $dir)
                                <option>{{$dir->nombre}}</option>
                            @endforeach
                        </select>
                        <label>Unidad</label>
                        <select class="form-control">
                            @foreach ($unidades as $uni)
                                <option>{{$uni->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Text</label>
                        <input type="text" class="form-control" placeholder="Enter ...">
                        </div>
                        <!-- select -->
                        <div class="form-group">
                        <label>Select</label>
                        <select class="form-control">
                            @foreach ($ministerios as $min)
                                <option>{{$min->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

            </div>

          </form>
        </div>
        <!-- /.box-body -->
      </div>


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
	
			@foreach($direcciones as $dir)
				<tr role="row" class="odd">
					<td>{{ $dir->id }}</td>
                    <td>{{ $dir->nombre }}
                    @foreach ($dir->ministerios as $min)
                        - <small>{{$min->nombre}}</small>
                    @endforeach
                    </td>
				</tr>
			@endforeach
			</tbody>
			</table>
		</div>
	</div>

</div>


@endsection