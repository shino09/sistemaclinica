<style>
.readonly{
	background-color:white!important;
}
</style>

<div class="page-header">
	<h1>Crear Usuario</h1>
</div>

<ul class="nav nav-tabs">
	<li class="active"><a href="#generales" id="link-general" data-toggle="tab">Usuarios</a></li>
</ul>


<div class="tab-content">
	<div class="tab-pane active" id="generales">
    	<form action="#" method="post" id="form-agregar-usuario" class="form-horizontal">
            <fieldset>
                <h3>Información general</h3>
        		<div class="form-group">
        			<label for="nombre" class="col-sm-2 control-label">Nombre</label>
        			<div class="col-sm-4">
        				<input type="text" id="nombre" name="nombre" class="form-control validate[required]" />
        			</div>
        		</div>
                <div class="form-group">
        			<label for="contrasena" class="col-sm-2 control-label">Contraseña</label>
        			<div class="col-sm-4">
        				<input type="password" id="contrasena" name="contrasena" class="form-control validate[required,minSize[6]]" />
        			</div>
        		</div>
                <div class="form-group">
        			<label for="re-contrasena" class="col-sm-2 control-label">Repetir Contraseña</label>
        			<div class="col-sm-4">
        				<input type="password" id="re-contrasena" name="re-contrasena" class="form-control validate[required,equals[contrasena],minSize[6]]" />
        			</div>
        		</div>
        	</fieldset>
            <fieldset>
                <div class="col-sm-12">
					<div class="panel-group" id="accordion">
                        <h3>Asociar Tablas</h3>
    					<?php if($tablas){ ?>
    						<?php foreach($tablas as $aux){ ?>
    							<div class="panel panel-default">
    								<div class="panel-heading">
                                        <h4 class="panel-title">
                                            <label>
                                                <input type="checkbox" value="<?php echo $aux->codigo; ?>" class="tablas" name="tablas[]" />
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $aux->codigo;?>"> <?php echo $aux->nombre; ?></a> 
                                            </label>
                                        </h4>
                                        
    								</div>
    								<div  id="collapse<?php echo $aux->codigo;?>" class="panel-collapse collapse">
    									<div class="panel-body">
                                            <div style="margin-bottom:10px;" class="row">
                                                <div class="col-sm-4">
                                                    <select class="selectpicker validate[required] permisos_tabla" name="permisos-tablas-<?php echo $aux->codigo; ?>[]" title="Permisos Tabla" multiple="multiple">
                                                        <?php if($permisos){ ?>
                                                            <?php foreach($permisos as $tias){ ?>
                                                                <option value="<?php echo $tias->codigo; ?>"><?php echo $tias->nombre; ?></option>
                                                            <?php } ?>
                                                        <?php } ?>
                                					</select>
                                                </div>
                                            </div>
                                            <div class="thumbnail table-responsive all-responsive">
	                                           <table border="0" cellspacing="0" cellpadding="0" class="table tablesorter table-hover" style="margin-bottom:0;">
                                                    <thead>
                                            			<tr>
                                            				<th scope="col">Campo</th>
                                            				<th scope="col" class="last">Permisos</th>
                                            			</tr>
                                            		</thead>
                                                    <tbody>
                                            			<?php if($aux->campos){ ?>
                                            				<?php foreach($aux->campos as $cam){ ?>
                                            					<tr>
                                            						<td>
                                                                        <label>
                                                                            <input disabled style="margin-right:10px;" type="checkbox" class="campos" name="campos[]" value="<?php echo $cam->codigo; ?>" /><?php echo $cam->nombre; ?>
                                                                        </label>
                                                                    </td>
                                                                    <td>
                                            							<select class="selectpicker validate[required] permisos_campo" name="permisos-campos-<?php echo $cam->codigo; ?>[]" title="Permisos Campo" multiple="multiple">
                                                                            <?php if($permisos){ ?>
                                                                                <?php foreach($permisos as $tias){ ?>
                                                                                    <?php if($tias->codigo != 4){ #no existe eliminar campos ?>
                                                                                        <option style="display:none;" value="<?php echo $tias->codigo; ?>"><?php echo $tias->nombre; ?></option>
                                                                                    <?php } ?>
                                                                                <?php } ?>
                                                                            <?php } ?>
                                                    					</select>
                                            						</td>
                                            					</tr>
                                            				<?php } ?>
                                            			<?php } ?>
                                            		</tbody>
                                                </table>
    									   </div>
    									</div>
    								</div>
    							</div>
    						<?php } ?>
    					<?php } ?>
					</div>
				</div>
            </fieldset>
            
            <fieldset>
                <?php if($vistas){ ?>
                    <div class="col-sm-12">
    					<div class="panel-group" id="accordion">
                            <h3>Asociar Vistas</h3>
    						<?php foreach($vistas as $aux){ ?>
    							<div class="panel panel-default">
    								<div class="panel-heading">
                                        <h4 class="panel-title">
                                            <label>
                                                <input type="checkbox" value="<?php echo $aux->codigo; ?>" class="tablas" name="tablas[]" />
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $aux->codigo;?>"> <?php echo $aux->nombre; ?></a> 
                                            </label>
                                        </h4>
                                        
    								</div>
    								<div  id="collapse<?php echo $aux->codigo;?>" class="panel-collapse collapse">
    									<div class="panel-body">
                                            <div style="margin-bottom:10px;" class="row">
                                                <div class="col-sm-4">
                                                    <select class="selectpicker validate[required] permisos_tabla" name="permisos-tablas-<?php echo $aux->codigo; ?>[]" title="Permisos Tabla" multiple="multiple">
                                                        <?php if($permisos){ ?>
                                                            <?php foreach($permisos as $tias){ ?>
                                                                <option value="<?php echo $tias->codigo; ?>"><?php echo $tias->nombre; ?></option>
                                                            <?php } ?>
                                                        <?php } ?>
                                					</select>
                                                </div>
                                            </div>
                                            <div class="thumbnail table-responsive all-responsive">
	                                           <table border="0" cellspacing="0" cellpadding="0" class="table tablesorter table-hover" style="margin-bottom:0;">
                                                    <thead>
                                            			<tr>
                                            				<th scope="col">Campo</th>
                                            				<th scope="col" class="last">Permisos</th>
                                            			</tr>
                                            		</thead>
                                                    <tbody>
                                            			<?php if($aux->campos){ ?>
                                            				<?php foreach($aux->campos as $cam){ ?>
                                            					<tr>
                                            						<td>
                                                                        <label>
                                                                            <input disabled style="margin-right:10px;" type="checkbox" class="campos" name="campos[]" value="<?php echo $cam->codigo; ?>" /><?php echo $cam->nombre; ?>
                                                                        </label>
                                                                    </td>
                                                                    <td>
                                            							<select class="selectpicker validate[required] permisos_campo" name="permisos-campos-<?php echo $cam->codigo; ?>[]" title="Permisos Campo" multiple="multiple">
                                                                            <?php if($permisos){ ?>
                                                                                <?php foreach($permisos as $tias){ ?>
                                                                                    <?php if($tias->codigo != 4){ #no existe eliminar campos ?>
                                                                                        <option style="display:none;" value="<?php echo $tias->codigo; ?>"><?php echo $tias->nombre; ?></option>
                                                                                    <?php } ?>
                                                                                <?php } ?>
                                                                            <?php } ?>
                                                    					</select>
                                            						</td>
                                            					</tr>
                                            				<?php } ?>
                                            			<?php } ?>
                                            		</tbody>
                                                </table>
    									   </div>
    									</div>
    								</div>
    							</div>
    						<?php } ?>
    					
    					</div>
    				</div>
                <?php } ?>
                <div style="margin-top: 15px;" class="text-center">
        			<button type="submit" id="guardar-tablas" class="btn btn-primary btn-lg">Guardar</button>
        		</div>
            </fieldset>
        </form>
	</div>
</div>
