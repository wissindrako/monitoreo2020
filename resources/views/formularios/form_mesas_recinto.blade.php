
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
                          <h3>Mesas Recinto</h3>
                            <p>Agregando Mesas a todos los recintos</p>
                        </div>
                        <div class="myform-top-right">
                          <i class="fa fa-random"></i>
                        </div>
                      </div>


                    <div id="div_notificacion_sol" class="myform-bottom">
                      
                    <form action="{{ url('asignar_mesas_recinto') }}"  method="post" id="f_asignar_mesas_recinto" class="formentrada" >
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      
                        <div class="col-md-12">
                            <br>
                        </div>
                        <button type="submit" class="mybtn">Asignar</button>
                      </form>
                    
                    </div>
              </div>
            </div>

        </div>
      </div>
 
</section>

</section>
@endsection

