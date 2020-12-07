<div class="navegacion">
  <div class="center">
    <?=$this->layout->getNav();?>
  </div>
</div>
<div class="center" style="position:relative;">
  <h2>Mi Perfil</h2>
  <form>
    <div class="block-inputs">

     
      <div><strong>Nombre: </strong> <?=@$dato->nombre?>  </div>
      <div> <strong>Apellidos</strong> <?=@$dato->primer_apellido?></div>
      <div> <strong>Fecha Nacimiento:</strong> <?=@$dato->fecha_nacimiento?> </div>
      <div> <strong>Perfil:</strong> 

      
                    <?php if($perfiles){ ?>
                        <?php foreach($perfiles as $aux){ ?>
                            <?php if($dato->perfil == $aux->codigo) {?>
                              <?php echo $aux->nombre; ?>
                            <?php } ?>
                        <?php } ?>
                      <?php } ?>
                    </div>
         


          <div class="form-group">
            <label for="celular" class="col-sm-4 control-label">Celular:</label>
            <div class="col-sm-7">
                <input type="text" id="celular" class="form-control" name="usu_celular" value="<?=@$dato->celular;?>" />
                <div class="text-right open-sans" style="padding-top:5px;"> <em>Ej: +56998765432</em> </div>
            </div>
        </div>

        <div class="form-group">
            <label for="email" class="col-sm-4 control-label">Email:</label>
            <div class="col-sm-7">
                <input type="text" id="email" class="form-control" name="usu_email" value="<?=@$dato->email;?>" />
                        <a href="#" style="margin: 20px 0; display: block;">Cambiar contraseña</a>

            </div>
        </div>
     
     
    </div>


    <div class="subir-imagen">
      <p>Agregar fotografía</p>
      <label  for="subir_imagen" class="fileContainer"> <i class="fa fa-upload subir-img"></i> Subir imagen
<input value="<?=@$dato->imagen;?>"  style="margin-bottom:10px;" id="subir_imagen" class="nicefileinput nice" type="file" name="imagen" />      </label>
    </div>
    <div class="fondo-botones">
      <div class="btn-group">
        <button>Guardar Cambios</button>
      </div>
    </div>
  </form>
</div>
