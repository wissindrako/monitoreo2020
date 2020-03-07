 @extends('layouts.auth')
  
@section('content')

  <body class="mybody">      
    <div class="mytop-content" >
        <div class="container" > 
          
                <div class="col-sm-12 " style="background-color:rgba(0, 0, 0, 0.35); height: 60px; " >
                   {{-- <a class="mybtn-social pull-right" href="{{ url('/register') }}">
                       Register
                  </a> --}}

                  <a class="mybtn-social pull-right" href="{{ url('/login') }}">
                       Login
                  </a>
               
                </div>
            
            <div class="row">
              <div class="col-sm-6 col-sm-offset-3 myform-cont" >
                

                     <div class="myform-top">
                        <div class="myform-top-left">
                           <img  src="{{ url('img/minculturas_logo.png') }}" class="img-responsive logo" />
                          <h3>Regístrate en nuestro sitio.</h3>
                            <p>Por favor ingresa tus datos personales:</p>
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

                    <div class="myform-bottom">
                      
                      <form role="form" action="{{ url('/register') }}" method="post" class="">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <input type="text" name="nombre" placeholder="Nombre Completo" class="form-control" value="{{ old('name') }}" >
                        </div>

                        <div class="form-group">
                            <input type="text" name="paterno" placeholder="Apellido Paterno" class="form-control" value="{{ old('name') }}" >
                        </div>
                    
                        <div class="form-group">
                            <input type="text" name="materno" placeholder="Apellido Materno" class="form-control" value="{{ old('name') }}" >
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" id="ci" name="ci" placeholder="No. Carnet"  value="{{ old('telefono') }}" >
                        </div>
                     
                        <div class="form-group">
                            <input type="text" name="email" placeholder="Correo Electronico" class="form-control"  
                            value="{{ old('email') }}" />
                        </div>
                        
                        <div class="form-group">
                        <input type="password" name="password" placeholder="Password" class="form-control" >
                        </div>

                         <div class="form-group">
                        <input type="password" name="password_confirmation" placeholder="Repite Password" class="form-control" >
                        </div>
{{-- 
                        <div class="form-group">
                         {!! Recaptcha::render() !!}
                        </div> --}}

                        <button type="submit" class="mybtn">Registrarme</button>
                      </form>
                    
                    </div>
              </div>
            </div>
            {{-- <div class="row">
                <div class="col-sm-12 mysocial-login">
                    <h3>...Visitanos en nuestra Pagina</h3>
                    <h1><strong>minculturas.gob.bo</strong>.net</h1>
                </div>
            </div> --}}
        </div>
      </div>
 
 </body>
@endsection


