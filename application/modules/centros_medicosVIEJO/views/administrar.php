<?php if(!isset($dato->estado)) $dato->estado = 1; ?>
<h1><?php if($this->uri->segment(4)) echo "Editar"; else echo "Agregar";?> Centro Medico</h1>
<form  action="#" id="form" class="form-horizontal" method="post">
  <fieldset class="col-md-8">
    <div class="form-group">
      <label for="nombre" class="col-sm-4 control-label">Nombre:</label>
      <div class="col-sm-7">
        <input type="text" id="nombre" class="form-control validate[required]" name="cen_nombre" value="<?=@$dato->nombre?>" />
      </div>
    </div>
    <div class="form-group">
      <label for="unico_proveedor" class="col-sm-4 control-label">Único proveedor:</label>
      <div class="col-sm-7">
        <select id="unico_proveedor" class="form-control validate[required]" name="cen_unico_proveedor">
            <option<?php if(@$dato->unico_proveedor == 1) echo " SELECTED";?> value="1">Si</option>
            <option<?php if(@$dato->unico_proveedor == 0) echo " SELECTED";?> value="0">No</option>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label for="estado" class="col-sm-4 control-label">Estado:</label>
      <div class="col-sm-7">
        <select id="estado" class="form-control validate[required]" name="cen_estado">
            <option<?php if(@$dato->estado == 1) echo " SELECTED";?> value="1">Activo</option>
            <option<?php if(@$dato->estado == 0) echo " SELECTED";?> value="0">Inactivo</option>
        </select>
      </div>
    </div>
  </fieldset>
  <div class="clear"></div>
  <div class="pp-tb"></div>
  <fieldset class="col-sm-12 well text-center">
    <a href="/mantenedores/centro_de_costo/"><input type="button" value="Cancelar" class="btn btn-default" /></a>
    <input type="submit" value="Guardar Cambios" class="btn btn-success" />
  </fieldset>
</form>
<?php if($this->uri->segment(4)){ ?>
<input type="hidden" name="codigo" id="codigo" value="<?=$this->uri->segment(4)?>"/>
<?php } ?>
