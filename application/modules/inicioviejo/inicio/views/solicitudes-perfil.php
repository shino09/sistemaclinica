<h1>Solicitud de perfil</h1>
<form  action="#" id="form-aprobar-perfil" class="form-horizontal" method="post">
    <fieldset class="col-md-8">
        
        <div class="form-group">
            <label for="solicitante" class="col-sm-4 control-label">Solicitante:</label>
            <div class="col-sm-7">
                <input disabled="disabled" type="text" id="solicitante" class="form-control" value="<?php echo $solicitud->usuarios->nombre.' '.$solicitud->usuarios->primer_apellido.' '.$solicitud->usuarios->segundo_apellido; ?>" />
            </div>
        </div>
        
        <div class="form-group">
            <label for="perfil" class="col-sm-4 control-label">Perfil solicitado:</label>
            <div class="col-sm-7">
                <input disabled="disabled" type="text" id="perfil" class="form-control" value="<?php echo $solicitud->perfiles->nombre; ?>" />
            </div>
        </div>
        
        <div class="form-group">
            <label for="fecha" class="col-sm-4 control-label">Fecha solicitud:</label>
            <div class="col-sm-7">
                <input disabled="disabled" type="text" id="fecha" class="form-control" value="<?php echo date('d/m/Y H:i',strtotime($solicitud->fecha_solicitud)); ?>" />
            </div>
        </div>
        
        <div class="form-group">
            <label for="perfil" class="col-sm-4 control-label">Motivo:</label>
            <div class="col-sm-7">
                <textarea disabled="disabled" class="form-control"><?php echo $solicitud->motivo; ?></textarea>
            </div>
        </div>
        
        <div class="form-group">
            <label for="tiempo" class="col-sm-4 control-label">Tiempo solicitado:</label>
            <div class="col-sm-7">
                <input disabled="disabled" type="text" id="tiempo" class="form-control" value="<?php echo $solicitud->solicitudes_perfil_tiempo->nombre; ?>" />
            </div>
        </div>
    </fieldset>
    
    <div class="clear"></div>
    <div class="pp-tb"></div>
    <fieldset class="col-sm-12 well text-center">
        <?php if($solicitud->estado == 2){ ?>
            <p>Esta solicitud ya ha sido aprobada</p>
        <?php } ?>
        
        <a href="/escritorio/"><input type="button" value="Cancelar" class="btn btn-default" /></a>
        
        <?php if($solicitud->estado == 1){ ?>
            <input type="button" id="aprobar_perfil" rel="<?php echo $solicitud->codigo; ?>" value="Aprobar perfil" class="btn btn-success" />
        <?php } ?>
    </fieldset>
</form>