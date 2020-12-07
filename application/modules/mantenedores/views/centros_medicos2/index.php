
<style type="text/css">
@media (max-width: 767px) {
td:nth-of-type(1):before { content: "Nombre de cargo";}
td:nth-of-type(2):before { content: " ";}
}
</style>
<!--<![endif]-->
<?php //if($this->permisos->agregar){ ?>
<div class="pull-right" style="padding-top:20px;">
  <ul class="list-inline">
    <li style="margin-bottom:10px;"> <a class="btn btn-success" href="/mantenedores/centros_medicos/administrar/">Agregar Centro Medico</a> </li>
  </ul>
</div>
<?php //} ?>

<h1>Centros Medicos</h1>

<div class="pp-tb"></div>
<div class="tabla-responsiva">
  <table class="table table-hover table-striped table-bordered">
    <thead>
      <tr>
        <th>Nombre de centro Medico</th>
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
        <!--<?php //if($this->permisos->editar || $this->permisos->eliminar){ ?>-->
            <td class="text-center white-space editar-iconos"><ul class="list-unstyled">
                <?php //if($this->permisos->editar){ ?>
                    <li><a href="/mantenedores/centros_medicos/administrar/<?=$dato->codigo?>/" title="Editar"><i class="fa fa-edit" aria-hidden="true"></i></a></li>
                <?php //} ?>
                
                <?php //if($this->permisos->eliminar){ ?>
                    <?php if($dato->codigo != 1){ ?>
                        <li><a href="#" class="eliminar" rel="<?=$dato->codigo?>" title="Eliminar"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                    <?php }else{ ?>
                        <li><a style="color:#c1c1c1;" title="No Permitido"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                    <?php } ?>
                <?php //} ?>
              </ul>
            </td>
        <!--<?php// } ?>-->
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
