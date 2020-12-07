<style>
.readonly{
	background-color:white!important;
}
</style>

<div class="page-header">
	<h1>Crear Trigger</h1>
</div>

<ul class="nav nav-tabs">
	<li class="active"><a href="#generales" id="link-general" data-toggle="tab">Trigger</a></li>
    
	<li class="disabled tab-instrucciones-disabled"><a href="#" >Instrucciones</a></li>
	<li style="display:none;" class="tab-instrucciones"><a href="#instrucciones" id="link-instrucciones" data-toggle="tab">Instrucciones</a></li>
    
</ul>

<form action="#" method="post" id="form-agregar-trigger" class="form-horizontal">
    <div class="tab-content">
    	<div class="tab-pane active" id="generales">
        	<fieldset>
                <h3>Información trigger</h3>
        		<div class="form-group">
        			<label for="nombre" class="col-sm-2 control-label">Nombre</label>
        			<div class="col-sm-4">
        				<input type="text" id="nombre" name="nombre" class="form-control validate[required]" />
        			</div>
        		</div>
                
                <div class="form-group">
    				<label class="col-sm-2 control-label">Tabla</label>
    				<div class="col-sm-4">
    					<select class="selectpicker validate[required]" id="tabla_principal" name="tabla_principal" title="Tabla">
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
    				<label class="col-sm-2 control-label">Momento ejecución</label>
    				<div class="col-sm-4">
    					<select class="selectpicker validate[required]" id="tipo_principal" name="tipo_principal" title="Momento ejecución">
                            <option value="">Seleccione</option>
                            <?php if($tipos){ ?>
                                <?php foreach($tipos as $aux){ ?>
                                    <option value="<?php echo $aux->codigo; ?>"><?php echo $aux->nombre; ?></option>
                                <?php } ?>
                            <?php } ?>
    					</select>
    				</div>
    			</div>
                
                <div class="form-group">
    				<label class="col-sm-2 control-label">Acción</label>
    				<div class="col-sm-4">
    					<select class="selectpicker validate[required]" id="accion_principal" name="accion_principal" title="Acción">
                            <option value="">Seleccione</option>
                            <?php if($acciones){ ?>
                                <?php foreach($acciones as $aux){ ?>
                                    <option value="<?php echo $aux->codigo; ?>"><?php echo $aux->nombre; ?></option>
                                <?php } ?>
                            <?php } ?>
    					</select>
    				</div>
    			</div>
                
        		<div class="text-center">
        			<button type="submit" id="guardar-general" class="btn btn-primary btn-lg">Guardar y Agregar Instrucciones</button>
        		</div>
        	</fieldset>
    	</div>
        <div class="tab-pane" id="instrucciones">
    		<fieldset>
    			<h3>Bloque de instrucciones</h3>
                
                <div class="form-group">
    				<label class="col-sm-2 control-label">Tabla</label>
    				<div class="col-sm-4">
    					<select class="selectpicker validate[required]" id="tabla_secundaria" name="tabla_secundaria" title="Tabla">
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
    				<label class="col-sm-2 control-label">Acción</label>
    				<div class="col-sm-4">
    					<select class="selectpicker validate[required]" id="accion_secundaria" name="accion_secundaria" title="Acción">
                            <option value="">Seleccione</option>
                            <?php if($acciones){ ?>
                                <?php foreach($acciones as $aux){ ?>
                                    <option value="<?php echo $aux->codigo; ?>"><?php echo $aux->nombre; ?></option>
                                <?php } ?>
                            <?php } ?>
    					</select>
    				</div>
    			</div>
                
                <div style="display:none;" id="cont-valores">
                    <h4><b>Asignar Valores</b></h4>
                    <h5 style="display: none;" id="cargando_valores">Cargando...</h5>
                    <div class="form-group">
                        <div id="tabla_campos_valores"></div>
        			</div>
                </div>
                
                <div style="display:none; margin-top:15px;" id="cont-condiciones">
                    <h4><b>Condiciones</b></h4>
                    <h5 style="display: none;" id="cargando_condiciones">Cargando...</h5>
                    <div class="form-group">
                        <div id="tabla_campos_condiciones"></div>
        			</div>
                </div>
                <div class="text-center">
        			<button type="submit" id="enviar-form" class="btn btn-primary btn-lg">Crear Trigger</button>
        		</div>
            </fieldset>
        </div>
    </div>
</form>
