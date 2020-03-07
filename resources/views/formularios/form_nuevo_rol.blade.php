@role('super_admin')
<section  >
<div class="col-md-12">

    <div class="box box-primary  box-gris">
 
            <div class="box-header with-border my-box-header">
                <h3 class="box-title"><strong>Nuevo Rol</strong></h3>
            </div><!-- /.box-header -->
               
            <hr style="border-color:white;" />

            <div id="div_notificacion_rol"></div>
 
            <div class="box-body">
              
            <form   action="{{ url('crear_rol') }}"  method="post" id="f_crear_rol" class="form_crear_rol"  >
				<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
                
                <div class="col-md-12">	  
	                
	                <div class="form-group" id="rol_nombre_group" >
							<label class="col-sm-2" for="rol_nombre"  >Nombre del Rol*</label>
	                    <div class="col-sm-10" >
	                         <span class="help-block"  id="rol_nombre_span" > </span>
							<input type="text" class="form-control" id="rol_nombre" name="rol_nombre" " required >
	                    </div>
					</div><!-- /.form-group -->

			    </div><!-- /.col -->

			      <div class="col-md-12">	  
	                
	                <div class="form-group" id="rol_slug_group" >
							<label class="col-sm-2" for="rol_slug"  >Slug*</label>
	                    <div class="col-sm-10" >
                            <span class="help-block" id="rol_slug_span" > </span>
							<input type="text" class="form-control" id="rol_slug" name="rol_slug" " required >
	                    </div>
					</div><!-- /.form-group -->

			    </div><!-- /.col -->

			      <div class="col-md-12">	  
	               
	                <div class="form-group" id="rol_descripcion_group">
							<label class="col-sm-2" for="rol_descripcion"  >Descripcion*</label>
	                    <div class="col-sm-10" >
	                         <span class="help-block" id="rol_descripcion_span" > </span>
							<input type="text" class="form-control" id="rol_descripcion" name="rol_descripcion" "  >
	                    </div>
					</div><!-- /.form-group -->

			    </div><!-- /.col -->


                <div class="box-footer col-xs-12 box-gris ">
                        <button type="submit" class="btn btn-primary">Crear Nuevo Rol</button>
                </div>
            </form>
                    
            </div>
                    
    </div>
                       
</div>


<div class="col-md-12">

    <div class="table-responsive" >

	    <table  class="table table-hover table-striped" cellspacing="0" width="100%">
				<thead>
						<tr>    <th>codigo</th>
								<th>nombre</th>
								<th>slug</th>
								<th>descripcion</th>
							    <th>Acción</th>
						</tr>
				</thead>
	    <tbody>

	    @foreach($roles as $rol)
		<tr role="row" class="odd" id="filaR_{{  $rol->id }}">
			<td>{{ $rol->id }}</td>
			<td><span class="label label-default">{{ $rol->name or "Ninguno" }}</span></td>
			<td class="mailbox-messages mailbox-name"><a href="javascript:void(0);" style="display:block"><i class="fa fa-user"></i>&nbsp;&nbsp;{{ $rol->slug  }}</a></td>
			<td>{{ $rol->description }}</td>
			<td>
			<button type="button"  class="btn  btn-danger btn-xs" onclick="borrar_rol({{ $rol->id }});"   ><i class="fa fa-fw fa-remove"></i></button>
			</td>
		</tr>
	    @endforeach



		</tbody>
		</table>

	</div>
</div>


</section>
@else
 <br/><div class='rechazado'><label style='color:#FA206A'>"no tiene permisos para esta seccion"</label>  </div> 

@endrole

