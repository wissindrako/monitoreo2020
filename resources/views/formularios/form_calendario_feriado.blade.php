@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')
<section  id="contenido_principal">

    @can('crear_solicitud')
    <section class="content" id="contenido_principal">
    {{-- {{dd($personal)}} --}}
    {{-- {{dd($gestiones)}} --}}
        <div class="box box-success">
          <div class="box-header">
            <h3 class="box-title"><b>Feriados</b></h3><br>
          </div>
        <div id="div_calendario_feriados" class="box box-body">
            
        
            <!-- /.box-header -->
              {{-- <section  id="contenido_principal"> --}}
                <div id="div_notificacion_sol"></div>
                  <div class="row">
                      
                      <div class="col-md-12">
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-5">
                          <div id="calendario_feriados" class="col-centered"></div>
                            <div id="ohsnap"></div>
                            <!-- Modal -->
                            <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <form method="POST" action="agregar_feriado" id="f_agregar_feriado" class="formentrada">
                                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Agregar Nuevo Feriado</h4>
                                  </div>
                                  <div class="modal-body">
                                      <div id="div_notificacion_modal"></div>
                                      <div class="form-group">
                                          <input hidden type="text" name="id_solicitud" id="id_solicitud" class="form-group">
                                        <label for="start" class="col-sm-2 control-label">Fecha</label>
                                        <div class="col-sm-10">
                                          <input type="text" name="start" class="form-control" id="start" readonly>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label for="tiempo" class="col-sm-2 control-label">Descripción</label>
                                        <div class="col-sm-10">
                                          <input type="text" class="form-control" name="desc_feriado" id="" placeholder="">
                                        </div>
                                      </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary" id="">Guardar</button>
                                  </div>
                                </form>
                                </div>
                              </div>
                            </div>
                          
                            <!-- Modal -->
                            <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <form method="POST" action="editar_feriado" id="f_editar_feriado" class="formentrada">
                                <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Editar Feriado</h4>
                                </div>
                                <div class="modal-body">
                                  <div class="form-group">
                                    <label for="tiempo" class="col-sm-2 control-label">Descripción</label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" name="desc_feriado" id="desc_feriado" placeholder="">
                                    </div>
                                  </div>
                                    <div class="form-group"> 
                                    <div class="col-sm-offset-2 col-sm-10">
                                      <div class="checkbox">
                                      <label class="text-red"><input type="checkbox"  name="delete"><b><i class="icon fa fa-warning"></i> Borrar día</b></label>
                                      </div>
                                    </div>
                                  </div>

                                  <input type="hidden" name="id" class="form-control" id="id">

                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary" id="">Aceptar</button>
                                </div>
                              </form>
                              </div>
                              </div>
                            </div>
                      </div>
                      <div class="col-md-4">

                      </div>
    
                    </div>
                  </div>
    
              {{-- </section> --}}
            

    
        </div>     
                <!-- /.box-body -->
        {{-- {{dd($derecho)}} --}}
    
        <!-- /.box-footer-->
        </div>
    
    </section>
    @else
    <br/><div class='rechazado'><label style='color:#FA206A'>"no tiene permisos para esta seccion"</label>  </div> 
    @endcan

</section>
@endsection