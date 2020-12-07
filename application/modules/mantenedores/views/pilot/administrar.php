

<div class="navegacion">
  <div class="center">
    <?=$this->layout->getNav();?>
  </div>
</div>

<div class="center" style="position:relative;">

<?php if(!isset($dato->estado)) $dato->estado = 1; ?>
<h2><?php if($this->uri->segment(4)) echo "Editar"; else echo "Agregar";?> pilot</h2>

<?php if($this->uri->segment(4)){ ?>
<input type="hidden" name="codigo" id="codigo" value="<?=$this->uri->segment(4)?>"/>
<?php } ?>

<form  action="#" id="form" class="form-horizontal" method="post">

<fieldset>
    <div class="block-inputs">
      <div>
        <label>pilot_firstname::</label>
        <input type="text"  class="form-control validate[required]" name="pilot_firstname" id="pilot_firstname"  />
      </div>
        <div>
        <label>pilot_lastname:</label>
        <input type="text"  class="form-control validate[required]" name="pilot_lastname" id="pilot_lastname" />
      </div>
        <div>
        <label>pilot_phone:</label>
        <input type="text" class="form-control validate[required]" name="pilot_phone" id="pilot_phone" />
      </div>
        <div>
        <label>pilot_cellphone:</label>
        <input type="text"  class="form-control validate[required]" name="pilot_cellphone" id="pilot_cellphone" />
      </div>
        <div>
        <label>pilot_email:</label>
        <input type="text"  class="form-control validate[required]" name="pilot_email" id="pilot_email" />
      </div>
        <div>
        <label>pilot_notes:</label>
        <input type="text"  class="form-control validate[required]" name="pilot_notes" id="pilot_notes" />
      </div>
        <div>
        <label>pilot_contact_type_id:</label>
           <input type="radio" name="pilot_contact_type_id" id="pilot_contact_type_id" value="1" checked>1-Electronico
                      <br>
                      <input type="radio" name="pilot_contact_type_id" id="pilot_contact_type_id" value="2">2-Telefonico
                      <br>
                      <input type="radio" name="pilot_contact_type_id" id="pilot_contact_type_id" value="3">3-Entrevista
      </div>
        <div>
        <label>pilot_business_type_id:</label>
  <input type="radio" name="pilot_business_type_id" id="pilot_business_type_id" value="1" checked>1-Convencional
                      <br>
                      <input type="radio" name="pilot_business_type_id" id="pilot_business_type_id" value="2">2-Usado
                      <br>
                      <input type="radio" name="pilot_business_type_id" id="pilot_business_type_id" value="3">3-Plan de Ahorro      </div>
    



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