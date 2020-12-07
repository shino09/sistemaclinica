<div class="navegacion">
  <div class="center">
    <?=$this->layout->getNav();?>
  </div>
</div>

<div class="center">
  <h2>Usuarios</h2>
  <a href="/mantenedores/usuarios/administrar/"><button class="btn-agregar">Agregar nuevo usuario</button></a>
  <div class="clear"></div>

       <!-- <form action="#" id="form-filtro" name="form-filtro" class="form-horizontal" method="post">-->
          <form action="/mantenedores/usuarios/" method="get" class="well">

              <div class="filtros1 filtros-usuarios"> <span style="margin-right: 20px;">Filtrar por:</span>

                <div>
                    <select name="perfil" id="perfil" >
                    <option value="">Perfil</option>
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


                  

                <div>
                               <input class="form-control" placeholder="RUT" type="text" name="rut" value="<?php echo ($rut_f)?formatearRut($rut_f):'';?>" />


                </div>

                 <div>
                    <select id="estado" name="estado" >
                                          <option value="">Estado</option>

                                              <option value="1"  >Activo</option>

                        <option value="0"  >Inactivo</option>
                    </select>
                </div>
                <div>
                              <input class="form-control" placeholder="Nombre" type="text" name="q" value="<?php echo $q; ?>" />

                </div>
                <div>
                    <button type="submit" id="filtrar" class="btn btn-success">Filtrar</button>
                </div>
              </div>

        </form>
    
  <div class="contenedor-tabla"> 
    <table>
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
                                        <li><a href="/mantenedores/usuarios/administrar/<?php echo $aux->codigo; ?>/" title="Editar"><i class="fa fa-edit celeste" aria-hidden="true"></i></a></li>
                                    <?php //} ?>
                                    <?php // if($this->permisos->eliminar){ ?>
                                        <li><a href="#" class="eliminar" rel="<?php echo $aux->codigo; ?>" title="Eliminar"><i class="fa fa-trash rojo" aria-hidden="true"></i></a></li>
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

