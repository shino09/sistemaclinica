<div class="navegacion">
  <div class="center">
    <?=$this->layout->getNav();?>
  </div>
</div>

<div class="center">
  <h2>horarios</h2>
  <a href="/mantenedores/horarios/administrar/"><button class="btn-agregar">Agregar nuevo horario</button></a>
  <div class="clear"></div>

    
  <div class="contenedor-tabla"> 

  <table class="table table-hover table-striped table-bordered">
    <thead>
      <tr>
        <th>Mañana Desde</th>
        <th>Mañana Hasta</th>
        <th>Mañana Valor</th>
         <th>Tarde Desde</th>
        <th>Tarde Hasta</th>
        <th>Tarde Valor</th>
         <th>Noche Desde</th>
        <th>Noche Hasta</th>
        <th>Noche Valor</th>

        <?php //if($this->permisos->editar || $this->permisos->eliminar){ ?>
            <th>&nbsp;</th>
        <?php //} ?>
      </tr>
    </thead>
    <tbody>
      <?php if(count(@$datos)>0){
      foreach($datos as $dato):?>
      <tr id="eliminar-<?=$dato->codigo?>">
                <td><?=$dato->manana_desde_?></td>
                <td><?=$dato->manana_hasta?></td>
                <td><?=$dato->manana_valor?></td>
                <td><?=$dato->tarde_desde?></td>
                <td><?=$dato->tarde_hasta?></td>
                <td><?=$dato->tarde_valor?></td>
                <td><?=$dato->noche_desde?></td>
                <td><?=$dato->noche_hasta?></td>
                <td><?=$dato->noche_valor?></td>

          <?php //if($this->permisos->editar || $this->permisos->eliminar){ ?>
            <td class="text-center white-space editar-iconos">
                <ul class="list-unstyled">
                    <?php //if($this->permisos->editar){ ?>
                        <a href="/mantenedores/horarios/administrar/<?=$dato->codigo?>/" title="Editar"><i class="fa fa-edit" aria-hidden="true"></i></a>
                    <?php //} ?>
                    <?php //if($this->permisos->eliminar){ ?>
                      <a  href="/mantenedores/horarios/eliminar/<?=$dato->codigo?>/" class="eliminar" rel="<?=$dato->codigo?>" title="Eliminar"><i class="fa fa-trash rojo" aria-hidden="true"></i></a>
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

