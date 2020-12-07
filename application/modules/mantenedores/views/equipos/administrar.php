
<div class="navegacion">
  <div class="center">
    <?=$this->layout->getNav();?>
  </div>
</div>

<div class="center" style="position:relative;">

<?php if(!isset($dato->estado)) $dato->estado = 1; ?>
<h2><?php if($this->uri->segment(4)) echo "Editar"; else echo "Agregar";?> equipo</h2>

<?php if($this->uri->segment(4)){ ?>
<input type="hidden" name="codigo" id="codigo" value="<?=$this->uri->segment(4)?>"/>
<?php } ?>

<form  action="#" id="form" class="form-horizontal" method="post">

<fieldset>
    <div class="block-inputs">
      <div>
        <label>Nombre:</label>
        <input type="text" id="nombre" class="form-control validate[required]" name="equ_nombre" value="<?=@$dato->nombre?>" />
      </div>

       <div>
        <label>Tipo:</label>
        <input type="text" id="tipo" class="form-control validate[required]" name="equ_tipo_1" value="<?=@$dato->tipo_1?>" />
      </div>
    
    

      <label for="estado" class="col-sm-4 control-label">Estado:</label>
      <div class="col-sm-7">
        <select id="estado" class="form-control validate[required]" name="equ_estado">
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