
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


        <!--<div class="form-group">
            <label for="rut" class="col-sm-4 control-label">RUT:</label>
                <input type="text" id="rut" class="form-control validate[required]" name="usu_rut" placeholder="XX.XXX.XXX-X" value="<?php echo (@$dato->rut)?formatearRut($dato->rut,true):'';?>" />
        </div>-->

  

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

   
           <!-- <label for="fecha_nacimiento" class="col-sm-8 control-label">Fecha de Nacimiento:</label>
                <div class="input-group date" >
                    <input id="fecha_nacimiento" class="form-control datepicker" type="text" name="usu_fecha_nacimiento" value="<?php echo (@$dato->fecha_nacimiento)?formatearFecha($dato->fecha_nacimiento,'','/'):'';?>" />
                    <div class="input-group-addon"> <span class="fa fa-calendar"></span> </div>
                </div>
     





       
            <label for="fecha_ingreso" class="col-sm-4 control-label">Fecha de Ingreso:</label>
                <div class="input-group date" >
                    <input id="fecha_ingreso" class="form-control datepicker" type="text" name="usu_fecha_ingreso" value="<?php echo (@$dato->fecha_ingreso)?formatearFecha($dato->fecha_ingreso,'','/'):'';?>" />
                    <div class="input-group-addon"> <span class="fa fa-calendar"></span> </div>
                </div>
       

     

        <div class="form-group">
            <label for="direccion" class="col-sm-4 control-label">Dirección:</label>
                <input type="text" id="direccion" class="form-control" placeholder="Calle" name="usu_direccion" value="<?php echo @$dato->direccion; ?>" />
        </div>

        <div class="form-group">
            <label for="direccion" class="col-sm-4 control-label"></label>
                <input type="text" id="nro" class="form-control" placeholder="Nro" name="usu_direccion_numero" value="<?php echo @$dato->direccion_numero; ?>" />
        </div>

        <div class="form-group">
            <label for="direccion" class="col-sm-4 control-label"></label>
                <input type="text" id="complemento_direccion" class="form-control" placeholder="Complemento dirección" name="usu_complemento_direccion" value="<?php echo @$dato->complemento_direccion; ?>" />
        </div>-->



       <!-- <div class="form-group">
            <label for="fono" class="col-sm-4 control-label">Fono:</label>
                <input type="text" id="fono" class="form-control" name="usu_telefono" value="<?=@$dato->telefono;?>" />
                <!--<input type="text" id="fono2" class="form-control" placeholder="Anexo" name="usu_anexo" value="<?=@$dato->anexo;?>" />
        </div>

        <div class="form-group">
            <label for="celular" class="col-sm-4 control-label">Celular:</label>
                <input type="text" id="celular" class="form-control" name="usu_celular" value="<?=@$dato->celular;?>" />
                <div class="text-right open-sans" style="padding-top:5px;"> <em>Ej: +56998765432</em> </div>
        </div>-->

            <div class="form-group">
            <label for="perfil" class="col-sm-4 control-label">Perfil de Usuario:</label>
       
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


