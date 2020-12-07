
<div class="navegacion">
  <div class="center">
    <?=$this->layout->getNav();?>
  </div>
</div>

<div class="center" style="position:relative;">
  
<?php if(!isset($dato->estado)) $dato->estado = 1; ?>
<h2><?php if($this->uri->segment(4)) echo "Editar"; else echo "Agregar";?>  datos tipo de control
</h2>

<?php if($this->uri->segment(4)){ ?>
<input type="hidden" name="codigo" id="codigo" value="<?=$this->uri->segment(4)?>"/>
<?php } ?>

<form  action="#" id="form" class="form-horizontal" method="post">

<fieldset>
    <div class="block-inputs">
      <div>
        <label>Nombre:</label>
        <input type="text" id="nombre" class="form-control validate[required]" name="tip_nombre" value="<?=@$dato->nombre?>" />
      </div>

      <div>
        <label>Descripción:</label>
        <input type="text" id="descripcion" class="form-control " name="tip_descripcion" value="<?=@$dato->descripcion?>" />
               <!-- <input type="text" id="descripcion" class="form-control validate[required]" name="tip_descripcion" value="<?=@$dato->descripcion?>" />-->

      </div>

     
    

      <label for="estado" class="col-sm-4 control-label">Estado:</label>
      <div class="col-sm-7">
        <select id="estado" class="form-control validate[required]" name="tip_estado">
            <option<?php if(@$dato->estado == 1) echo " SELECTED";?> value="1">Activo</option>
            <option<?php if(@$dato->estado == 0) echo " SELECTED";?> value="0">Inactivo</option>
        </select>
      </div>


       <!--<div>
        <label>Precio:</label>
        <input type="text" id="precio" class="form-control validate[required]" name="tip_precio" value="<?=@$dato->precio?>" />
      </div>-->



      <div>
      <input onclick="document.getElementById('tip_precio_manana').disabled=false;document.getElementById('tip_precio_tarde').disabled=false;document.getElementById('tip_precio_noche').disabled=false;" type="checkbox" name="tip_precio_radio" value="si" id="tip_precio_radio" />  Habilitar Precio:       
</div>
      <div>
                        <label>Precio Mañana:</label>

      <input type="text" id="tip_precio_manana" name="tip_precio_manana" placeholder="" disabled="true" value="<?=@$dato->precio_manana?>"/>
      </div>
      <div>
                        <label>Precio Tarde:</label>

      <input type="text" id="tip_precio_tarde" name="tip_precio_tarde" placeholder="" disabled="true" value="<?=@$dato->precio_tarde?>"/>
      </div>
       <div>
      <label> Precio Noche:</label>

      <input type="text" id="tip_precio_noche" name="tip_precio_noche" placeholder="" disabled="true" value="<?=@$dato->precio_noche?>"/>
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
      <h3>Agregar insumo tipo de control
</h3>



      <div>
        <label>Insumo: </label>
            <select id="tipo_insumo" class="form-control validate[required]" name="tipo_insumo">
          <option value="">Seleccione</option>
            <?php foreach($rel as $dat): ?>
            <option<?php if(@$dato->insumos == $dat->codigo) echo " SELECTED";?> value="<?=$dat->codigo?>"><?=$dat->nombre?></option>
          <?php endforeach; ?>
        </select>
        <input type="hidden" id="tipo_tipo_de_control" name="tipo_tipo_de_control" value="<?=$dato->codigo?>"/>
      </div>

              <div>
     
        <button type="submit">Agregar</button>
    </div>


  </fieldset>
  </form>
    
    <div class="contenedor-tabla">
      <table>
        <thead>
          <tr>
            <th scope="col">Nombre</th>
            <th scope="col"></th>
          </tr>
        </thead>

        <?php foreach($rel2 as $dat2){ ?>
        <?php foreach($rel as $dat){ ?>

        <?php if($dat2->insumo == $dat->codigo) { ?>
        <tbody>
          <tr id="eliminar-<?=$dat->codigo?>">
            <td data-label="Nombre"><?echo $dat->nombre?></td>
            <td>     <a  href="/mantenedores/tipos_de_control/eliminarstock/<?=$dat->codigo?>/" class="eliminar" rel="<?=$dat->codigo?>" title="Eliminar"><i class="fa fa-trash rojo" aria-hidden="true"></i></a></td>
          </tr>
        </tbody>
        <?php }?>
        <?php } ?>
        <?php } ?>


            
      </table>
    </div>


  <?php } ?>

  </div>


   <script src = "js / jquery.validationEngine.min.js" type = "text / javascript" charset = "utf-8"> </ script> 


