<div class="navegacion">
  <div class="center">
    <?=$this->layout->getNav();?>
  </div>
</div>


<div class="center">
  <h2>fichas_clinicas</h2>
  <a href="/fichas_clinicas/fichas_clinicas/administrar/"><button class="btn-agregar">Agregar nuevo centro</button></a>
  <div class="clear"></div>

        <form action="#" id="form-filtro" name="form-filtro" class="form-horizontal" method="post">
              <div class="filtros1 filtros-fichas_clinicas"> <span style="margin-right: 20px;">Filtrar por:</span>

                 <div>
                   <select id="centro_medico" class="form-control validate[required]" name="centro_medico">
                    <option value="">Seleccione</option>
                     <?php if($rel){ ?>
                          <?php foreach($rel as $aux){ ?>
                              <?php
                                  $selected = '';
                                  if($centro_f == $aux->codigo)
                                      $selected = 'selected';
                              ?>
                              <option <?php echo $selected; ?> value="<?php echo $aux->codigo; ?>"><?php echo $aux->nombre; ?></option>
                          <?php } ?>
                      <?php } ?>
                   </select>
                </div>

          

                <div>
                    <select id="estado" name="estado" >
                        <option value="0" <?php if($estado==0) ?> selected="selected">Inactivo</option>
                        <option value="1" <?php if($estado==1) ?> selected="selected">Activo</option>
                    </select>
                </div>
                <div>
                  <input type="text"    class="form-control" id="busqueda" name="fichas_clinicas" placeholder="Nombre Paciente" value="<?php echo $fichas_clinicas_f; ?>" />
                </div>
                <div>
                    <button type="submit" id="filtrar" class="btn btn-success">Filtrar</button>
                </div>
              </div>

        </form>

        <div class="contenedor-tabla" style="overflow-x:auto;"> 
    <a href="/fichas_clinicas/fichas_clinicas/exportar_fichas/"><button class="btn-exportar-tabla">Exportar a excel</button></a></div>
    
  <div class="contenedor-tabla"> 

  <table class="table table-hover table-striped table-bordered">
    <thead>
      <tr>
        <th>Centro médico </th>
        <th>Unidad</th>
        <th>Fecha de Ingreso</th>
        <th>Hora</th>
        <th>Nombre Completo </th>
        <th>RUT</th>
        <th>Estado</th>
        <?php //if($this->permisos->editar || $this->permisos->eliminar){ ?>
            <th>&nbsp;</th>
        <?php //} ?>
      </tr>
    </thead>
    <tbody>
      <?php /*print_array ($datos);die('sdsdfsd');*/if(count(@$datos)>0){
      foreach($datos as $dato):?>
      <tr id="eliminar-<?=$dato->codigo?>">
       <td>  
                    <?php  foreach($rel3 as $re3) {?>
              <?php  foreach($rel as $re) {?>
            <?php  if($re3->codigo == $dato->unidad_2 && $re->codigo ==   $re3->centro_medico) {?> <?=$re->nombre?> <?php } ?><?php  }?><?php  }?></td>
            
            <td>  
            <?php  foreach($rel3 as $re3) {?>
            <?php  if ($re3->codigo == $dato->unidad_2) {?> <?=$re3->nombre?> <?php } ?><?php  }?></td>

            <!--<td><?php if($dato->unidad == 2) { ?> <?php  echo 'UCI PEDRIATICA';  ?><?php }?>
           <?php if($dato->unidad == 1) { ?> <?php  echo 'NEONATOLOGIA UCI/INTERMEDIO';  ?><?php }?>
           <?php if($dato->unidad == 0) { ?> <?php  echo 'UNIDAD CORONARIA';  ?><?php }?></td>-->
            <td><?=$dato->fecha_ingreso?></td>
            <td><?=$dato->hora_ingreso?></td>
            <td><?=$dato->nombre_completo?></td>
            <td><?=$dato->rut_?></td>

                <td>

                   <div>
                                  <input type="hidden" name="fic_codigo" class="fic_codigo" value="<?=$dato->codigo?>"/>

          <select name="fic_estado"  class="fic_estado" rel="<?=$dato->codigo?>" value="<?=$dato->estado?>" >

             <!--<select id="con_via_aerea"  name="con_via_aerea">-->
                        <!--  <option value="">Seleccione Estado</option>-->

              <option value="0" <?php if($dato->estado == 0){ echo 'SELECTED';} ?>>Inactivo</option>
                        <option value="1" <?php if($dato->estado == 1){ echo 'SELECTED';} ?>>Activo</option>

                          <!-- <option value="1">Activo</option>
            <option value="0">Inactivo</option>-->
          </select>
        </div>
                </td>


            <!--<td><?php if($dato->estado == 1) echo "Activo"; else echo "Inactivo"; ?></td>-->
           <!-- <td>   <form  action="#" id="form-estado" class="form-horizontal" method="post">
              <input type="hidden" name="fic_codigo" id="fic_codigo" value="<?=$dato->codigo?>"/>


              <select id="fic_estado" class="form-control " name="fic_estado">
            <option<?php if(@$dato->estado == 1) echo " SELECTED";?> value="1">Activo</option>
            <option<?php if(@$dato->estado == 0) echo " SELECTED";?> value="0">Inactivo</option>
        </select>
              <button type="submit">Cambiar Estado</button>

  </form>
</td>-->
        <?php //if($this->permisos->editar || $this->permisos->eliminar){ ?>

           

            <td class="text-center white-space editar-iconos">
                <ul class="list-unstyled">
                     <?php //if($this->permisos->editar){ ?>
                        <a href="/fichas_clinicas/control_operativo/administrar/<?=$dato->codigo?>/" title="Editar"><i class="fa fa-plus verde" aria-hidden="true"></i></a>
                    <?php //} ?>
                    <?php //if($this->permisos->editar){ ?>
                        <a href="/fichas_clinicas/estadia/<?=$dato->codigo?>/" title="Veer"><i class="fa fa-eye gris" aria-hidden="true"></i></a>
                    <?php //} ?>
                    <?php //if($this->permisos->editar){ ?>
                        <a href="/fichas_clinicas/fichas_clinicas/administrar/<?=$dato->codigo?>/" title="Editar"><i class="fa fa-edit" aria-hidden="true"></i></a>
                    <?php //} ?>
                    <?php //if($this->permisos->eliminar){ ?>
                      <a  href="/fichas_clinicas/fichas_clinicas/eliminar/<?=$dato->codigo?>/" class="eliminar" rel="<?=$dato->codigo?>" title="Eliminar"><i class="fa fa-trash rojo" aria-hidden="true"></i></a>
                    <?php //} ?>
                </ul>
            </td>
        <?php //} ?>
      </tr>
    <?php endforeach;
  }else echo "<p>No hay datos registrados</p>";?>

    </tbody>
  </table>
</div>
<div class="text-right">
  <?php echo $pagination; ?>
</div>


  

<script src = "js / jquery.validationEngine.min.js" type = "text / javascript" charset = "utf-8"> </ script> 

