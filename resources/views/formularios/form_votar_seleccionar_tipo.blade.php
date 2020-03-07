@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')
<section  id="contenido_principal">
<section  id="content">

    <div class="" >
        <div class="container">
            <div class="row">
              <div class="col-sm-6 col-sm-offset-3 myform-cont" >

                     <div class="myform-top">
                        <div class="myform-top-left">
                           {{-- <img  src="" class="img-responsive logo" /> --}}
                          <h3>
														Mesa de Votación
															@foreach ($mesas as $mesa)
																{{$mesa->codigo_mesas_oep}}
															@endforeach
													</h3>
                            <p>Por favor pulse sobre el tipo de votación a registrar</p>
                        </div>
                        <div class="myform-top-right">
                          <i class="fa fa-edit"></i>
                        </div>
                      </div>

                  <div class="col-md-12" >
                    @if (count($errors) > 0)

                        <div class="alert alert-danger">
                            <strong>UPPS!</strong> Error al Registrar<br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>

                    @endif
                   </div  >

	                  <div id="div_notificacion_sol" class="myform-bottom">
											@foreach ($mesas as $mesa)
												<br>
												<form action="{{ url('form_votar_presidencial') }}"  method="post">
													<input type="hidden" name="id_mesa" value="{{ $mesa->id_mesa }}">
													<button type="submit" style="font-size: 18px; padding: 30px;width: 100%; background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#09de5a), color-stop(100%,#138541)); -webkit-box-shadow: inset 0px 0px 6px #fff; border-radius: 10px;">
														PRESIDENCIAL
													</button>
												</form>

												<br>
												<form action="{{ url('form_votar_uninominal') }}"  method="post">
													<input type="hidden" name="id_mesa" value="{{ $mesa->id_mesa }}">
													<button type="submit" style="font-size: 18px; padding: 30px;width: 100%; background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#09de5a), color-stop(100%,#138541)); -webkit-box-shadow: inset 0px 0px 6px #fff; border-radius: 10px;">
														UNINOMINAL
													</button>
												</form>

												<br>
												<form action="{{ url('form_votar_seleccionar_mesa') }}"  method="get">
													<button type="submit" style="font-size: 18px; padding: 10px;width: 100%; background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#09de5a), color-stop(100%,#138541)); -webkit-box-shadow: inset 0px 0px 6px #fff; border-radius: 10px;">
														<i class="fa fa-mail-reply-all"></i> Volver
													</button>
												</form>
											@endforeach
	                  </div>
              </div>
            </div>

        </div>
      </div>

</section>

</section>
@endsection
