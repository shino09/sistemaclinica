<!--<div class="navegacion">
  <div class="center">
    <?=$this->layout->getNav();?>
  </div>
</div>

<?php if(!isset($dato->estado)) $dato->estado = 1; ?>
<h1><?php if($this->uri->segment(4)) echo "Editar"; else echo "Agregar";?> kinesiologo</h1>
<form  action="#" id="form" class="form-horizontal" method="post">
  <fieldset class="col-md-8">
    <div class="form-group">
      <label for="nombre" class="col-sm-4 control-label">Nombre:</label>
      <div class="col-sm-7">
                <input type="text" id="nombre" class="form-control validate[required]" name="kin_nombre" value="<?=@$dato->nombre?>" />

      </div>
    </div>
  
   
    <div class="form-group">
      <label for="estado" class="col-sm-4 control-label">Estado:</label>
      <div class="col-sm-7">
        <select id="estado" class="form-control validate[required]" name="kin_estado">
            <option<?php if(@$dato->estado == 1) echo " SELECTED";?> value="1">Activo</option>
            <option<?php if(@$dato->estado == 0) echo " SELECTED";?> value="0">Inactivo</option>
        </select>
      </div>
    </div>
  </fieldset>
  <div class="clear"></div>
  <div class="pp-tb"></div>
  <fieldset class="col-sm-12 well text-center">
    <a href="/mantenedores/kinesiologos/"><input type="button" value="Cancelar" class="btn btn-default" /></a>
    <input type="submit" value="Guardar Cambios" class="btn btn-success" />
  </fieldset>
</form>
<?php if($this->uri->segment(4)){ ?>
<input type="hidden" name="codigo" id="codigo" value="<?=$this->uri->segment(4)?>"/>
<?php } ?>-->


<div class="navegacion">
  <div class="center">
    <?=$this->layout->getNav();?>
  </div>
</div>

<div class="center" style="position:relative;">

<?php if(!isset($dato->estado)) $dato->estado = 1; ?>
<h2><?php if($this->uri->segment(4)) echo "Editar"; else echo "Agregar";?> kinesiologo</h2>

<?php if($this->uri->segment(4)){ ?>
<input type="hidden" name="codigo" id="codigo" value="<?=$this->uri->segment(4)?>"/>
<?php } ?>

<form  action="#" id="form" class="form-horizontal" method="post">

<fieldset>
    <div class="block-inputs">
      <div>
        <label>Nombre:</label>
        <input type="text" id="nombre" class="form-control validate[required]" name="kin_nombre" value="<?=@$dato->nombre?>" />
      </div>
    

      <label for="estado" class="col-sm-4 control-label">Estado:</label>
      <div class="col-sm-7">
        <select id="estado" class="form-control validate[required]" name="kin_estado">
            <option<?php if(@$dato->estado == 1) echo " SELECTED";?> value="1">Activo</option>
            <option<?php if(@$dato->estado == 0) echo " SELECTED";?> value="0">Inactivo</option>
        </select>
      </div>

        <!--<div> <span>Estado:</span>
        <label class="switch">
          <input type="checkbox" checked>
          <span class="slider round"></span> <span class="activo">Activo</span> </label>
      </div>-->

    </div>


    <div class="fondo-botones">
      <div class="btn-group">
        <!--<input type="submit" value="Enviar">-->
        <button type="submit">Guardar</button>
      </div>
    </div>
  </fieldset>
  </form>
</div>


     <script src = "js / jquery.validationEngine.min.js" type = "text / javascript" charset = "utf-8"> </ script> 