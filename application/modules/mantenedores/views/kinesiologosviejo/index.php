<!--[if !IE]><!-->

<div class="navegacion">
  <div class="center">
    <?=$this->layout->getNav();?>
  </div>
</div>





<div class="center">
  <h2>Kinesiologos</h2>
  <a href="/mantenedores/kinesiologos/administrar/"><button class="btn-agregar">Agregar nuevo centro</button></a>
  <div class="clear"></div>
      <form action="#" id="form-filtro" name="form-filtro" class="form-horizontal" method="post">

  <div class="filtros1 filtros-centro"> <span style="margin-right: 20px;">Filtrar por:</span>
    <div>
      <select>
        <option>Estado</option>
        <option>Activo</option>
        <option>Inactivo</option>
      </select>
    </div>
    <div>
      <!--<input type="text"  placeholder="Nombre"/>-->
      <input type="text" class="form-control" id="busqueda" name="kinesiologos" placeholder="Nombre Kinesiologo" value="<?php echo $kinesiologo_f; ?>" />
    </div>
    <div>
      <!--<button>Filtrar</button>-->
      <button type="submit" id="filtrar" class="btn btn-success">Filtrar</button>

    </div>
  </div>

<!--<div class="row">
    <form action="#" id="form-filtro" class="form-horizontal" method="post">
        <div class="col-lg-8">
            <div class="col-sm-5 col-md-5" style="margin-right:10px;">
                <div class="form-group">
                    <input type="text" class="form-control" id="busqueda" name="kinesiologos" placeholder="Nombre Kinesiologo" value="<?php echo $kinesiologo_f; ?>" />
                </div>


            </div>

         

            <div class="col-md-3">


            </div>
        </div>

        <div class="col-lg-4">


            <!--<div class="form-group">
                <div class="text-right col-sm-8 clear">
                    <ul class="list-inline">
                        <li>
                            <a href="/mantenedores/kinesiologos/"><button type="button" class="btn btn-success">Limpiar</button></a>
                        </li>
                        <li>
                            <button type="submit" id="filtrar" class="btn btn-success">Filtrar</button>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </form>
</div>-->

  <div class="contenedor-tabla"> 

  <table class="table table-hover table-striped table-bordered">
    <thead>
      <tr>
        <th>Nombre Servicio</th>
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
        <td><?php if($dato->estado == 1) echo "Activo"; else echo "Inactivo"; ?></td>
        <?php //if($this->permisos->editar || $this->permisos->eliminar){ ?>
            <td class="text-center white-space editar-iconos">
                <ul class="list-unstyled">
                    <?php //if($this->permisos->editar){ ?>
                        <a href="/mantenedores/kinesiologos/administrar/<?=$dato->codigo?>/" title="Editar"><i class="fa fa-edit" aria-hidden="true"></i></a>
                    <?php //} ?>
                    <?php //if($this->permisos->eliminar){ ?>
                      <a  href="/mantenedores/kinesiologos/eliminar/<?=$dato->codigo?>/" class="eliminar" rel="<?=$dato->codigo?>" title="Eliminar"><i class="fa fa-trash rojo" aria-hidden="true"></i></a>
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


  <!--<div class="text-right paginacion">
   <?php echo $pagination; ?>

  </div>-->
