<?php if(!isset($dato->estado)) $dato->estado = 1; ?>
<h1><?php if($this->uri->segment(4)) echo "Editar"; else echo "Agregar";?> Centro Medico</h1>
<form  action="#" id="form" class="form-horizontal" method="post">
  <fieldset class="col-md-8">
    <div class="form-group">
      <label for="nombre" class="col-sm-4 control-label">Nombre:</label>
      <div class="col-sm-7">
        <input type="text" id="nombre" class="form-control validate[required]" name="cent_nombre" value="<?=@$dato->nombre?>" />
      </div>
    </div>
    <div class="form-group">
      <label for="direccion" class="col-sm-4 control-label">Direccion:</label>
      <div class="col-sm-7">
        <input type="text" id="direccion" class="form-control validate[required]" name="cent_direccion" value="<?=@$dato->direccion?>" />
      </div>
    </div>
    <div class="form-group">
      <label for="telefono" class="col-sm-4 control-label">Telefono:</label>
      <div class="col-sm-7">
        <input type="text" id="telefono" class="form-control validate[required]" name="cent_telefono" value="<?=@$dato->telefono?>" />
      </div>
    </div>
    
    <div class="form-group">
      <label for="estado" class="col-sm-4 control-label">Estado:</label>
      <div class="col-sm-7">
        <select id="estado" class="form-control validate[required]" name="cent_estado">
            <option<?php if(@$dato->estado == 1) echo " SELECTED";?> value="1">Activo</option>
            <option<?php if(@$dato->estado == 0) echo " SELECTED";?> value="0">Inactivo</option>
        </select>
      </div>
    </div>
  </fieldset>
  <div class="clear"></div>
  <div class="pp-tb"></div>
  <fieldset class="col-sm-12 well text-center">
    <a href="/mantenedores/centros_medicos/"><input type="button" value="Cancelar" class="btn btn-default" /></a>
    <input type="submit" value="Guardar Cambios" class="btn btn-success" />
  </fieldset>
</form>
<?php /*echo 'segmentttttttttttttttt'; echo $this->uri->segment(4);*/ if($this->uri->segment(4)){ ?>
<input type="hidden" name="codigo" id="codigo" value="<?=$this->uri->segment(4)?>"/>
<?php } ?>


   <script src = "js / jquery.validationEngine.min.js" type = "text / javascript" charset = "utf-8"> </ script> 
