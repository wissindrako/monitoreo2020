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
														Mesa de Votación {{$codigo_mesas_oep}} - Presidencial
													</h3>
                            <p>Por favor pulse sobre el partido del cual registrará los votos</p>
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
										@foreach ($partidos as $partido)
											<br>
											<form action="{{ url('form_votar_presidencial_partido') }}"  method="post">
												<input type="hidden" name="id_mesa" value="{{ $id_mesa }}">
												<input type="hidden" name="id_partido" value="{{ $partido->id_partido }}">
												{{-- <button type="submit" style="font-size: 16px; padding: 30px;width: 100%; background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#09de5a), color-stop(100%,#138541)); -webkit-box-shadow: inset 0px 0px 6px #fff; border-radius: 10px;"> --}}
												<button type="submit" class="box box-widget widget-user-2" style="background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#09de5a), color-stop(100%,#138541)); -webkit-box-shadow: inset 0px 0px 6px #fff; border-radius: 10px;">
														<div class="widget-user-header bg-white">
															<div class="widget-user-image">
																<img class="img-circle" src="{{ url($partido->logo) }}" style="width:65px;height:65px;" alt="User Avatar">
															</div>
															<!-- /.widget-user-image -->

													<?php $entro = 0?>
													@foreach ($votos_introducidos as $voto_introducido)
														@if($voto_introducido->id_partido == $partido->id_partido)
														<h3  style="font-size: 35px;" class="widget-user-username"><b>{{ $partido->sigla }}</b></h3>
														<h5 class=""><b>{{ $partido->nombre }}</b></h5>
														<h3 class="widget-user-desc">Votos: <b>{{ $voto_introducido->validos }}</b></h3>
														<?php $entro = 1?>
														@endif
													@endforeach
													@if($entro == 0)
														<h3  style="font-size: 35px;" class="widget-user-username"><b>{{ $partido->sigla }}</b></h3>
														<h5 class=""><b>{{ $partido->nombre }}</b></h5>
														<p style="width: 2rem; height: 2rem; border-radius: 50%; background: red;	justify-content: center; margin:0px auto;">
															<span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspSin&nbspRegistro</span>
														</p>
													@endif
												</div>
												</button>
											</form>
										@endforeach

										<br>
										<form action="{{ url('form_votar_presidencial_nyb') }}"  method="post">
											<input type="hidden" name="id_mesa" value="{{ $id_mesa }}">
											<input type="hidden" name="id_partido" value="{{ $partido->id_partido }}">
											<button type="submit" style="font-size: 16px; padding: 30px;width: 100%; background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#09de5a), color-stop(100%,#138541)); -webkit-box-shadow: inset 0px 0px 6px #fff; border-radius: 10px;">
												<span style="font-size: 25px;"> Nulos&nbspy&nbspBlancos </span><br>
												<?php $entro=0?>
												@foreach ($votos_introducidos_nyb as $voto_nyb)
													<?php $entro=1?>
													<p style="width: 2rem; height: 2rem; border-radius: 50%; background: green;	justify-content: center; margin:0px auto;">
														<span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspNulos:&nbsp{{ $voto_nyb->nulos }}</span>
														<span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspBlancos:&nbsp{{ $voto_nyb->blancos }}</span>
													</p>
												@endforeach
												@if($entro == 0)
													<p style="width: 2rem; height: 2rem; border-radius: 50%; background: red;	justify-content: center; margin:0px auto;">
														<span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspSin&nbspRegistro</span>
													</p>
												@endif
											</button>
										</form>

										<br>
										<form action="{{ url('form_votar_presidencial_subir_imagen') }}"  method="post">
											<input type="hidden" name="id_mesa" value="{{ $id_mesa }}">
											<button type="submit" style="font-size: 16px; padding: 20px;width: 100%; background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#09de5a), color-stop(100%,#138541)); -webkit-box-shadow: inset 0px 0px 6px #fff; border-radius: 10px;">
												<i class="fa fa-camera"></i> Subir Imagen
												@if($foto_presidenciales == "")
													<p style="width: 2rem; height: 2rem; border-radius: 50%; background: red;	justify-content: center; margin:0px auto;">
														<span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspSin&nbspImágen</span>
													</p>
												@else
													<p style="width: 2rem; height: 2rem; border-radius: 50%; background: green;	justify-content: center; margin:0px auto;">
														<span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspImágen&nbspSubida</span>
													</p>
												@endif
											</button>
										</form>

										<br>
										<form action="{{ url('form_votar_seleccionar_tipo') }}"  method="post">
											<input type="hidden" name="id_mesa" value="{{ $id_mesa }}">
											<button type="submit" style="font-size: 16px; padding: 10px;width: 100%; background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#09de5a), color-stop(100%,#138541)); -webkit-box-shadow: inset 0px 0px 6px #fff; border-radius: 10px;">
												<i class="fa fa-mail-reply-all"></i> Volver
											</button>
										</form>

										<br>
										<form action="{{ url('form_votar_seleccionar_mesa') }}"  method="get">
											<button type="submit" style="font-size: 16px; padding: 10px;width: 100%; background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#09de5a), color-stop(100%,#A3DD99)); -webkit-box-shadow: inset 0px 0px 6px #fff; border-radius: 10px;">
												<i class="fa fa-save"></i> Finalizar
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
