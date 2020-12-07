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
	<h1>Insertar en tabla <?php echo $tabla->nombre; ?></h1>
</div>

<ul class="nav nav-tabs">
	<li><a href="<?php echo base_url(); ?>/contenido/registros/<?php echo $tabla->codigo; ?>/">Registros</a></li>
	<li class="active"><a>Insertar</a></li>
</ul>


<div class="tab-content">
	<div class="tab-pane active" id="generales">
        <form action="#" method="post" id="form-agregar-contenido" class="form-horizontal">
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
                    ?>
                    <?php if($aux->campo_relacion){ ?>
                        <div class="form-group">
            				<label class="col-sm-2 control-label <?php echo ($aux->primaria)?'text-warning':'text-info'; ?>">
                                <?php echo $aux->nombre; ?>
                            </label>
            				<div class="col-sm-4">
            					<select class="selectpicker <?php echo $validacion; ?>" id="<?php echo $aux->nombre_campo; ?>" name="<?php echo $aux->nombre_campo; ?>" title="<?php echo $aux->nombre; ?>">
            						<option value="">Seleccione</option>
                                    <?php if($aux->relacion){ ?>
                                        <?php foreach($aux->relacion as $rel){ ?>
                                            <option value="<?php echo $rel->codigo; ?>"><?php echo $rel->codigo; ?></option>
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
                                    <textarea placeholder="<?php echo $predeterminado; ?>" id="<?php echo $aux->nombre_campo; ?>" name="<?php echo $aux->nombre_campo; ?>" class="form-control <?php echo $validacion; ?>" rows="3" ></textarea>
                                <?php } else{ ?>
                                    <input type="text" placeholder="<?php echo $predeterminado; ?>" id="<?php echo $aux->nombre_campo; ?>" name="<?php echo $aux->nombre_campo; ?>" class="form-control <?php echo $fecha; ?> <?php echo $validacion; ?>" />
            				    <?php } ?>
                            </div>
            			</div>
                    <?php } ?>
                <?php } ?>
                
                <input type="hidden" id="codigo_tabla" value="<?php echo $tabla->codigo; ?>" />
                
    			<div class="text-center">
    				<button type="submit" class="btn btn-primary btn-lg">Guardar</button>
    			</div>
    		</fieldset>
        </form>
	</div>
</div>
