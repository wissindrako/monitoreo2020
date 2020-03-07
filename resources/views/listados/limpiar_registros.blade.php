@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')


<section  id="contenido_principal">

@include('menu.menu_vaciar')



{{-- <div class="box box-primary">
		<div id='table_responsive' style='padding: 10 10 10 10; min-height: 700px;' >

      

		</div>   
	
</div>   --}}


</section>

@section('scripts')
@parent


@endsection


@endsection