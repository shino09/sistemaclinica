<div class="page-header">
	<h1>Editar Perfil</h1>
</div>
<form action="#" method="post" id="form-perfil" class="form-horizontal">
	<fieldset>
		<div class="form-group">
			<label for="nombre" class="col-sm-2 control-label">Nombre</label>
			<div class="col-sm-4">
				<input type="text" id="nombre" name="nombre" class="form-control validate[required]" value="<?php echo $usuario->nombre; ?>" />
			</div>
		</div>
		<div class="form-group">
			<label for="email" class="col-sm-2 control-label">Email</label>
			<div class="col-sm-4">
				<input type="text" id="email" name="email" class="form-control validate[required,custom[email]]" value="<?php echo $usuario->email; ?>" />
			</div>
		</div>
		<fieldset style="display:none;" id="cont-contrasena">
			<div class="form-group">
				<label class="col-sm-2 control-label" for="contrasena">Contraseña:</label>
				<div class="col-sm-4">
					<input type="password"  id="contrasena" name="contrasena" class="form-control validate[required]" tabindex="" />
				</div>
				<div class="col-sm-4">
					<div class="checkbox">
						<label for="ver-contrasena"><input type="checkbox" id="ver-contrasena" >Ver Contraseña</label>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="re-contrasena">Repetir Contraseña:</label>
				<div class="col-sm-4">
					<input type="password"  id="re-contrasena" name="re-contrasena" class="form-control validate[required,equals[contrasena]]" tabindex="" />
				</div>
			</div>
			<div class="form-group" >
				<label class="col-sm-2 control-label"></label>
				<div class="col-sm-4"><a href="#" id="cancelar-contrasena">Cancelar</a></div>
			</div>
		</fieldset>
		<div class="form-group" id="cont-cambiar">
			<label class="col-sm-2 control-label"></label>
			<div class="col-sm-4"><a href="#" id="cambiar-contrasena">Cambiar Contraseña</a></div>
		</div>
	</fieldset>
	
	<div class="text-box">
		<button type="submit" class="btn btn-primary btn-lg">Actualizar</button>
	</div>
</form>
