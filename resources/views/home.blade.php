@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')
	<div class="container spark-screen">
		<div class="row">
			{{-- <div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading">Bienvenid@</div>

					<div class="panel-body">
						{{ trans('adminlte_lang::message.logged') }}
						{{$personas}}
					</div>
				</div>
			</div> --}}

			<div style="text-align:center">

				<h2><b>Elecciones 2020</b></h2>
				<br>
				{{-- <h3><b>Administración </b></h3> --}}
				<img src="{{asset('img/partidos.png')}}" style="width:100%;height:350px;" class="resonsive"/>
			</div>
		</div>
	</div>
@endsection
