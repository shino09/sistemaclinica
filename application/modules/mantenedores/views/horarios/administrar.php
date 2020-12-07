

<div class="navegacion">
  <div class="center">
    <?=$this->layout->getNav();?>
  </div>
</div>

<div class="center" style="position:relative;">



<?php if(!isset($dato->estado)) $dato->estado = 1; ?>
<h2><?php if($this->uri->segment(4)) echo "Editar"; else echo "Agregar";?> horarios</h2>

<?php if($this->uri->segment(4)){ ?>
<input type="hidden" name="codigo" id="codigo" value="<?=$this->uri->segment(4)?>"/>
<?php } ?>
  <form  action="#" id="form" class="form-horizontal" method="post">

  <h2>Horarios</h2>
  <div class="horarios">
    <div div class="row1">
      <div>
        <p style="font-size:18px;">Mañana</p>
      </div>
              <label >Desde</label>

      <div>
        <input id="hor_manana_desde_" name="hor_manana_desde_" type="time" placeholder="Desde" min="00:00"
                                 max="12:00" value="<?=@$dato->manana_desde_?>" />
        <i class="fa fa-calendar"></i> </div>
                      <label >Hasta </label>

      <div>
        <input id="hor_manana_hasta" type="time" name="hor_manana_hasta" placeholder="Hasta" min="00:00"
                                 max="12:00" value="<?=@$dato->manana_hasta?>"/>
        <i class="fa fa-calendar"></i> </div>
                                              <label >Valor $</label>

      <div>
    <input id="hor_manana_valor" name="hor_manana_valor" class="form-control validate[required]"  type="text"   maxlength="13" onkeyup="format(this)" onchange="format(this)" value="<?php echo number_format($dato->manana_valor, 0, '', '.'); ?>"/>    </div>
    </div>
    <div div class="row1">
      <div>
        <p style="font-size:18px;">Tarde</p>
      </div>
                    <label >Desde </label>

      <div>
        <input id="hor_tarde_desde" name="hor_tarde_desde" type="time" placeholder="Desde" min="12:00"
                                 max="20:00"  value="<?=@$dato->tarde_desde?>" />
        <i class="fa fa-calendar"></i> </div>
                                      <label >Hasta </label>

      <div>
        <input id="hor_tarde_hasta" name="hor_tarde_hasta"  type="time" placeholder="Hasta" min="12:00"
                                 max="20:00" value="<?=@$dato->tarde_hasta?>" />
        <i class="fa fa-calendar"></i> </div>
                                              <label >Valor $</label>

      <div>


     <input id="hor_tarde_valor" name="hor_tarde_valor" class="form-control validate[required]"  type="text"   maxlength="13" onkeyup="format(this)" onchange="format(this)" value="<?php echo number_format($dato->tarde_valor, 0, '', '.'); ?>"/>   </div>
    </div>
    <div div class="row1">
      <div>
        <p style="font-size:18px;">Noche</p>
      </div>
                    <label >Desde </label>

      <div>
        <input id="hor_noche_desde"  name="hor_noche_desde" type="time"  placeholder="Desde" value="<?=@$dato->noche_desde?>" />
        <i class="fa fa-calendar"></i> </div>
                              <label >Hasta </label>

      <div>
        <input id="hor_noche_hasta"  name="hor_noche_hasta"  type="time"  placeholder="Hasta"     value="<?=@$dato->noche_hasta?>"      />
        <i class="fa fa-calendar"></i> </div>
                                                      <label >Valor $</label>

      <div>
        <input id="hor_noche_valor"  name="hor_noche_valor"  class="form-control validate[required]"  type="text"   maxlength="13" onkeyup="format(this)" onchange="format(this)" value="<?php echo number_format($dato->noche_valor, 0, '', '.'); ?>"/>

 </div>
    </div>
  </div>


     <div class="fondo-botones">
      <div class="btn-group">
        <!--<input type="submit" value="Enviar">-->
        <button type="submit">Guardar</button>
      </div>
    </div>
  </form>
</div>




<script>

function format(input)
{

    //obj = document.getElementById('hor_manana_valor');

    //alert(obj);

var num = input.value.replace(/\./g,'');

if(!isNaN(num)){
num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
num = num.split('').reverse().join('').replace(/^[\.]/,'');
input.value = num;
}
else{ 
input.value = input.value.replace(/[^\d\.]*/g,'');
}

}

</script>
     <script src = "js / jquery.validationEngine.min.js" type = "text / javascript" charset = "utf-8"> </ script> 
