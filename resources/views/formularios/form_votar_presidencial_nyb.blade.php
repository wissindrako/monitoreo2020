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
														Mesa de Votación {{$codigo_mesas_oep}} - Presidencial - Nulos y Blancos
													</h3>
                            <p>Por favor registre el número de votos</p>
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
										<br>
											<form action="{{ url('votar_presidencial_nyb') }}"  method="post">
												<input type="hidden" name="id_mesa" value="{{ $id_mesa }}">
												<label style="font-size: 26px">Votos blancos</label><br>
												<input type="number" name="blancos" min="0" max="{{ $numero_votantes }}" value="{{ $blancos }}" style="width:100%; height:40px; font-size:30px; text-align:center" required>
                                                <br>
                                                <label style="font-size: 26px">Votos nulos</label><br>
                                                <input type="number" name="nulos" min="0" max="{{ $numero_votantes }}" value="{{ $nulos }}" style="width:100%; height:40px; font-size:30px; text-align:center" required>
                                                <br><br><br>
												<button type="submit" style="font-size: 16px; padding: 10px;width: 100%; background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#A3DD99), color-stop(100%,#09de5a)); -webkit-box-shadow: inset 0px 0px 6px #fff; border-radius: 10px;">
													Guardar
												</button>
											</form>
										<br>
										<form>
											<button type="button" onClick="javascript:history.go(-1)" style="font-size: 16px; padding: 10px;width: 100%; background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#09de5a), color-stop(100%,#138541)); -webkit-box-shadow: inset 0px 0px 6px #fff; border-radius: 10px;">
												<i class="fa fa-mail-reply-all"></i> Volver
											</button>
										</form>
                  </div>
              </div>
            </div>

        </div>
      </div>

</section>

</section>
@endsection
