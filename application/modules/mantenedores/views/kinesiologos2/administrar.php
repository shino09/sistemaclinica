<?php if(!isset($dato->estado)) $dato->estado = 1; ?>
<!--[if !IE]><!-->
<style type="text/css">
.col-sm-4{ margin-bottom:0;}
@media (max-width: 660px) {
td:nth-of-type(1):before { content: "Tipo"; }
td:nth-of-type(2):before { content: "Nombre"; }
td:nth-of-type(3):before { content: "Peso"; }
td:nth-of-type(4):before { content: " "; }
}
</style>
<!--<![endif]-->
<div class="block-text">
    <h1 class="h3"><img class="tit-icon" src="/imagenes/sitio/icon-perfil.png" width="44" height="44" alt="Documentación" /> Agregar Evento</h1>
  <form class="form" class="form-horizontal" method="post" action="#">
    <fieldset>
      <div class="form-group">
        <label for="nombre_evento" class="col-sm-3 col-md-2 control-label">Nombre:</label>
        <div class="col-sm-8 col-md-9">
          <input type="text" id="nombre_evento" class="form-control" name="kin_nombre" value="<?=@$dato->nombre?>" />
        </div>
      </div>
   

    



      <div class="form-group">
        <label for="estado" class="col-sm-3 col-md-2 control-label">Estado:</label>
        <div class="col-sm-4 col-md-3">
          <select id="estado" class="selectpicker" name="kin_estado">
            <option<?php if(@$dato->estado == 1) echo " SELECTED";?> value="1">Activo</option>
            <option<?php if(@$dato->estado == 0) echo " SELECTED";?> value="0">Inactivo</option>
          </select>
        </div>
      </div>
      <?php if($this->uri->segment(4)){ ?>
      <input type="hidden" name="kin_codigo" id="codigo" value="<?=$this->uri->segment(4)?>"/>
      <?php } ?>
      <div class="highlight text-center">
        <input type="submit" value="Guardar Cambios" class="btn btn-primary" />
      </div>
    </fieldset>
  </form>
</div>

     <script src = "js / jquery.validationEngine.min.js" type = "text / javascript" charset = "utf-8"> </ script> 