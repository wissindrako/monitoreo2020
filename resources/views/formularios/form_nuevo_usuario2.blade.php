<section class="content" >

 <div class="col-md-12">

	<div class="box box-primary  box-gris">

		<div class="box-header with-border my-box-header">
			<h3 class="box-title"><strong>Nuevo Usuario</strong></h3>
		</div><!-- /.box-header -->
			<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
			<hr style="border-color:white;" />

		<div class="box-body">

			<form   action="{{ url('crear_usuario') }}"  method="post" id="f_crear_usuario" class="formentrada" >
				<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
				<div class="box-header with-border my-box-header col-md-12" style="margin-bottom:15px;margin-top: 15px;">
						<h3 class="box-title">Datos de personales</h3>
				</div>
			<div class="col-md-12">


			<div class="col-md-4">
							<div class="form-group  @if($errors->has('nombre') ){{  'has-error' }} @endif">
								<label for="nombre">Nombres*   </label>
								<span class="help-block" >  @if($errors->has('nombre') ){{  $errors->first('nombre')  }} @endif </span>
									<input type="text" class="form-control" id="nombre" name="nombre"  value="{{ old('nombre') }}"  required   >

			</div><!-- /.form-group -->
			</div><!-- /.col -->

			<div class="col-md-4">
								<div class="form-group  @if($errors->has('paterno') ){{  'has-error' }} @endif">
									<label for="apellido">Paterno*</label>
									<span class="help-block" > @if($errors->has('paterno') ){{  $errors->first('paterno')  }} @endif</span>
									<input type="text" class="form-control" id="paterno" name="paterno" value="{{ old('paterno') }}"  required >
								</div><!-- /.form-group -->

			</div><!-- /.col -->
			<div class="col-md-4">
					<div class="form-group  @if($errors->has('materno') ){{  'has-error' }} @endif">
						<label  for="apellido">Materno*</label>
						<span class="help-block" > @if($errors->has('materno') ){{  $errors->first('materno')  }} @endif</span>
						<input type="text" class="form-control" id="materno" name="materno" value="{{ old('materno') }}"  required >
					</div><!-- /.form-group -->

</div><!-- /.col -->

	</div><!-- /.col -->


	{{--  --}}
	<div class="col-md-12">
			<div class="col-md-6">
				<div class="form-group @if($errors->has('telefono') ){{ 'has-error' }} @endif">
					<label for="celular">Telefono*</label>

						<span class="help-block" >@if($errors->has('telefono') ){{  $errors->first('telefono')  }} @endif</span>
						<input type="text" class="form-control" id="telefono" name="telefono"  value="{{ old('telefono') }}"  required >

					</div><!-- /.form-group -->

			</div><!-- /.col -->
			<div class="col-md-6">
				<div class="form-group @if($errors->has('ci') ){{ 'has-error' }} @endif">
					<label for="ci">C.I.*</label>

						<span class="help-block" >@if($errors->has('ci') ){{  $errors->first('ci')  }} @endif</span>
						<input type="text" class="form-control" id="ci" name="ci"  value="{{ old('ci') }}"  required >

					</div><!-- /.form-group -->

	</div><!-- /.col -->
	</div><!-- /.col -->

	<div class="box-header with-border my-box-header col-md-12" style="margin-bottom:15px;margin-top: 15px;">
							<h3 class="box-title">Datos de acceso</h3>
	</div>
					<div class="col-md-4">
						<div class="form-group @if($errors->has('email') ){{  'has-error' }} @endif">
							<label for="email">eMail*</label>
								<span class="help-block" >@if($errors->has('email') ){{  $errors->first('email')  }} @endif</span>
							<input type="email" class="form-control" id="email" name="email"  value="{{ old('email') }}"  required >
							</div><!-- /.form-group -->
					</div><!-- /.col -->

						<div class="col-md-4">
						<div class="form-group @if($errors->has('password') ){{  'has-error' }} @endif">
							<label for="email">Password*</label>

							<span class="help-block" >@if($errors->has('password') ){{  $errors->first('password')  }} @endif</span>
							<input type="password" class="form-control" id="password" name="password"    required >


							</div><!-- /.form-group -->

						</div><!-- /.col -->
						<div class="col-md-4">
							<div class="form-group">
								<label>Tipo de Usuario</label>
								<span class="help-block" ></span>
								<select class="form-control" name="tipoUsuario">
									<option value="4">Solo Funcionario</option>
									<option value="3">Jefe Unidad</option>
								</select>
							</div>
						</div>

							<div class="box-footer col-xs-12 box-gris ">
								<button type="submit" class="btn btn-primary">Crear Nuevo Usuario</button>
							</div>


							</form>

		</div>
	</div>
</div>
</section>

