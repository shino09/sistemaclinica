
<div class="navegacion">
  <div class="center">
    <?=$this->layout->getNav();?>
  </div>
</div>

<div class="center" style="position:relative;">

<?php if(!isset($dato->estado)) $dato->estado = 1; ?>
<h2><?php if($this->uri->segment(4)) echo "Editar"; else echo "Agregar";?> Centro médico</h2>

<?php if($this->uri->segment(4)){ ?>
<input type="hidden" name="codigo" id="codigo" value="<?=$this->uri->segment(4)?>"/>
<?php } ?>

<form  action="#" id="form" class="form-horizontal" method="post">

<fieldset>
    <div class="block-inputs">
      <div>
        <label>Nombre:</label>
        <input type="text" id="nombre" class="form-control validate[required]" name="cen_nombre" value="<?=@$dato->nombre?>" />
      </div>

       <!--<div>
        <label>Tipo:</label>
        <input type="text" id="tipo" class="form-control validate[required]" name="cen_tipo_1" value="<?=@$dato->tipo_1?>" />
      </div>-->


       <div>
        <label>Dirección:</label>
        <input type="text" id="cen_direccion" class="form-control validate[required]" name="cen_direccion" value="<?=@$dato->direccion?>" />
      </div>


       <div>
        <label>Telefono:</label>
        <input type="text" id="cen_telefono" class="form-control validate[required]" name="cen_telefono" value="<?=@$dato->telefono?>" />
      </div>
    
    

      <label for="estado" class="col-sm-4 control-label">Estado:</label>
      <div class="col-sm-7">
        <select id="estado" class="form-control validate[required]" name="cen_estado">
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

<?php if($this->uri->segment(4)){ ?>

<form  action="#" id="form-unidad" class="form-horizontal" method="post">

<fieldset>
    <div class="agregar-stock" style="position: relative;">
      <h3>Agregar Unidades</h3>

        <input type="hidden" id="unid_centro_medico" name="unid_centro_medico" value="<?=$this->uri->segment(4)?>"/>

      <div>
        <label>Nombre: </label>
        <input type="text" id="unid_nombre" name="unid_nombre" />
      </div>
        <div>
        <label>Nº Camas: </label>
        <input type="text" id="unid_nombre" name="unid_numero_cama" />
      </div>

    <div class="agregar-unidades">
     
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

        <?php if($rel){ ?>

        <?php foreach($rel as $re){ ?>

        <?php if($dato->codigo == $re->centro_medico) { ?>
        <tbody>
          <input type="hidden" id="agregado" name ="agregado">
          <tr id="eliminarunidad-<?=$re->codigo?>">
            <td data-label="Nombre"><?echo $re->nombre?></td>
                        <td data-label="Numero cama"><?echo $re->numero_cama?></td>

            <td>     <a  href="/mantenedores/centro_medico/eliminarunidad/<?=$re->codigo?>/" class="eliminarunidad" rel="<?=$re->codigo?>" title="Eliminar"><i class="fa fa-trash rojo" aria-hidden="true"></i></a></td>
          </tr>
        </tbody>
        <?php }?>
        <?php } ?>
                <?php } ?>

     


            
      </table>

</div>
  <?php } ?>

  </div>
</div>


     <script src = "js / jquery.validationEngine.min.js" type = "text / javascript" charset = "utf-8"> </ script> 