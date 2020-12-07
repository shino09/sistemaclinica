<div class="navegacion">
  <div class="center">
    <?=$this->layout->getNav();?>
  </div>
</div>
<div class="center" style="position:relative;">

  <?php if(!isset($dato->estado)) $dato->estado = 1; ?>
<h2><?php if($this->uri->segment(4)) echo "Editar"; else echo "Agregar";?> usuario</h2>

<?php if($this->uri->segment(4)){ ?>
<input type="hidden" name="codigo" id="codigo" value="<?=$this->uri->segment(4)?>"/>
<?php } ?>

<form  action="#" id="form" class="form-horizontal" method="post">
    <div class="block-inputs">
        <div>
        <label>Rut:</label>
                <input type="text" id="usu_rut" class="form-control validate[required]" name="usu_rut" value="<?=@$dato->rut?>" />
    </div>
      <div>
        <label>Nombre:</label>
                <input type="text" id="nombres" class="form-control validate[required]" name="usu_nombre" value="<?=@$dato->nombre?>" />
    </div>
      <div>
        <label>Apellidos:</label>
   <input type="text" id="apellido_p" class="form-control validate[required]" name="usu_primer_apellido" value="<?=@$dato->primer_apellido; ?>" />      </div>
      <div>
        <label>Email:</label>
                <input type="text" id="email" class="form-control" name="usu_email" value="<?=@$dato->email;?>" />
      </div>
      <div>
        <label>Contraseña:</label>
                    <input type="password" id="password" class="form-control" name="usu_contrasena" />
      </div>
      <div>
        <label>Repetir contraseña:</label>
                        <input type="password" id="password" class="form-control" name="usu_contrasena" />
      </div>
      <div>
        <label>Perfil:</label>
          <select id="perfil" name="usu_perfil" class="form-control validate[required]">
                    <option value="">Seleccione</option>
                    <?php if($perfiles){ ?>
                        <?php foreach($perfiles as $aux){ ?>
                            <?php
                                $selected = '';
                                if(@$dato->perfil){
                                    if($dato->perfil == $aux->codigo)
                                        $selected = 'selected';
                                }
                            ?>
                            <option <?php echo $selected; ?> value="<?php echo $aux->codigo; ?>"><?php echo $aux->nombre; ?></option>
                        <?php } ?>
                    <?php } ?>
                </select>
      </div>
      <div> <span>Estado:</span>
      <select id="estado" class="form-control validate[required]" name="usu_estado">
            <option<?php if(@$dato->estado == 1) echo " SELECTED";?> value="1">Activo</option>
            <option<?php if(@$dato->estado == 0) echo " SELECTED";?> value="0">Inactivo</option>
        </select>
    </div>
        <div class="subir-imagen">
        <p>Agregar fotografía</p>
      <label class="fileContainer"> <i class="fa fa-upload subir-img"></i>
      Subir imagen
                <input  id="subir_imagen" type="file" name="imagen" />
                  </label>
    </div>




    <div class="fondo-botones">
      <div class="btn-group">
        <button>Crear</button>
      </div>
    </div>
  </form>
</div>
