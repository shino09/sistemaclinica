
<div class="navegacion">
  <div class="center">
    <?=$this->layout->getNav();?>
  </div>
</div>

<div class="center" style="position:relative;">

<?php if(!isset($dato->estado)) $dato->estado = 1; ?>
<h2><?php if($this->uri->segment(4)) echo "Editar"; else echo "Agregar";?> insumo</h2>

<?php if($this->uri->segment(4)){ ?>
<input type="hidden" name="codigo" id="codigo" value="<?=$this->uri->segment(4)?>"/>
<?php } ?>

<form  action="#" id="form" class="form-horizontal" method="post">

<fieldset>
    <div class="block-inputs">
      <div>
        <label>Nombre:</label>
        <input type="text" id="nombre" class="form-control validate[required]" name="ins_nombre" value="<?=@$dato->nombre?>" />
      </div>

        <label for="tipo" class="col-sm-4 control-label">tipo:</label>
        <div class="col-sm-7">
          <select id="tipo" class="form-control validate[required]" name="ins_tipo">
            <option<?php if(@$dato->tipo == 1) echo " SELECTED";?> value="1">Circuito</option>
            <option<?php if(@$dato->tipo == 2) echo " SELECTED";?> value="2">Filtro</option>
          </select>
        </div>
    
      <div>
        <label>Stock Alerta:</label>
        <input type="text" id="stock" class="form-control validate[required]" name="ins_stock_de_alerta" value="<?=@$dato->stock_de_alerta?>" />
      </div>

      <div>
        <label>Descripción:</label>
        <input type="text" id="descripcion" class="form-control validate[required]" name="ins_descripcion" value="<?=@$dato->descripcion?>" />
      </div>

      <div>
        <label>Precio:</label>
        <input type="text" id="precio" class="form-control validate[required]" name="ins_precio" value="<?=@$dato->precio?>" />
      </div>
    

      <label for="estado" class="col-sm-4 control-label">Estado:</label>
      <div class="col-sm-7">
        <select id="estado" class="form-control validate[required]" name="ins_estado">
            <option<?php if(@$dato->estado == 1) echo " SELECTED";?> value="1">Activo</option>
            <option<?php if(@$dato->estado == 0) echo " SELECTED";?> value="0">Inactivo</option>
        </select>
      </div>

      
    </div>
      <div class="fondo-botones">
        <div class="btn-group">
          <button type="submit">Guardar</button>
        </div>
      </div>
  </fieldset>
</form>
<?php if($this->uri->segment(4)){ ?>

<form  action="#" id="formstock" class="form-horizontal" method="post">

<fieldset>
    <div class="agregar-stock" style="position: relative;">
      <h3>Stock de insumos</h3>

            <input type="hidden" id="ins_stock_total" name="ins_stock_total"/>

            <input type="hidden" id="sto_insumo" name="sto_insumo" value="<?php echo $dato->codigo; ?>" />

      <div>
        <label>Fecha: </label>
        <input type="text" id="datepicker" name="sto_fecha_"/>
        <i class="fa fa-calendar"></i> </div>
      <div>
        <label>Cantidad: </label>
        <input type="text" id="nombre" class="form-control validate[required]" name="sto_cantidad" />      </div>
        <button type="submit">Agregar</button>
    </div>

  </fieldset>
  </form>
    
    <div class="contenedor-tabla">
      <table>
        <thead>
          <tr>
            <th scope="col">Fecha</th>
            <th scope="col">Cantidad</th>
            <th scope="col"></th>
          </tr>
        </thead>

        <?php foreach($rel as $dat){ ?>
        <?php if($dato->codigo == $dat->insumo) { ?>
        <tbody>
          <tr id="eliminar-<?=$dat->codigo?>">
            <td data-label="Fecha"><?echo $dat->fecha_?></td>
            <td data-label="Cantidad"> <?echo $dat->cantidad?></td>
            <input  type="hidden" id="ins_stock_total" name="ins_stock_total" value="<?php $dato->stock_total=$dato->stock_total + $dat->cantidad; ?>"/>
             <!--<input  type="hidden" id="ins_stock_total" name="ins_stock_total"/>-->

            <td>     <a  href="/mantenedores/insumos/eliminarstock/<?=$dat->codigo?>/" class="eliminar" rel="<?=$dat->codigo?>" title="Eliminar"><i class="fa fa-trash rojo" aria-hidden="true"></i></a></td>
          </tr>
        </tbody>
        <?php }?>
        <?php } ?>

              <input type="hidden" id="suma" name="suma" value="<?php echo $dato->stock_total ;?>"/>


      <p class="stock-insumos">Stock actual: <strong><?echo $dato->stock_total?></strong></p>

      </table>
    </div>

  <?php } ?>
  </div>


<!--<script type="text/javascript"> 

   $(document).ready(function(){
        var suma = $("#suma").val();

      $("#ins_stock_total").click(function(){
          $("#ins_stock_total").attr("value",suma);
      });
});
</script> -->
   <!--<script src = "js / jquery.validationEngine.min.js" type = "text / javascript" charset = "utf-8"> </ script> -->


