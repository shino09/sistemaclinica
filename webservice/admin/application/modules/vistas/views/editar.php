<div class="page-header">
	<h1>Crear vista <?php echo $vista->nombre; ?></h1>
</div>

<ul class="nav nav-tabs">
	<li class="active"><a href="#generales" data-toggle="tab">Vista</a></li>
	<li><a href="#tablas" data-toggle="tab">Tablas</a></li>
	<li><a href="#condiciones" data-toggle="tab">Condiciones</a></li>
</ul>

<div class="tab-content">
	<div class="tab-pane active" id="generales">
        <form action="#" method="post" id="form-editar-tabla" class="form-horizontal">
    		<fieldset>
                <h3>Información tabla</h3>
    			<div class="form-group">
    				<label for="nombre" class="col-sm-2 control-label">Nombre</label>
    				<div class="col-sm-4">
    					<input type="text" id="nombre" name="nombre" class="form-control validate[required]" value="<?php echo $vista->nombre; ?>" />
    				</div>
    			</div>
                
                <input type="hidden" id="codigo" value="<?php echo $vista->codigo; ?>" />
    
    			<div class="text-center">
    				<button type="submit" class="btn btn-primary btn-lg">Guardar</button>
    			</div>
    		</fieldset>
        </form>
	</div>

    <div class="tab-pane" id="tablas">
        <form action="#" method="post" id="form-agregar-tablas" class="form-horizontal">
    		<fieldset>
    			<h3>Agregar tablas</h3>
                <div class="form-group">
    				<label class="col-sm-2 control-label">Tabla principal</label>
    				<div class="col-sm-4">
    					<select class="selectpicker validate[required]" id="tabla_principal" name="tabla_principal" title="Tabla principal">
                            <option value="">Seleccione</option>
                            <?php if($tablas){ ?>
                                <?php foreach($tablas as $aux){ ?>
                                    <option value="<?php echo $aux->codigo; ?>"><?php echo $aux->nombre; ?></option>
                                <?php } ?>
                            <?php } ?>
    					</select>
    				</div>
    			</div>
                <div class="form-group">
    				<label class="col-sm-2 control-label">Campos</label>
    				<div class="col-sm-4">
    					<select class="selectpicker validate[required]" id="campos_tabla_principal" multiple="multiple" name="campos_tabla_principal[]" title="Campos">
                            <option value="">Seleccione</option>
    					</select>
    				</div>
    			</div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Tablas asociadas</label>
                        <?php foreach($tablas as $aux){ ?>
                            <div class="checkbox cont-tablas">
                                <label>
                                    <input type="checkbox" value="<?php echo $aux->codigo; ?>" class="tablas" name="tablas[]" /><?php echo $aux->nombre; ?>
                                </label>
                                <fieldset class="cont-campos" style="display:none;">
                                    <div class="form-group">
                        				<label class="col-sm-2 control-label">Tipo asociación</label>
                        				<div class="col-sm-4">
                        					<select class="selectpicker validate[required]" name="asociacion[]" title="Tipo asociación">
                                                <?php if($tipos_asociacion){ ?>
                                                    <?php foreach($tipos_asociacion as $tias){ ?>
                                                        <option value="<?php echo $tias->codigo; ?>"><?php echo $tias->nombre; ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                        					</select>
                        				</div>
                        			</div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Campos</label>
                                        <div class="col-sm-10">
                                            <?php foreach($aux->campos as $cam){ ?>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="campos[]" value="<?php echo $cam->codigo; ?>" /><?php echo $cam->nombre; ?>
                                                    </label>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </fieldset>
       </form>
    </div>
</div>
