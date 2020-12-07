<div class="navegacion">
  <div class="center">
    <?=$this->layout->getNav();?>
  </div>
</div>

<div class="center">
  <h2>Modos Ventilatorios</h2>
  <a href="/mantenedores/modos_ventilatorios/administrar/"><button class="btn-agregar">Agregar nuevo modo ventilatorio</button></a>
  <div class="clear"></div>


   
        <form action="#" id="form-filtro" name="form-filtro" class="form-horizontal" method="post">
                                    <div class="filtros1 filtros-modos_ventilatorios"> <span style="margin-right: 20px;">Filtrar por:</span>

                <div>

                    <!--<label for="estado" class="col-sm-4 control-label">Estado:</label>-->
                    <select id="estado" name="estado" >
                        <option value="0" <?php if($estado==0) ?> selected="selected">Inactivo</option>
                        <option value="1" <?php if($estado==1) ?> selected="selected">Activo</option>
                    </select>
                </div>
                <div>
                                        <!--<input type="text"   style="width:400px;" class="form-control" id="busqueda" name="modos_ventilatorios" placeholder="Nombre modo_ventilatorio" value="<?php echo $modo_ventilatorio_f; ?>" />-->

                    <input type="text"    class="form-control" id="busqueda" name="modos_ventilatorios" placeholder="Nombre " value="<?php echo $modo_ventilatorio_f; ?>" />
                </div>
                <div>
                    <button type="submit" id="filtrar" class="btn btn-success">Filtrar</button>
                </div>
                    </div>

        </form>
    
  <div class="contenedor-tabla"> 

  <table class="table table-hover table-striped table-bordered">
    <thead>
      <tr>
        <th>Nombre</th>
        <th>Tipo</th>
        <th>Estado</th>
        <?php //if($this->permisos->editar || $this->permisos->eliminar){ ?>
            <th>&nbsp;</th>
        <?php //} ?>
      </tr>
    </thead>
    <tbody>
      <?php if(count(@$datos)>0){
      foreach($datos as $dato):?>
      <tr id="eliminar-<?=$dato->codigo?>">
        <td><?=$dato->nombre?></td>
       <?php if($dato->tipo == 1) {?>  <td> <?php echo "Presión Control"; ?></td><?php } ?>

        <?php if($dato->tipo == 2) {?> <td> <?php echo "Volumen Control"; ?></td><?php } ?>

        <?php if($dato->tipo == 3){?>  <td> <?php echo "Modos Duales"; ?></td><?php } ?>



        <td><?php if($dato->estado == 1) echo "Activo"; else echo "Inactivo"; ?></td>
        <?php //if($this->permisos->editar || $this->permisos->eliminar){ ?>
            <td class="text-center white-space editar-iconos">
                <ul class="list-unstyled">
                    <?php //if($this->permisos->editar){ ?>
                        <a href="/mantenedores/modos_ventilatorios/administrar/<?=$dato->codigo?>/" title="Editar"><i class="fa fa-edit" aria-hidden="true"></i></a>
                    <?php //} ?>
                    <?php //if($this->permisos->eliminar){ ?>
                      <a  href="/mantenedores/modos_ventilatorios/eliminar/<?=$dato->codigo?>/" class="eliminar" rel="<?=$dato->codigo?>" title="Eliminar"><i class="fa fa-trash rojo" aria-hidden="true"></i></a>
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

