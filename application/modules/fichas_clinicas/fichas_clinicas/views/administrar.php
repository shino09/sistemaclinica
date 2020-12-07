
<div class="navegacion">
  <div class="center">
    <?=$this->layout->getNav();?>
  </div>
</div>

<div class="center" style="position:relative;">

<?php if(!isset($dato->estado)) $dato->estado = 1; ?>
<h2><?php if($this->uri->segment(4)) echo "Editar"; else echo "Agregar";?> ficha_clinica</h2>

<?php if($this->uri->segment(4)){ ?>
<input type="hidden" name="codigo" id="codigo" value="<?=$this->uri->segment(4)?>"/>
<?php } ?>

<form  action="#" id="form" class="form-horizontal" method="post">

<fieldset>
    <div class="block-inputs">
      <div>
        <label>Nombre Completo:</label>
        <input type="text" id="nombre" class="form-control validate[required]" name="fic_nombre" value="<?=@$dato->nombre?>" />
      </div>

       <div>
        <label>Rut:</label>
        <input type="text" id="nombre" class="form-control validate[required]" name="fic_nombre" value="<?=@$dato->nombre?>" />
      </div>

      <div>
        <label>Edad:</label>
        <input type="text" id="descripcion" class="form-control validate[required]" name="fic_descripcion" value="<?=@$dato->descripcion?>" />
      </div>

 <div>
        <label>Diagnostico:</label>
        <input type="text" id="nombre" class="form-control validate[required]" name="fic_nombre" value="<?=@$dato->nombre?>" />
      </div> <div>
        <label>Numero de ficha:</label>
        <input type="text" id="nombre" class="form-control validate[required]" name="fic_nombre" value="<?=@$dato->nombre?>" />
      </div>
       <div>
        <label>Peso:</label>
        <input type="text" id="nombre" class="form-control validate[required]" name="fic_nombre" value="<?=@$dato->nombre?>" />
      </div>
       <div>
        <label>Talla:</label>
        <input type="text" id="nombre" class="form-control validate[required]" name="fic_nombre" value="<?=@$dato->nombre?>" />
      </div>
     

      <label for="estado" class="col-sm-4 control-label">Unidad:</label>
      <div class="col-sm-7">
        <select id="estado" class="form-control validate[required]" name="fic_estado">
            <option<?php if(@$dato->unidad == 2) echo " SELECTED";?> value="2">UCI PEDRIATICA</option>

            <option<?php if(@$dato->unidad == 1) echo " SELECTED";?> value="1">NEONATOLOGIA UCI/INTERMEDIO</option>
            <option<?php if(@$dato->unidad == 0) echo " SELECTED";?> value="0">UNIDAD CORONARIA</option>
        </select>
      </div>

    

      <label for="estado" class="col-sm-4 control-label">Estado:</label>
      <div class="col-sm-7">
        <select id="estado" class="form-control validate[required]" name="fic_estado">
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
      <h3>Insumos</h3>



      <div>
        <label>Cantidad: </label>
            <select id="tipo_insumo" class="form-control validate[required]" name="tipo_insumo">
          <option value="">Seleccione</option>
            <?php foreach($rel as $dat): ?>
            <option<?php if(@$dato->insumos == $dat->codigo) echo " SELECTED";?> value="<?=$dat->codigo?>"><?=$dat->nombre?></option>
          <?php endforeach; ?>
        </select>
        <input type="hidden" id="tipo_ficha_clinica" name="tipo_ficha_clinica" value="<?=$dato->codigo?>"/>
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
            <td>     <a  href="/fichas_clinicas/fichas_clinicas/eliminarstock/<?=$dat->codigo?>/" class="eliminar" rel="<?=$dat->codigo?>" title="Eliminar"><i class="fa fa-trash rojo" aria-hidden="true"></i></a></td>
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


