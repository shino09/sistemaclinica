<script>
$(function(){
    if(window.location.hash == '#campos')
        $("#tab-campos").trigger('click');
});
</script>

<div class="page-header">
	<h1>Editar Tabla <?php echo $tabla->nombre; ?></h1>
</div>

<ul class="nav nav-tabs">
	<li class="active"><a href="#generales" data-toggle="tab">Tabla</a></li>
	<li><a href="#campos" id="tab-campos" data-toggle="tab">Campos</a></li>
</ul>


<div class="tab-content">
	<div class="tab-pane active" id="generales">
        <form action="#" method="post" id="form-editar-tabla" class="form-horizontal">
    		<fieldset>
                <h3>Información tabla</h3>
    			<div class="form-group">
    				<label for="nombre" class="col-sm-2 control-label">Nombre</label>
    				<div class="col-sm-4">
    					<input type="text" id="nombre" name="nombre" class="form-control validate[required]" value="<?php echo $tabla->nombre; ?>" />
    				</div>
    			</div>
                
                <div class="form-group">
    				<label for="prefijo" class="col-sm-2 control-label">Prefijo</label>
    				<div class="col-sm-2">
    					<input type="text" readonly id="prefijo" name="prefijo" class="form-control validate[required]" value="<?php echo $tabla->prefijo; ?>" />
    				</div>
    			</div>
                
                <div class="form-group">
    				<label for="nombre_tabla" class="col-sm-2 control-label">Nombre Tabla DB</label>
    				<div class="col-sm-4">
    					<input type="text" readonly id="nombre_tabla" name="nombre_tabla" class="form-control validate[required]" value="<?php echo $tabla->nombre_tabla; ?>" />
    				</div>
    			</div>
                
                <div class="form-group">
    				<label for="comentario" class="col-sm-2 control-label">Comentario</label>
    				<div class="col-sm-4">
    					<textarea id="comentario" name="comentario" class="form-control" rows="5"><?php echo $tabla->comentario; ?></textarea>
                    </div>
    			</div>
                
                <input type="hidden" id="codigo" value="<?php echo $tabla->codigo; ?>" />
    
    			<div class="text-center">
    				<button type="submit" class="btn btn-primary btn-lg">Guardar</button>
    			</div>
    		</fieldset>
        </form>
	</div>

	<div class="tab-pane" id="campos">
        <form action="#" method="post" id="form-agregar-campo" class="form-horizontal">
    		<fieldset>
    			<h3>Crear Campos </h3><a style="display:none;" id="cancelar-editar" href="#">Cancelar</a>
    			<div class="form-group">
    				<label class="col-sm-2 control-label">Nombre</label>
    				<div class="col-sm-4">
    					<input type="text" id="nombre_campo" class="form-control validate[required]" name="nombre_campo"/>
    				</div>
    			</div>
                <div class="form-group">
    				<label class="col-sm-2 control-label">Clave Primaria</label>
    				<div class="col-sm-4">
    					<select class="selectpicker" id="clave_primaria" name="clave_primaria" title="Clave Primaria">
    						<option value="0">No</option>
    						<option value="1">Si</option>
    					</select>
    				</div>
    			</div>
                <div class="form-group">
    				<label class="col-sm-2 control-label">Campo Nulo</label>
    				<div class="col-sm-4">
    					<select class="selectpicker" id="nulo" name="nulo" title="Campo Nulo">
    						<option value="0">No</option>
    						<option value="1">Si</option>
    					</select>
    				</div>
    			</div>
                <div class="form-group">
    				<label class="col-sm-2 control-label">Tipo Campo</label>
    				<div class="col-sm-4">
    					<select class="selectpicker validate[required]" id="tipo_campo" name="tipo_campo" title="Tipo Campo">
    						<option value="">Seleccione</option>
                            <?php if($tipos_campo){ ?>
                                <?php foreach($tipos_campo as $aux){ ?>
                                    <?php if($aux->codigo != 11){ ?>
                                        <option value="<?php echo $aux->codigo; ?>"><?php echo $aux->nombre; ?></option>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
    					</select>
    				</div>
    			</div>
                <div class="form-group">
    				<label class="col-sm-2 control-label">Longitud</label>
    				<div class="col-sm-4">
    					<input type="text" id="longitud" class="form-control" name="longitud" />
    				</div>
                </div>
                <div class="form-group">
    				<label class="col-sm-2 control-label">Valor Predeterminado</label>
    				<div class="col-sm-4">
    					<input type="text" id="valor_predeterminado" class="form-control" name="valor_predeterminado" />
    				</div>
                </div>
                <div class="form-group">
    				<label class="col-sm-2 control-label">Campo Relacionado</label>
    				<div class="col-sm-4">
    					<select class="selectpicker" id="campo_relacionado" name="campo_relacionado" title="Campo Relacionado">
    						<option value="0">No</option>
    						<option value="1">Si</option>
    					</select>
    				</div>
    			</div>
                <fieldset class="relaciones relaciones_si" style="display:none;">
                    <div class="form-group">
        				<label class="col-sm-2 control-label">Tabla Relacionada</label>
        				<div class="col-sm-4">
        					<select class="selectpicker validate[required]" id="relacion" name="relacion" title="Tabla Relacionada">
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
        				<label class="col-sm-2 control-label">Campo</label>
        				<div class="col-sm-4">
        					<select class="selectpicker validate[required]" id="campo_relacion" name="campo_relacion" title="Campo">
                                <option value="">Seleccione</option>
        					</select>
        				</div>
        			</div>
                    <div class="form-group">
        				<label class="col-sm-2 control-label">Tipo Relación</label>
        				<div class="col-sm-4">
        					<select class="selectpicker validate[required]" id="tipo_relacion" name="tipo_relacion" title="Tipo Relación">
                                <?php if($tipos_relacion){ ?>
                                    <?php foreach($tipos_relacion as $aux){ ?>
                                        <option value="<?php echo $aux->codigo; ?>"><?php echo $aux->nombre; ?></option>
                                    <?php } ?>
                                <?php } ?>
        					</select>
        				</div>
        			</div>
                </fieldset>
                
                <div class="form-group">
    				<label for="comentario" class="col-sm-2 control-label">Comentario</label>
    				<div class="col-sm-4">
    					<textarea id="comentario_campo" name="comentario" class="form-control" rows="2"></textarea>
                    </div>
    			</div>
                
                <input type="hidden" name="tabla" value="<?php echo $tabla->codigo; ?>" />
                <input type="hidden" name="codigo_campo" id="codigo_campo" value="" />
                
    			<div class="text-center">
    				<button type="submit" class="btn btn-primary btn-lg">Guardar Campo</button>
    				<a href="<?php echo base_url(); ?>/tablas/"><button type="button" class="btn btn-link btn-lg">Finalizar</button></a>
    			</div>
    	  </fieldset>
      </form>
      <h3>Campos de la tabla <?php echo $tabla->nombre; ?></h3>
      <div class="thumbnail table-responsive all-responsive">
            <table border="0" cellspacing="0" cellpadding="0" class="table tablesorter table-hover" style="margin-bottom:0;">
        		<thead>
        			<tr>
        				<th scope="col">Nombre</th>
        				<th scope="col">Tipo campo</th>
        				<th scope="col">Longitud</th>
        				<th scope="col">Clave primaria</th>
        				<th scope="col">Nulo</th>
        				<th scope="col">Valor predeterminado</th>
        				<th scope="col" >Tabla relación</th>
        				<th scope="col" class="last"></th>
        			</tr>
        		</thead>
        		<tbody>
        			<?php if($tabla->campos){ ?>
        				<?php foreach($tabla->campos as $aux){ ?>
        					<tr title="<?php echo $aux->comentario; ?>">
        						<td><?php echo $aux->nombre; ?></td>
        						<td><?php echo $aux->tipo_campo->nombre; ?></td>
        						<td><?php echo $aux->longitud; ?></td>
        						<td class="<?php if($aux->primaria) echo 'text-warning'; ?>"><?php echo ($aux->primaria)?'Si':'No'; ?></td>
        						<td><?php echo ($aux->nulo)?'Si':'No'; ?></td>
        						<td><?php echo $aux->predeterminado; ?></td>
                                <td><?php echo ($aux->tabla_relacion)?$aux->tabla_relacion->nombre:''; ?></td>
        						<td class="editar">
        							<button title="Editar" type="button" rel="<?php echo $aux->codigo; ?>" class="btn btn-success btn-sm editar_campo"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>
        							<button title="Eliminar" type="button" rel="<?php echo $aux->codigo; ?>" class="btn btn-danger btn-sm eliminar_campo"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        						</td>
        					</tr>
                            <input type="hidden" class="nombre_campo" rel="<?php echo $aux->codigo; ?>" value="<?php echo $aux->nombre; ?>" />
                            <input type="hidden" class="campo_primaria" rel="<?php echo $aux->codigo; ?>" value="<?php echo $aux->primaria; ?>" />
                            <input type="hidden" class="campo_nulo" rel="<?php echo $aux->codigo; ?>" value="<?php echo $aux->nulo; ?>" />
                            <input type="hidden" class="campo_longitud" rel="<?php echo $aux->codigo; ?>" value="<?php echo $aux->longitud; ?>" />
                            <input type="hidden" class="campo_predeterminado" rel="<?php echo $aux->codigo; ?>" value="<?php echo $aux->predeterminado; ?>" />
                            <input type="hidden" class="tipo_campo" rel="<?php echo $aux->codigo; ?>" value="<?php echo $aux->tipo_campo->codigo; ?>" />
                            <input type="hidden" class="relacion" rel="<?php echo $aux->codigo; ?>" value="<?php echo ($aux->tabla_relacion)?$aux->tabla_relacion->codigo:''; ?>" />
                            <input type="hidden" class="campo_relacion" rel="<?php echo $aux->codigo; ?>" value="<?php echo ($aux->campo_relacion)?$aux->campo_relacion->codigo:''; ?>" />
                            <input type="hidden" class="tipo_relacion" rel="<?php echo $aux->codigo; ?>" value="<?php echo ($aux->tipo_relacion)?$aux->tipo_relacion->codigo:''; ?>" />
                            <input type="hidden" class="comentario_campo" rel="<?php echo $aux->codigo; ?>" value="<?php echo $aux->comentario; ?>" />
        				<?php } ?>
        			<?php } else{ ?>
        				<tr>
        					<td colspan="6" style="text-align:center;"><i>No hay registros</i></td>
        				</tr>
        			<?php } ?>
        		</tbody>
        	</table>
        </div>
	</div>
</div>
