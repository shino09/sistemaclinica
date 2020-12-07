<div class="navegacion">
  <div class="center">
    <?=$this->layout->getNav();?>
  </div>
</div>




<div class="center" style="position:relative;">

<?php if(!isset($dato->estado)) $dato->estado = 1; ?>
<h2><?php if($this->uri->segment(4)) echo "Editar"; else echo "Agregar";?> Paciente</h2>

<?php if($this->uri->segment(4)){ ?>
<input type="hidden" name="codigo" id="codigo" value="<?=$this->uri->segment(4)?>"/>
<?php } ?>


<form  action="#" id="form" class="form-horizontal" method="post">

<div class="center">
 
    <div class="inline-input">
    

        <!--  <div class="form-group">
      <label for="region" class="col-sm-4 control-label">Centro Medico:</label>
        <select id="region" class="form-control validate[required]" name="fic_centro_medico">
          <option value="">Seleccione</option>
            <?php foreach($rel as $dat): ?>
            <option<?php if(@$dato->centro_medicos1 == $dat->codigo) echo " SELECTED";?> value="<?=$dat->codigo?>"><?=$dat->nombre?></option>
          <?php endforeach; ?>
        </select>
    </div>
    

        <div>
        <label>Unidad:</label>
          <select >
            <?php foreach($rel3 as $dat): ?>
            <option<?php  echo " SELECTED";?> value="<?=$dat->codigo?>"><?=$dat->nombre?></option>
          <?php endforeach; ?>
        </select>
      </div>-->



  <div>
          <label >Centro Medico:</label>

        <select id="fic_centro_medicos1" class="form-control validate[required]" name="fic_centro_medicos1">
          <option value="">Seleccione</option>
            <?php foreach($rel as $dat): ?>
            <option<?php if(@$dato->centro_medicos1 == $dat->codigo) echo " SELECTED";?> value="<?=$dat->codigo?>"><?=$dat->nombre?></option>
          <?php endforeach; ?>
        </select>
</div>



  <div>
          <label >Unidad:</label>

        <select id="fic_unidad_2" class="form-control validate[required]" name="fic_unidad_2">
          <option value="">Seleccione</option>
            <?php foreach($rel3 as $re3): ?>
            <option<?php if(@$dato->unidad_2 == $re3->codigo) echo " SELECTED";?> value="<?=$re3->codigo?>"><?=$re3->nombre?></option>
          <?php endforeach; ?>
        </select>
</div>


  
      


   <!--   <div class="form-group">
      <label for="unidad" class="col-sm-4 control-label">Unidad:</label>
        <select id="unidad" class="form-control validate[required]" name="fic_unidad">
          <option value="">Seleccione</option>
            <?php foreach($rel3 as $dat){ ?>
            <option<?php echo " SELECTED";?> value="<?=$dat->codigo?>"><?=$dat->nombre?></option>
          <?php } ?>
        </select>
    </div>-->


      

<!--
      <label for="unidad" class="col-sm-4 control-label">Unidad:</label>
      <div class="col-sm-7">
        <select id="unidad" class="form-control validate[required]" name="fic_unidad">
                    <option value="">Seleccione</option>

            <option<?php if(@$dato->unidad == 2) echo " SELECTED";?> value="UCI PEDRIATRICA">UCI PEDRIATRICA</option>
            <option<?php if(@$dato->unidad == 1) echo " SELECTED";?> value="NEONATOLOGIA UCI/INTERMEDIO">NEONATOLOGIA UCI/INTERMEDIO</option>
            <option<?php if(@$dato->unidad == 0) echo " SELECTED";?> value="UNIDAD CORONARIA">UNIDAD CORONARIA</option>

        </select>
      </div>-->



   
   <div>
        <label>Fecha: </label>
        <input type="text" id="datepicker" name="fic_fecha_ingreso" value="<?=@$dato->fecha_ingreso?>" />
        <i class="fa fa-calendar"></i> </div>

      <div>
                  <label >Hora</label>

        <input id="fic_hora_ingreso" name="fic_hora_ingreso" type="time" placeholder="hora" value="<?=@$dato->hora_ingreso?>" />
        <i class="fa fa-calendar"></i> </div>
      </div>
    
    <div class="block-inputs">

      <div>
        <label>Nombre:</label>
        <input type="text" id="nombre_completo" class="form-control validate[required]" name="fic_nombre_completo" value="<?=@$dato->nombre_completo?>" />
      </div>

      <div>
        <label>Rut:</label>
        <input type="text" id="rut" class="form-control validate[required]" name="fic_rut_" value="<?=@$dato->rut_?>" />
      </div>
      <div>
        <label>Edad:</label>
        <input type="text" id="edad" class="form-control validate[required]" name="fic_edad" value="<?=@$dato->edad?>" />
      </div>
      <div>
        <label>Diagnostico:</label>
        <input type="text" id="diagnostico" class="form-control validate[required]" name="fic_diagnostico" value="<?=@$dato->diagnostico?>" />
      </div>
      <!-- <div>
        <label>Numero Ficha:</label>
        <input type="text" id="numero_ficha" class="form-control validate[required]" name="fic_numero_ficha" value="<?=@$dato->numero_ficha?>" />
      </div>-->
      <div>
        <label>Peso:</label>
        <input type="text" id="peso" class="form-control validate[required]" name="fic_peso" value="<?=@$dato->peso?>" />
      </div>
      <div>
        <label>Talla:</label>
        <input type="text" id="talla" class="form-control validate[required]" name="fic_talla" value="<?=@$dato->talla?>" />
      </div>
     
  <label for="fic_estado" class="col-sm-4 control-label">Estado:</label>
      <div class="col-sm-7">
        <select id="fic_estado" class="form-control validate[required]" name="fic_estado">
            <option<?php if(@$dato->estado == 1) echo " SELECTED";?> value="1">Activo</option>
            <option<?php if(@$dato->estado == 0) echo " SELECTED";?> value="0">Inactivo</option>
        </select>
      </div>
    </div>

    <div class="fondo-botones">
      <div class="btn-group">
        <!--<input type="submit" value="Enviar">-->
        <button type="submit">Crear ficha clínica</button>
      </div>
    </div>
  </fieldset>
  </form>
</div>


