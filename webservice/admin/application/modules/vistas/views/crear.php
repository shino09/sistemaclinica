<style>
.readonly{
	background-color:white!important;
}
</style>

<div class="page-header">
	<h1>Crear Vista</h1>
</div>

<ul class="nav nav-tabs">
	<li class="active"><a href="#generales" id="link-general" data-toggle="tab">Vista</a></li>
    
	<li class="disabled tab-tablas-disabled"><a href="#" >Tablas</a></li>
	<li style="display:none;" class="tab-tablas"><a href="#tablas" id="link-tablas" data-toggle="tab">Tablas</a></li>
    
	<li class="disabled tab-condiciones-disabled"><a href="#">Condiciones</a></li>
	<li style="display:none;" class="tab-condiciones"><a href="#condiciones" id="link-condiciones" data-toggle="tab">Condiciones</a></li>
</ul>

<form action="#" method="post" id="form-agregar-vista" class="form-horizontal">
    <div class="tab-content">
    	<div class="tab-pane active" id="generales">
        	<fieldset>
                <h3>Información vista</h3>
        		<div class="form-group">
        			<label for="nombre" class="col-sm-2 control-label">Nombre</label>
        			<div class="col-sm-4">
        				<input type="text" id="nombre" name="nombre" class="form-control validate[required]" />
        			</div>
        		</div>
                
        		<div class="text-center">
        			<button type="submit" id="guardar-general" class="btn btn-primary btn-lg">Guardar y Agregar Tablas</button>
        		</div>
        	</fieldset>
    	</div>
        <div class="tab-pane" id="tablas">
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
                                                        <input type="checkbox" class="campos_tablas" name="campos[]" value="<?php echo $cam->codigo; ?>" /><?php echo $cam->nombre; ?>
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
                <div class="text-center">
        			<button type="submit" id="guardar-tablas" class="btn btn-primary btn-lg">Guardar y Agregar Condiciones</button>
        		</div>
            </fieldset>
        </div>
        <div class="tab-pane" id="condiciones">
    		<fieldset>
    			<h3>Agregar condiciones</h3>
                <div class="form-group">
    				<label class="col-sm-2 control-label">Tablas</label>
    				<div class="col-sm-4">
    					<select class="selectpicker" id="tablas_condiciones" title="Tablas">
                            <option value="">Seleccione</option>
                            <?php if($tablas){ ?>
                                <?php foreach($tablas as $aux){ ?>
                                    <option style="display:none;" value="<?php echo $aux->codigo; ?>"><?php echo $aux->nombre; ?></option>
                                <?php } ?>
                            <?php } ?>
    					</select>
    				</div>
                    <div id="campos_permitidos"></div>
    			</div>
                <h4>Campos</h4>
                <h5 style="display: none;" id="cargando_condiciones">Cargando...</h5>
                <div class="form-group">
                    <div id="tabla_campos_condiciones"></div>
                    <div id="campos_condiciones"></div>
    			</div>
                <div class="text-center">
        			<button type="submit" id="enviar-form" class="btn btn-primary btn-lg">Crear Vista</button>
        		</div>
            </fieldset>
            
            <!-- aporta mas informacion sobre las condiciones -->
            <?php if($condiciones_general){ ?>
                <?php foreach($condiciones_general as $aux){ ?>
                    <input type="hidden" class="condiciones_general" value="<?php echo $aux->codigo; ?>" rel="<?php echo $aux->acepta_valor; ?>" />
                <?php } ?>
            <?php } ?>
            
        </div>
    </div>
</form>
