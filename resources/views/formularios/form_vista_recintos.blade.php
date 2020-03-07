@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection

@section('main-content')


<section class="contenido_principal">

    <!-- ./row -->
    <div class="row">
      <div class="col-md-4">
        <!-- Block buttons -->
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Circunscripciones</h3>
          </div>
          <td>
            
          </td>
          <div class="box-body">
            {{--  @foreach ($circunscripciones as $circ)
            <button type="button" class="btn btn-block btn-primary btn-lg">Circunscripcion {{ $circ->circunscripcion }}</button>
            <br>
            @endforeach  --}}
            <button type="button" id="c_10" class="btn btn-block btn-primary btn-lg">Circunscripcion 10</button>
            <br>
            <button type="button" id="c_11" class="btn btn-block btn-primary btn-lg">Circunscripcion 11</button>
            <br>
            <button type="button" id="c_12" class="btn btn-block btn-primary btn-lg">Circunscripcion 12</button>
            <br>
            <button type="button" id="c_13" class="btn btn-block btn-primary btn-lg">Circunscripcion 13</button>
            <br>

          </div>
        </div>
        <!-- /.box -->


      </div>
      <!-- /.col -->
      <div class="col-md-8">

        <!-- Vertical grouping -->
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Recintos</h3>
          </div>
          <div class="box-body table-responsive pad">
                <div id='table_responsive' style='min-height: 700px;' >

                        <table class="table table-bordered" id="tabla_recintos" style='width: 100% !important;'>
                             <thead>
                                
                                     <th>#</th>
                                     <th>Recinto</th>
                                     {{--  <th>encargado</th>
                                     <th>telefono</th>
                                     <th>email</th>
                                     <th>ciudad</th>
                                     <th>direccion</th>  --}}
                                     <th>Accion</th>
                              
                             </thead>
                            </table>

                </div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /. row -->
  </section>


  @section('scripts')



  @parent
  
  <script>

document.getElementById("c_10").onclick = function() {activar_tabla_recintos(10);};
document.getElementById("c_11").onclick = function() {activar_tabla_recintos(11);};
document.getElementById("c_12").onclick = function() {activar_tabla_recintos(12);};
document.getElementById("c_13").onclick = function() {activar_tabla_recintos(13);};

   function activar_tabla_recintos(c) {
      table = $('#tabla_recintos').DataTable({
          destroy: true,
          searching: false,       
          processing: true,
          serverSide: true,
          pageLength: 7,
          language: {
                   "url": '{!! asset('/plugins/datatables/latino.json') !!}'
                    } ,
        //   ajax: '{!! url('listado_recintos_data') !!}',
          ajax: "{!! url('listado_recintos_data/"+c+"') !!}",

          columns: [
              { data: 'id_recinto', name: 'id_recinto' },
              { data: 'nombre', name: 'nombre' },
            //   { data: 'encargado', name: 'encargado' },
            //   { data: 'telefono', name: 'telefono' },
            //   { data: 'email', name: 'email' },
            //   { data: 'ciudad', name: 'ciudad' },
            //   { data: 'direccion', name: 'direccion' },
              { data: null,  render: function ( data, type, row ) {
                  return "<a href='{{ url('consultaRecintosPorRecinto/') }}/"+ data.recinto +"' class='btn btn-xs btn-primary' >Editar</button>"  }  
              }
          ]
      });
  }
  
  </script>
  
  @endsection


@endsection