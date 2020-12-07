<style>
.readonly{
	background-color:white!important;
}
</style>

<div class="page-header">
	<h1>Editar Usuario</h1>
</div>

<ul class="nav nav-tabs">
	<li class="active"><a href="#generales" id="link-general" data-toggle="tab">Usuarios</a></li>
</ul>


<div class="tab-content">
	<div class="tab-pane active" id="generales">
    	<form action="#" method="post" id="form-editar-usuario" class="form-horizontal">
            <fieldset>
                <h3>Información general</h3>
        		<div class="form-group">
        			<label for="nombre" class="col-sm-2 control-label">Nombre</label>
        			<div class="col-sm-4">
        				<input type="text" id="nombre" name="nombre" class="form-control validate[required]" value="<?php echo $usuario->nombre; ?>" />
        			</div>
        		</div>
                <div class="form-group">
        			<label for="nombre" class="col-sm-2 control-label" style="visibility: hidden;">Oculto</label>
        			<div class="col-sm-4">
        				<a href="#" id="btn-cambiarC">Cambiar Contraseña</a>
        			</div>
        		</div>
                <fieldset style="display:none;" id="cambiar-contrasena">
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
                    <div class="form-group">
            			<label for="re-contrasena" class="col-sm-2 control-label" style="visibility: hidden;">Oculto</label>
            			<div class="col-sm-4">
            				<a href="#" id="btn-cancelarC" >Cancelar</a>
            			</div>
            		</div>
                </fieldset>
        	</fieldset>
            <fieldset>
                <div class="col-sm-12">
					<div class="panel-group" id="accordion">
                        <h3>Asociar Tablas</h3>
    					<?php if($tablas){ ?>
    						<?php foreach($tablas as $aux){ ?>
                                <?php
                                    $checkedT = ''; $disabledC = 'disabled';
                                    if($usuario->permisos_tablas){
                                        foreach($usuario->permisos_tablas as $pt){
                                            if($pt->tabla == $aux->codigo){
                                                $checkedT = 'checked';
                                                $styleT = '';
                                                $disabledC = ''; 
                                            }
                                        }
                                    }
                                ?>
    							<div class="panel panel-default">
    								<div class="panel-heading">
                                        <h4 class="panel-title">
                                            <label>
                                                <input <?php echo $checkedT; ?> type="checkbox" value="<?php echo $aux->codigo; ?>" class="tablas" name="tablas[]" />
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $aux->codigo;?>"> <?php echo $aux->nombre; ?></a> 
                                            </label>
                                        </h4>
    								</div>
    								<div id="collapse<?php echo $aux->codigo;?>" class="panel-collapse collapse">
    									<div class="panel-body">
                                            <div style="margin-bottom:10px;" class="row">
                                                <div class="col-sm-4">
                                                    <select class="selectpicker permisos_tabla" name="permisos-tablas-<?php echo $aux->codigo; ?>[]" title="Permisos Tabla" multiple="multiple">
                                                        <?php if($permisos){ ?>
                                                            <?php foreach($permisos as $tias){ ?>
                                                                <?php
                                                                    $selectT = '';
                                                                    if($usuario->permisos_tablas){
                                                                        foreach($usuario->permisos_tablas as $pt){
                                                                            if($pt->tabla == $aux->codigo){
                                                                                if($pt->permiso == $tias->codigo){
                                                                                    $selectT = 'selected';
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                ?>
                                                                <option <?php echo $selectT; ?> value="<?php echo $tias->codigo; ?>"><?php echo $tias->nombre; ?></option>
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
                                            					<?php
                                                                    $checkedC = '';
                                                                    if($usuario->permisos_campos){
                                                                        foreach($usuario->permisos_campos as $pc){
                                                                            if($pc->campo == $cam->codigo){
                                                                                $checkedC = 'checked'; 
                                                                            }
                                                                        }
                                                                    }
                                                                ?>
                                                                <tr>
                                            						<td>
                                                                        <label>
                                                                            <input <?php echo $checkedC.' '.$disabledC; ?> style="margin-right:10px;" type="checkbox" class="campos" name="campos[]" value="<?php echo $cam->codigo; ?>" /><?php echo $cam->nombre; ?>
                                                                        </label>
                                                                    </td>
                                                                    <td>
                                            							<select class="selectpicker permisos_campo" name="permisos-campos-<?php echo $cam->codigo; ?>[]" title="Permisos Campo" multiple="multiple">
                                                                            <?php if($permisos){ ?>
                                                                                <?php foreach($permisos as $tias){ ?>
                                                                                    <?php
                                                                                        $selectC = '';
                                                                                        $display = "display:none;";
                                                                                        if($usuario->permisos_campos){
                                                                                            foreach($usuario->permisos_campos as $pc){
                                                                                                if($pc->campo == $cam->codigo){
                                                                                                    if($pc->permiso == $tias->codigo){
                                                                                                        $selectC = 'selected';
                                                                                                        $display = '';
                                                                                                    }
                                                                                                }
                                                                                            }
                                                                                        }
                                                                                        if($usuario->permisos_tablas){
                                                                                            foreach($usuario->permisos_tablas as $pt){
                                                                                                if($pt->tabla == $aux->codigo){
                                                                                                    if($pt->permiso == $tias->codigo){
                                                                                                        $display = '';
                                                                                                    }
                                                                                                }
                                                                                            }
                                                                                        }
                                                                                    ?>
                                                                                    <?php if($tias->codigo != 4){ #no existe eliminar campos ?>
                                                                                        <option <?php echo $selectC; ?> style="<?php echo $display; ?>" value="<?php echo $tias->codigo; ?>"><?php echo $tias->nombre; ?></option>
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
                                <?php
                                    $checkedT = ''; $disabledC = 'disabled';
                                    if($usuario->permisos_tablas){
                                        foreach($usuario->permisos_tablas as $pt){
                                            if($pt->tabla == $aux->codigo){
                                                $checkedT = 'checked';
                                                $styleT = '';
                                                $disabledC = ''; 
                                            }
                                        }
                                    }
                                ?>
    							<div class="panel panel-default">
    								<div class="panel-heading">
                                        <h4 class="panel-title">
                                            <label>
                                                <input <?php echo $checkedT; ?> type="checkbox" value="<?php echo $aux->codigo; ?>" class="tablas" name="tablas[]" />
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $aux->codigo;?>"> <?php echo $aux->nombre; ?></a> 
                                            </label>
                                        </h4>
    								</div>
    								<div id="collapse<?php echo $aux->codigo;?>" class="panel-collapse collapse">
    									<div class="panel-body">
                                            <div style="margin-bottom:10px;" class="row">
                                                <div class="col-sm-4">
                                                    <select class="selectpicker permisos_tabla" name="permisos-tablas-<?php echo $aux->codigo; ?>[]" title="Permisos Tabla" multiple="multiple">
                                                        <?php if($permisos){ ?>
                                                            <?php foreach($permisos as $tias){ ?>
                                                                <?php
                                                                    $selectT = '';
                                                                    if($usuario->permisos_tablas){
                                                                        foreach($usuario->permisos_tablas as $pt){
                                                                            if($pt->tabla == $aux->codigo){
                                                                                if($pt->permiso == $tias->codigo){
                                                                                    $selectT = 'selected';
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                ?>
                                                                <option <?php echo $selectT; ?> value="<?php echo $tias->codigo; ?>"><?php echo $tias->nombre; ?></option>
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
                                            					<?php
                                                                    $checkedC = '';
                                                                    if($usuario->permisos_campos){
                                                                        foreach($usuario->permisos_campos as $pc){
                                                                            if($pc->campo == $cam->codigo){
                                                                                $checkedC = 'checked'; 
                                                                            }
                                                                        }
                                                                    }
                                                                ?>
                                                                <tr>
                                            						<td>
                                                                        <label>
                                                                            <input <?php echo $checkedC.' '.$disabledC; ?> style="margin-right:10px;" type="checkbox" class="campos" name="campos[]" value="<?php echo $cam->codigo; ?>" /><?php echo $cam->nombre; ?>
                                                                        </label>
                                                                    </td>
                                                                    <td>
                                            							<select class="selectpicker permisos_campo" name="permisos-campos-<?php echo $cam->codigo; ?>[]" title="Permisos Campo" multiple="multiple">
                                                                            <?php if($permisos){ ?>
                                                                                <?php foreach($permisos as $tias){ ?>
                                                                                    <?php
                                                                                        $selectC = '';
                                                                                        $display = "display:none;";
                                                                                        if($usuario->permisos_campos){
                                                                                            foreach($usuario->permisos_campos as $pc){
                                                                                                if($pc->campo == $cam->codigo){
                                                                                                    if($pc->permiso == $tias->codigo){
                                                                                                        $selectC = 'selected';
                                                                                                        $display = '';
                                                                                                    }
                                                                                                }
                                                                                            }
                                                                                        }
                                                                                    ?>
                                                                                    <?php if($tias->codigo != 4){ #no existe eliminar campos ?>
                                                                                        <option <?php echo $selectC; ?> style="<?php echo $display; ?>" value="<?php echo $tias->codigo; ?>"><?php echo $tias->nombre; ?></option>
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
                <input type="hidden" id="codigo" value="<?php echo $usuario->codigo; ?>" />
                
                <div style="margin-top:15px;" class="text-center">
        			<button type="submit" id="guardar-tablas" class="btn btn-primary btn-lg">Guardar</button>
        		</div>
        		
            </fieldset>
        </form>
	</div>
</div>
