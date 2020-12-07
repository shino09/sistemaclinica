
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

<fieldset>
        <div class="block-inputs">
            <div style="width:50%; float:left;">


 <div class="form-group">
            <label for="rut" class="col-sm-4 control-label">RUT:</label>
                <input type="text" id="rut" class="form-control validate[required]" name="usu_rut" placeholder="XX.XXX.XXX-X" value="<?php echo (@$dato->rut)?formatearRut($dato->rut,true):'';?>" />
        </div>

        <div class="form-group">
            <label for="nombres" class="col-sm-4 control-label">Nombre(s):</label>
                <input type="text" id="nombres" class="form-control validate[required]" name="usu_nombre" value="<?=@$dato->nombre?>" />
        </div>


        <div class="form-group">
            <label for="apellido_p" class="col-sm-4 control-label">Primer apellido:</label>
                <input type="text" id="apellido_p" class="form-control validate[required]" name="usu_primer_apellido" value="<?=@$dato->primer_apellido; ?>" />
        </div>

        <div class="form-group">
            <label for="apellido_m" class="col-sm-4 control-label">Segundo apellido:</label>
                <input type="text" id="apellido_m" class="form-control validate[required]" name="usu_segundo_apellido" value="<?=@$dato->segundo_apellido; ?>" />
        </div>



      <label for="estado" class="col-sm-4 control-label">Estado:</label>
      <div class="col-sm-7">
        <select id="estado" class="form-control validate[required]" name="equ_estado">
            <option<?php if(@$dato->estado == 1) echo " SELECTED";?> value="1">Activo</option>
            <option<?php if(@$dato->estado == 0) echo " SELECTED";?> value="0">Inactivo</option>
        </select>
      </div>



      <!--<label for="perfil" class="col-sm-4 control-label">Perfil de Usuario:</label>
      <div class="col-sm-7">
            <select id="perfil" name="usu_perfil" class="selectpicker">
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
      </div>-->
   
            <div class="form-group">
            <label for="perfil" class="col-sm-4 control-label">Perfil de Usuario:</label>
       
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


</div>
<div style="width:50%; float:left;">

        <div class="form-group">
            <label for="email" class="col-sm-4 control-label">Email:</label>
                <input type="text" id="email" class="form-control" name="usu_email" value="<?=@$dato->email;?>" />
            </div>

          <?php if(!$this->uri->segment(4)){ ?>
            <div class="form-group">
                <label for="password" class="col-sm-4 control-label">Contraseña:</label>
                    <input type="password" id="password" class="form-control" name="usu_contrasena" />
            </div>
        <?php }else{ ?>
            <fieldset style="display: none;" class="cont-cambiar-contrasena">
                <div class="form-group">
                    <label for="password" class="col-sm-4 control-label">Contraseña:</label>
                        <input type="password" id="password" class="form-control" name="usu_contrasena" />
                </div>

                <div class="form-group">
                    <label for="password" class="col-sm-4 control-label" style="visibility: hidden;">oculto</label>
                        <a href="#" class="cambiar-contrasena">Cancelar</a>
                </div>
            </fieldset>

            <fieldset class="cont-cambiar-contrasena">
                <div class="form-group">
                    <label for="password" class="col-sm-4 control-label" style="visibility: hidden;">oculto</label>
                        <a href="#" class="cambiar-contrasena">Cambiar contraseña</a>
                </div>
            </fieldset>
        <?php } ?>

        <div class="panel panel-default">
            <div class="panel-heading text-center"> <strong>Imagen Usuario</strong></div>
            <div class="panel-body text-center">
                <label for="subir_imagen">Subir Imagen</label>
                <input style="margin-bottom:10px;" id="subir_imagen" class="nicefileinput nice" type="file" name="imagen" />
                <?php if(@$dato->imagen){ ?>
                    <div>
                        <a href="/mantenedores/usuarios/descargar_archivo/<?php echo $dato->codigo; ?>/1/">Descargar Imagen</a>
                        <span><a style="color: red;" href="#" class="eliminar_archivo" rel="<?php echo $dato->codigo.'-1'; ?>" title="Eliminar"><i class="fa fa-trash" aria-hidden="true"></i></a></span>
                    </div>
                <?php } ?>
            </div>
        </div>
</div>


</div>
     <div class="pp-tb"></div>
    <fieldset class="col-sm-12 well text-center">
        <a href="/mantenedores/usuarios/"><input type="button" value="Cancelar" class="btn btn-default" /></a>
        <input type="submit" value="Guardar Cambios" class="btn btn-success" />
    </fieldset>
</form>
<?php if($this->uri->segment(4)){ ?>
    <input type="hidden" id="codigo" value="<?php echo $this->uri->segment(4); ?>" />
<?php } ?>


  <script src = "js / jquery.validationEngine.min.js" type = "text / javascript" charset = "utf-8"> </ script> 


