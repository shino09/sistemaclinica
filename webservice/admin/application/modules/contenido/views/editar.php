<script>
$(function() {
    $(".fecha").datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: 'yy-mm-dd'
    });
});
</script>


<div class="page-header">
	<h1>Editar en tabla <?php echo $tabla->nombre; ?></h1>
</div>

<ul class="nav nav-tabs">
	<li class="active"><a>Registros</a></li>
	<li><a href="<?php echo base_url(); ?>/contenido/insertar/<?php echo $tabla->codigo; ?>/">Insertar</a></li>
</ul>


<div class="tab-content">
	<div class="tab-pane active" id="generales">
        <form action="#" method="post" id="form-editar-contenido" class="form-horizontal">
    		<fieldset>
                <h3>Campos</h3>
    			
                <?php foreach($tabla->campos as $aux){ ?>
                    <?php
                        $validacion = $predeterminado = $fecha = "";
                        if(!$aux->nulo && !$aux->predeterminado)
                            $validacion = "validate[required]";
                        else{
                            if($aux->predeterminado)
                                $predeterminado = $aux->predeterminado;
                            elseif($aux->nulo)
                                $predeterminado = "NULL";
                        }
                        if($aux->tipo_campo->codigo == 4) #DATE
                            $fecha = 'fecha';
                            
                        $campo = $aux->nombre_campo;
                        $value = $registro->$campo;
                    ?>
                    <?php if($aux->campo_relacion){ ?>
                        <div class="form-group">
            				<label class="col-sm-2 control-label <?php echo ($aux->primaria)?'text-warning':'text-info'; ?>">
                                <?php echo $aux->nombre; ?>
                            </label>
            				<div class="col-sm-4">
            					<select class="selectpicker <?php echo $validacion; ?>" id="<?php echo $aux->nombre_campo; ?>" name="<?php echo $aux->nombre_campo; ?>" title="<?php echo $aux->comentario; ?>">
            						<option value="">Seleccione</option>
                                    <?php if($aux->relacion){ ?>
                                        <?php foreach($aux->relacion as $rel){ ?>
                                            <?php
                                                $selected = "";
                                                if($rel->codigo == $value)
                                                    $selected = "selected";
                                            ?>
                                            <option <?php echo $selected; ?> value="<?php echo $rel->codigo; ?>"><?php echo $rel->codigo; ?></option>
                                        <?php } ?>
                                    <?php } ?>
            					</select>
            				</div>
            			</div>
                    <?php }else{ ?>
                        <div class="form-group">
            				<label for="<?php echo $aux->nombre_campo; ?>" class="col-sm-2 control-label <?php if($aux->primaria) echo 'text-warning'; ?>">
                                <?php echo $aux->nombre; ?>
                            </label>
                            <div class="col-sm-4">
            					<?php if($aux->tipo_campo->codigo == 8){ #textarea ?>
                                    <textarea placeholder="<?php echo $predeterminado; ?>" id="<?php echo $aux->nombre_campo; ?>" name="<?php echo $aux->nombre_campo; ?>" class="form-control <?php echo $validacion; ?>" title="<?php echo $aux->comentario; ?>" rows="3" ><?php echo $value; ?></textarea>
                                <?php } else{ ?>
                                    <input type="text" placeholder="<?php echo $predeterminado; ?>" id="<?php echo $aux->nombre_campo; ?>" name="<?php echo $aux->nombre_campo; ?>" class="form-control <?php echo $fecha; ?> <?php echo $validacion; ?>" title="<?php echo $aux->comentario; ?>" value="<?php echo $value; ?>" />
            				    <?php } ?>
                            </div>
            			</div>
                    <?php } ?>
                <?php } ?>
                
                <input type="hidden" id="codigo_tabla" value="<?php echo $tabla->codigo; ?>" />
                <input type="hidden" id="codigo_registro" value="<?php echo $registro->codigo; ?>" />
                
    			<div class="text-center">
    				<button type="submit" class="btn btn-primary btn-lg">Guardar</button>
    				<a href="<?php echo base_url(); ?>/contenido/registros/<?php echo $tabla->codigo; ?>/"><button type="button" class="btn btn-link btn-lg">Cancelar</button></a>
    			</div>
    		</fieldset>
        </form>
	</div>
</div>
