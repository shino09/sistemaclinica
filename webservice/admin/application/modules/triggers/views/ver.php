<div class="page-header">
	<h1>Detalle trigger <?php echo $trigger->nombre; ?></h1>
</div>

<ul class="nav nav-tabs">
	<li class="active"><a href="#generales" data-toggle="tab">Trigger</a></li>
</ul>

<div class="tab-content">
	<div class="tab-pane active" id="generales">
		<form action="#" method="post" id="form-editar-tabla" class="form-horizontal">
            <fieldset>
                <h3>Información</h3>
    			<div class="form-group">
    				<label for="nombre" class="col-sm-2 control-label">Nombre</label>
    				<div class="col-sm-4">
    					<input type="text" readonly="readonly" id="nombre" name="nombre" class="form-control" value="<?php echo $trigger->nombre; ?>" />
    				</div>
    			</div>
    
    			<div class="form-group">
    				<label for="nombre" class="col-sm-2 control-label">SQL</label>
    				<div class="col-sm-4">
                        <textarea class="form-control" readonly="readonly" rows="7"><?php echo $trigger->sql; ?></textarea>
    				</div>
    			</div>
    
    			<div class="text-center">
    				<a href="<?php echo base_url(); ?>/triggers/"><button type="button" class="btn btn-primary btn-lg">Volvel al listado</button></a>
    			</div>
    		</fieldset>
        </form>
	</div>
</div>
