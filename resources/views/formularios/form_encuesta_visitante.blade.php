@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection

@section('main-content')
<section  id="contenido_principal">
<section  id="content" >

    <div class="" >
        <div class="container"> 
            <div class="row">
              <div class="col-sm-6 col-sm-offset-3 myform-cont" >
                
                     <div class="myform-top">
                        <div class="myform-top-left">
                           {{-- <img  src="" class="img-responsive logo" /> --}}
                          <h3>Visitante</h3>
                            <p>Por favor responda las siguientes preguntas</p>
                        </div>
                        <div class="myform-top-right">
                          <i class="fa fa-user"></i>
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
                      
                            <form   action="{{ url('enviar_visitante') }}"  method="post" id="f_enviar_visitante" class="formentrada" >
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      
                        {{-- <div class="col-md-12"> --}}
                            {{-- <div class="form-group">
                                <label >Nombre</label>
                                <input type="text" name="nombre" placeholder="Nombre Completo" class="form-control" value="" >
                            </div> --}}
                        {{-- </div> --}}
                        <div class="col-md-12">
                            <div class="form-group">
                                    <label >Sexo</label>
                                <div class="radio">
                                    <label>
                                    <input type="radio" name="sexo" id="sexo1" value="M" checked="">
                                    Varón                                            
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                    <input type="radio" name="sexo" id="sexo2" value="F">
                                    Mujer
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label >A través de que medio se enteró de este evento?</label>
                                <div class="radio">
                                    <label>
                                    <input type="radio" name="medio_comunicacion" id="medio_comunicacion1" value="TV" checked="">
                                        TV                                            
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                        <input type="radio" name="medio_comunicacion" id="medio_comunicacion2" value="RADIO">
                                        Radio
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                        <input type="radio" name="medio_comunicacion" id="medio_comunicacion3" value="INTERNET">
                                        Internet
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                        <input type="radio" name="medio_comunicacion" id="medio_comunicacion4" value="RECOMENDACION">
                                        Recomendación
                                        </label>
                                    </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label >Cuál es el medio de transporte en el que vino?</label>
                                <div class="radio">
                                    <label>
                                    <input type="radio" name="medio_transporte" id="medio_transporte1" value="PUBLICO" checked="">
                                        Público                                           
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                        <input type="radio" name="medio_transporte" id="medio_transporte2" value="PRIVADO">
                                        Privado
                                        </label>
                                    </div>
                                    {{-- <div class="radio">
                                        <label>
                                        <input type="radio" name="medio_transporte" id="medio_transporte3" value="TELEFERICO">
                                        Teleférico
                                        </label>
                                    </div> --}}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label >Cual es su grado de satisfacción del evento?</label>
                                <div class="radio">
                                    <label>
                                    <input type="radio" name="grado_satisfaccion" id="medio_transporte1" value="MALO" checked="">
                                        Malo                                           
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                        <input type="radio" name="grado_satisfaccion" id="medio_transporte2" value="REGULAR">
                                        Regular
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                        <input type="radio" name="grado_satisfaccion" id="medio_transporte3" value="BUENO">
                                        Bueno
                                        </label>
                                    </div>
                            </div>
                            </div>
                        {{-- <div class="col-md-6">
                            <div class="form-group">
                                <label >Cual es su plato preferido?</label>
                                <div class="form-group">
                                  <select class="form-control" name="plato_preferido" id="">
                                    <option>Wallake</option>
                                    <option>Pesq'e</option>
                                    <option>Ispi</option>
                                    <option>Aj de papa con Ispi</option>
                                    <option>Caldo de Cardán</option>
                                    <option>Fiambre</option>
                                    <option>Sopa de Fideo</option>
                                    <option>Aji de pata</option>
                                  </select>
                                </div>
                            </div>
                        </div> --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label >Cuál es su plato preferido?</label>
                                <div class="form-group">
                                    <select class="form-control" name="plato_preferido" id="">
                                    @foreach ($platos_tarija as $platos)
                                        <option value="{{$platos->plato}}">{{$platos->id}} - {{$platos->plato}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <br><br>
                        <button type="submit" class="mybtn">Registrar</button>
                      </form>
                    
                    </div>
              </div>
            </div>

        </div>
      </div>
 
</section>

</section>
@endsection