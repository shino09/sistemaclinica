


<div class="navegacion">
  <div class="center">
    <?=$this->layout->getNav();?>
  </div>
</div>

<div class="center" style="position:relative;">

<?php if(!isset($dato->estado)) $dato->estado = 1; ?>
<h2><?php if($this->uri->segment(4)) echo "Editar"; else echo "Agregar";?> modo ventilatorio</h2>

<?php if($this->uri->segment(4)){ ?>
<input type="hidden" name="codigo" id="codigo" value="<?=$this->uri->segment(4)?>"/>
<?php } ?>

<form  action="#" id="form" class="form-horizontal" method="post">

<fieldset>
    <div class="block-inputs">
      <div>
        <label>Nombre:</label>
        <input type="text" id="nombre" class="form-control validate[required]" name="modo_nombre" value="<?=@$dato->nombre?>" />
      </div>
 <label for="tipo" class="col-sm-4 control-label">tipo:</label>
        <div class="col-sm-7">
          <select id="tipo" class="form-control validate[required]" name="modo_tipo">
            <option<?php if(@$dato->tipo == 1) echo " SELECTED";?> value="1">Presión Control</option>
            <option<?php if(@$dato->tipo == 2) echo " SELECTED";?> value="2">Volumen Control</option>
            <option<?php if(@$dato->tipo == 3) echo " SELECTED";?> value="3">Modos Duales</option>

          </select>
        </div>
    
    

      <label for="estado" class="col-sm-4 control-label">Estado:</label>
      <div class="col-sm-7">
        <select id="estado" class="form-control validate[required]" name="modo_estado">
            <option<?php if(@$dato->estado == 1) echo " SELECTED";?> value="1">Activo</option>
            <option<?php if(@$dato->estado == 0) echo " SELECTED";?> value="0">Inactivo</option>
        </select>
      </div>




        <input type="hidden" id="mod3_modo_ventilatorio" name="mod3_modo_ventilatorio"  value="<?=$this->uri->segment(4)?>" />


         <div class="block-inputs checks" style="padding-top: 30px;">
      <div>
        <input type="checkbox" name="relaciones[]" value="1" />
        PEEP</div>
      <div>
        <input type="checkbox" name="relaciones[]" value="2" />
        Pmedia</div>
      <div>
        <input type="checkbox" name="relaciones[]" value="3" />
        Psoporte</div>
      <div>
        <input type="checkbox" name="relaciones[]" value="4" />
        Alarma de pasión</div>
      <div>
        <input type="checkbox" name="relaciones[]" value="5" />
        VC Ins</div>
      <div>
        <input type="checkbox" name="relaciones[]" value="6" />
        VC Esp</div>
      <div>
        <input type="checkbox" name="relaciones[]" value="7" />
        V Min</div>
      <div>
        <input type="checkbox" name="relaciones[]" value="8" />
        Alarma de volumen</div>
      <div>
        <input type="checkbox" name="relaciones[]" value="9" />
        FR VM</div>
      <div>
        <input type="checkbox" name="relaciones[]" value="10" />
        Tiempo Inspiratorio</div>
      <div>
        <input type="checkbox" name="relaciones[]" value="11" />
        Humidificación</div>
      <div>
        <input type="checkbox" name="relaciones[]" value="12" />
        Temperatura</div>
      <div>
        <input type="checkbox" name="relaciones[]" value="13" />
        Cambio de matriz/Llenado de cámara humificadora </div>
      <div>
        <input type="checkbox" name="relaciones[]" value="14" />
        Gases arteriales</div>
      <div>
        <input type="checkbox" name="relaciones[]" value="15" />
        Función Pulmonar</div>
      <div>
        <input type="checkbox" name="relaciones[]" value="16" />
        VAFO</div>
      <div>
        <input type="checkbox" name="relaciones[]" value="17" />
        Respaldo</div>
      <div>
        <input type="checkbox" name="relaciones[]" value="18" />
        Cambio circuito</div>
      <div>
        <input type="checkbox" name="relaciones[]" value="19" />
        Aseo diario</div>
      <div>
        <input type="checkbox" name="relaciones[]" value="20" />
        Kinesiologo responsable</div>
      <div>
        <input type="checkbox" name="relaciones[]" value="21" />
        iNO</div>
      <div>
        <input type="checkbox" name="relaciones[]" value="22" />
        ECMO</div>
    </div>



<!--
     <div class="block-inputs checks" style="padding-top: 30px;">
      <div>
        <input type="checkbox" name="relaciones[]" value="PEEP" />
        PEEP</div>
      <div>
        <input type="checkbox" name="relaciones[]" value="Pmedia" />
        Pmedia</div>
      <div>
        <input type="checkbox" name="relaciones[]" value="Psoporte" />
        Psoporte</div>
      <div>
        <input type="checkbox" name="relaciones[]" value="Alarma de pasión" />
        Alarma de pasión</div>
      <div>
        <input type="checkbox" name="relaciones[]" value="VC Ins" />
        VC Ins</div>
      <div>
        <input type="checkbox" name="relaciones[]" value="VC Esp" />
        VC Esp</div>
      <div>
        <input type="checkbox" name="relaciones[]" value="V Min" />
        V Min</div>
      <div>
        <input type="checkbox" name="relaciones[]" value="Alarma de volumen" />
        Alarma de volumen</div>
      <div>
        <input type="checkbox" name="relaciones[]" value="FR VM" />
        FR VM</div>
      <div>
        <input type="checkbox" name="relaciones[]" value="Tiempo Inspiratorio" />
        Tiempo Inspiratorio</div>
      <div>
        <input type="checkbox" name="relaciones[]" value="Humidificación" />
        Humidificación</div>
      <div>
        <input type="checkbox" name="relaciones[]" value="Temperatura" />
        Temperatura</div>
      <div>
        <input type="checkbox" name="relaciones[]" value="Cambio de matriz/Llenado de cámara humificadora" />
        Cambio de matriz/Llenado de cámara humificadora </div>
      <div>
        <input type="checkbox" name="relaciones[]" value="Gases arteriales" />
        Gases arteriales</div>
      <div>
        <input type="checkbox" name="relaciones[]" value="Función Pulmonar" />
        Función Pulmonar</div>
      <div>
        <input type="checkbox" name="relaciones[]" value="VAFO" />
        VAFO</div>
      <div>
        <input type="checkbox" name="relaciones[]" value="Respaldo" />
        Respaldo</div>
      <div>
        <input type="checkbox" name="relaciones[]" value="Cambio circuito" />
        Cambio circuito</div>
      <div>
        <input type="checkbox" name="relaciones[]" value="Aseo diario" />
        Aseo diario</div>
      <div>
        <input type="checkbox" name="relaciones[]" value="Kinesiologo responsable" />
        Kinesiologo responsable</div>
      <div>
        <input type="checkbox" name="relaciones[]" value="iNO" />
        iNO</div>
      <div>
        <input type="checkbox" name="relaciones[]" value="ECMO" />
        ECMO</div>
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