<!--[if !IE]><!-->
<style type="text/css">
@media (max-width: 767px) {
td:nth-of-type(1):before { content: "Nombre";}
td:nth-of-type(1):before { content: "RUT";}
td:nth-of-type(3):before { content: " ";}
}
</style>
<!--<![endif]-->
<?php //if($this->permisos->agregar){ ?>
    <span class="pull-right" style="margin-top:20px;"><a class="btn btn-success" href="/mantenedores/usuarios/administrar/">Agregar Usuario</a></span>
<?php //} ?>
<h1>Usuarios</h1>
<form action="/mantenedores/usuarios/" method="get" class="well">
    <fieldset class="row">
        <div class="col-sm-4 col-md-3 col-lg-2">
            <div class="form-group">
                <input class="form-control" placeholder="RUT" type="text" name="rut" value="<?php echo ($rut_f)?formatearRut($rut_f):'';?>" />
            </div>
        </div>
    
        <div class="col-sm-4 col-md-3 col-lg-2">
            <div class="form-group">
                <input class="form-control" placeholder="Nombre/ Apellido" type="text" name="q" value="<?php echo $q; ?>" />
            </div>
        </div>
    
        <div class="col-sm-4 col-md-3 col-lg-2">
            <div class="form-group">
                <select name="perfil" id="perfil" class="selectpicker" tabindex="">
                    <option value="">Seleccione</option>
                    <?php if($perfiles){ ?>
                        <?php foreach($perfiles as $aux){ ?>
                            <?php
                                $selected = '';
                                if($perfil_f == $aux->codigo)
                                    $selected = 'selected';
                                
                            ?>
                            <option <?php echo $selected; ?> value="<?php echo $aux->codigo; ?>"><?php echo $aux->nombre; ?></option>
                        <?php } ?>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-sm-12 col-md-3 col-lg-6 text-right">
            <input type="submit" value="Filtrar" class="btn btn-primary" />
        </div>
    </fieldset>
</form>

<div class="tabla-responsiva">
    <table class="table table-hover table-striped table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Perfil</th>
                <th>Estado</th>
                <?php //if($this->permisos->editar || $this->permisos->eliminar){ ?>
                    <th>&nbsp;</th>
                <?php //} ?>
            </tr>
        </thead>
        <tbody>
            <?php if($datos){ ?>
                <?php foreach($datos as $aux){ ?>
                                <?php foreach($perfiles as $per){ ?>
                                                        <?php if($aux->perfil==$per->codigo){ ?>


                    <tr id="eliminar-<?php echo $aux->codigo; ?>">
                        <td><?php echo $aux->nombre;?></td>
                        <td><?php echo $aux->primer_apellido ?></td>
                        <td><?php echo $aux->email; ?></td>
                        <td><?php echo $per->nombre; ?></td>


                        <!--<td><?php echo formatearRut($aux->rut,true); ?></td>-->
                        <td><?php echo ($aux->estado)?'Activo':'Inactivo'; ?></td>
                        <?php //if($this->permisos->editar || $this->permisos->eliminar){ ?>
                            <td class="text-center white-space editar-iconos">
                                <ul class="list-unstyled">
                                    <?php //if($this->permisos->editar){ ?>
                                        <li><a href="/mantenedores/usuarios/administrar/<?php echo $aux->codigo; ?>/" title="Editar"><i class="fa fa-edit" aria-hidden="true"></i></a></li>
                                    <?php //} ?>
                                    <?php // if($this->permisos->eliminar){ ?>
                                        <li><a href="#" class="eliminar" rel="<?php echo $aux->codigo; ?>" title="Eliminar"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                    <?php //} ?>
                                </ul>
                            </td>
                        <?php //} ?>
                    </tr>
                                    <?php } ?>
                        <?php }?>

                <?php } ?>
            <?php }else{ ?>
                <tr style="text-align: center;">
                    <td colspan="3">No hay registros</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<div class="text-right">
    <?php echo $pagination; ?>
</div>

  <script src = "js / jquery.validationEngine.min.js" type = "text / javascript" charset = "utf-8"> </ script> 
