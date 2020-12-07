<!--[if !IE]><!-->
<style type="text/css">
@media (max-width: 660px) {
td:nth-of-type(1):before { content: "Tipo"; }
td:nth-of-type(2):before { content: "Nombre"; }
td:nth-of-type(3):before { content: "Fecha"; }
td:nth-of-type(4):before { content: "Categoría"; }
td:nth-of-type(5):before { content: "Área"; }
td:nth-of-type(6):before { content: " "; }
}
</style>
<!--<![endif]-->
<div class="block-text"> <span class="pull-right mt20"><a class="btn btn-primary" href="/mantenedores/kinesiologos2/administrar/">Agregar nuevo</a></span>
  <h1><img src="/imagenes/sitio/icon-perfil.png" alt="kinesiologos2" width="44" height="44" /> kinesiologos2</h1>
  <div class="table-striped m30">
  <form  id="form-filtrar" class=" text-12">
      <fieldset>
        <ul class="list-inline">
          <li class="coll-meses" style="vertical-align:top;">
      
          </li>
          <li class="coll-meses" style="vertical-align:top;">
            <select id="estado" name="categorias" class="selectpicker">
              <option>Estado</option>
                            <option value="0" <?php if($estado==0) { ?> selected="selected" <?php } ?> >Inactivo</option>

              <option value="1" <?php if($estado==1) { ?> selected="selected"  <?php } ?>>Activo</option>
              <!--<option value="1">Activo</option>-->
            </select>
          </li>
          <li class="coll-search" style="vertical-align:top;">
            <div class="input-group">
              <input type="text" name="buscar" id="buscar" value="<?php $buscar ?>"  class="form-control" placeholder="Búsqueda" />
              <span class="input-group-btn">
              <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
              </span></div>
          </li>
          <li class="last-block">
            <input type="button" value="Filtrar" id="filtrar" class="btn btn-primary uppercase" />
          </li>
        </ul>
      </fieldset>
    </form>
  </div>
  <div class="tabla-responsiva">
    <table class="table">
      <thead>
        <tr class="">
          <td>Tipo</td>
          <td>Nombre</td>
          
          <td>Dirección</td>
          <td>&nbsp;</td>
        </tr>
      </thead>
      <tbody>
        <?php if(count(@$datos)>0){
         foreach($datos as $data): ?>
        <tr id="eliminar-<?=$data->codigo?>">
          <td class="bbl"><i class="fa fa-calendar"></i></td>
          <td><?=$data->nombre?></td>
        
          <td class="last-edit"><ul class="list-inline">
              <li class="h3 icon bbl"><a class="fa fa-edit" href="/mantenedores/kinesiologos2/administrar/<?=$data->codigo?>/"></a></li>
              <li class="h3 icon"><a class="fa fa-trash-o eliminar" rel="<?=$data->codigo?>" href="#"></a></li>
            </ul></td>
        </tr>
      <?php endforeach;
        }else echo "<p>No hay datos registrados</p>";?>

      </tbody>
    </table>
  </div>
  <div class="text-center">
    <?php echo $pagination; ?>
  </div>
</div>

<script type="text/javascript">
   
var buscar = $("#buscar").val();
document.getElementById("buscar").value = buscar;

var  estado = $("#estado").val();
document.getElementById("estado").value = estado;


      window.onload;



</script>

     <script src = "js / jquery.validationEngine.min.js" type = "text / javascript" charset = "utf-8"> </ script> 