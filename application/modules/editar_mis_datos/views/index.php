<div class="navegacion">
  <div class="center">
    <?=$this->layout->getNav();?>
  </div>
</div>
<div class="center" style="position:relative;">
  <h2>Mi Perfil</h2>
<form  action="#" class="form-horizontal" id="form" method="post" enctype="multipart/form-data">
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
            <label for="rut" class="col-sm-4 control-label">RUT:</label>
            <div class="col-sm-7">
                <input type="text" id="rut" class="form-control validate[required]" name="usu_rut" placeholder="XX.XXX.XXX-X" value="<?php echo (@$dato->rut)?formatearRut($dato->rut,true):'';?>"  readonly />
            </div>
        </div>

          <div class="form-group">
            <label for="celular" class="col-sm-4 control-label">Celular:</label>
            <div class="col-sm-7">
                <input type="text" id="celular" class="form-control" name="usu_celular" value="<?=@$dato->celular;?>" />
                <div class="text-right open-sans" style="padding-top:5px;"> <em>Ej: +56998765432</em> </div>
            </div>
        </div>

       <!-- <div class="form-group">
            <label for="email" class="col-sm-4 control-label">Email:</label>
            <div class="col-sm-7">
                <input type="text" id="email" class="form-control" name="usu_email" value="<?=@$dato->email;?>" />
                        <a href="#" style="margin: 20px 0; display: block;">Cambiar contraseña</a>

            </div>
        </div>-->


      <div class="form-group">
            <label for="email" class="col-sm-4 control-label">Email:</label>
            <div class="col-sm-7">
                <input type="text" id="email" class="form-control" name="usu_email" value="<?=@$dato->email;?>" />
            </div>
        </div>

        <fieldset style="display: none;" class="cont-cambiar-contrasena">
            <div class="form-group">
                <label for="password" class="col-sm-4 control-label">Contraseña:</label>
                <div class="col-sm-7">
                    <input type="password" id="password" class="form-control validate[required]" name="usu_contrasena" />
                </div>
            </div>
            
            <div class="form-group">
                <label for="re-password" class="col-sm-4 control-label">Repetir Contraseña:</label>
                <div class="col-sm-7">
                    <input type="password" id="re-password" class="form-control validate[required,equals[password]]" name="re_contrasena" />
                </div>
            </div>

            <div class="form-group">
                <label for="password" class="col-sm-4 control-label" style="visibility: hidden;">oculto</label>
                <div class="col-sm-7">
                    <a href="#" class="cambiar-contrasena">Cancelar</a>
                </div>
            </div>
        </fieldset>

        <fieldset class="cont-cambiar-contrasena">
            <div class="form-group">
                <label for="password" class="col-sm-4 control-label" style="visibility: hidden;">oculto</label>
                <div class="col-sm-7">
                    <a href="#" class="cambiar-contrasena">Cambiar contraseña</a>
                </div>
            </div>
        </fieldset>
     


        </div>

 <div class="panel panel-default">
            <div class="panel-heading text-center"> <strong>Imagen Uusario</strong></div>
            <div class="subir-imagen">
<label class="fileContainer" for="subir_imagen"> <i class="fa fa-upload subir-img"></i> Subir imagen                <input style="margin-bottom:10px;" id="subir_imagen" class="nicefileinput nice" type="file" name="imagen" />
                <?php if(@$dato->imagen){ ?>
                    <div><label class="fileContainer"> <i class="fa fa-upload subir-img"></i> Subir imagen
                        <a href="/mantenedores/usuarios/descargar_archivo/<?php echo $dato->codigo; ?>/1/">Descargar Imagen</a>
                        <span><a style="color: red;" href="#" class="eliminar_archivo" rel="<?php echo $dato->codigo.'-1'; ?>" title="Eliminar"><i class="fa fa-trash" aria-hidden="true"></i></a></span>
                    </div>
                <?php } ?>
            </div>
        </div>

   
    <div class="fondo-botones">
      <div class="btn-group">
        <button>Guardar Cambios</button>
      </div>
    </div>
  </form>
</div>

<script src = "js / jquery.validationEngine.min.js" type = "text / javascript" charset = "utf-8"> </ script> 


