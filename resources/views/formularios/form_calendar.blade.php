@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection

@section('main-content')

<section  id="contenido_principal">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 

    <div class="box box-succes">
        <div class="box-body">
            <div class="col-md-3">
                <div class="box box-solid">
                    <div class="box-header with-border">
                    <h4 class="box-title">Elige los días de vacación</h4>
                    </div>
                    <div class="box-body">
                        <div id="calendar-events">
                            <div class="calendar-events m-b-20 external-event bg-aqua ui-draggable ui-draggable-handle" data-class="bg-aqua" style="position: relative;">1 Día</div>
                            <div class="calendar-events m-b-20 external-event bg-navy ui-draggable ui-draggable-handle" data-class="bg-navy" style="position: relative;">Medio Día</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                    <div id="calendar" class="col-centered">
		<!-- Modal -->
		<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                  <form class="form-horizontal" method="POST" action="agregar_fechas">
                  
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">Agregar día</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                          <label for="color" class="col-sm-2 control-label">Color</label>
                          <div class="col-sm-10">
                            <select name="color" class="form-control" id="color">
                                <option selected style="color:#0071c5;" value="1">Todo el día</option>
                                <option style="color:#40E0D0;" value="2">Mañana</option>
                                <option style="color:#008000;" value="3">Tarde</option>
                              </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="start" class="col-sm-2 control-label">Start date</label>
                          <div class="col-sm-10">
                            <input type="text" name="start" class="form-control" id="start" readonly>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="end" class="col-sm-2 control-label">End date</label>
                          <div class="col-sm-10">
                            <input type="text" name="end" class="form-control" id="end" readonly>
                          </div>
                        </div>
                      
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                  </form>
                  </div>
                </div>
              </div>
              
              <!-- Modal -->
              <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                  <form class="form-horizontal" method="POST" action="editEventTitle.php">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">Edit Event</h4>
                    </div>
                    <div class="modal-body">
                      
                        <div class="form-group">
                          <label for="title" class="col-sm-2 control-label">Title</label>
                          <div class="col-sm-10">
                            <input type="text" name="title" class="form-control" id="title" placeholder="Title">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="color" class="col-sm-2 control-label">Color</label>
                          <div class="col-sm-10">
                            <select name="color" class="form-control" id="color">
                                <option value="">Choose</option>
                                <option style="color:#0071c5;" value="#0071c5">&#9724; Dark blue</option>
                                <option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquoise</option>
                                <option style="color:#008000;" value="#008000">&#9724; Green</option>						  
                                <option style="color:#FFD700;" value="#FFD700">&#9724; Yellow</option>
                                <option style="color:#FF8C00;" value="#FF8C00">&#9724; Orange</option>
                                <option style="color:#FF0000;" value="#FF0000">&#9724; Red</option>
                                <option style="color:#000;" value="#000">&#9724; Black</option>
                                
                              </select>
                          </div>
                        </div>
                          <div class="form-group"> 
                              <div class="col-sm-offset-2 col-sm-10">
                                <div class="checkbox">
                                  <label class="text-danger"><input type="checkbox"  name="delete"> Delete event</label>
                                </div>
                              </div>
                          </div>
                        
                        <input type="hidden" name="id" class="form-control" id="id">
                      
                      
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                  </form>
                  </div>
                </div>
              </div>

            </div>
            <div class="col-md-3">
               <!-- BEGIN MODAL -->
               <div class="modal none-border" id="my-event">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"><strong>Quitar día</strong></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body"></div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cerrar</button>
                                {{-- <button type="button" class="btn btn-success save-event waves-effect waves-light">Create event</button> --}}
                                <button type="button" class="btn btn-danger delete-event waves-effect waves-light" data-dismiss="modal">Borrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection


        
        
        