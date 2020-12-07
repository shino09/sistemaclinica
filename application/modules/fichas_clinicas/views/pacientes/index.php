<div class="navegacion">
  <div class="center">
    <?=$this->layout->getNav();?>
  </div>
</div>


<div class="center">
  <h2>Pacientes</h2>


        <form action="#" id="form-filtro" name="form-filtro" class="form-horizontal" method="post">
              <div class="filtros1 filtros-fichas_clinicas"> <span style="margin-right: 20px;">Filtrar por:</span>

                 <div>
                          <label>Centro Medico:</label>

                   <select id="centro_medico"  name="centro_medico">
                    <option value="all">Todos los centros</option>
                     <?php if($rel2){ ?>
                          <?php foreach($rel2 as $aux){ ?>
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


                    <!--  <div>
                   <select id="unidad"  name="unidad">
                    <option value="">Seleccione</option>
                     <?php if($rel){ ?>
                          <?php foreach($rel as $aux){ ?>
                              <?php
                                  $selected = '';
                                  if($unidad_f == $aux->codigo)
                                      $selected = 'selected';
                              ?>
                              <option <?php echo $selected; ?> value="<?php echo $aux->codigo; ?>"><?php echo $aux->unidad; ?></option>
                          <?php } ?>
                      <?php } ?>
                   </select>
                </div>-->

                
                <div>
                              <label>Unidad:</label>

                   <select id="unidad"  name="unidad">
                    <option value="all">Todas las Unidades</option>
                     <?php if($rel6){ ?>
                          <?php foreach($rel6 as $aux){ ?>
                              <?php
                                  $selected = '';
                                  if($unidad_f == $aux->codigo)
                                      $selected = 'selected';
                              ?>
                              <option <?php echo $selected; ?> value="<?php echo $aux->codigo; ?>"><?php echo $aux->nombre; ?></option>
                          <?php } ?>
                      <?php } ?>
                   </select>
                </div>


                     



                    <div>
                              <label>Equipos:</label>

                   <select id="equipo"  name="equipo">
                    <option value="all">Todos los equipos</option>
                     <?php if($rel3){ ?>
                          <?php foreach($rel3 as $aux){ ?>
                              <?php
                                  $selected = '';
                                  if($equipo_f == $aux->codigo)
                                      $selected = 'selected';
                              ?>
                              <option <?php echo $selected; ?> value="<?php echo $aux->codigo; ?>"><?php echo $aux->nombre; ?></option>
                          <?php } ?>
                      <?php } ?>
                   </select>
                </div>

          

                <div>
                          <label>Estado:</label>

                    <select id="estado" name="estado" >
                        <option value="all">Todos los estados</option>

                        <option value="0"  >Inactivo</option>
                        <option value="1" >Activo</option>
                    </select>
                </div>
                <!--<div>
                        <label>Nombre:</label>

                  <input type="text"    class="form-control" id="busqueda" name="fichas_clinicas" placeholder="Nombre Paciente" value="<?php echo $pacientes_f; ?>" />
                </div>-->
                <div>
                    <button type="submit" id="filtrar" class="btn btn-success">Filtrar</button>
                </div>
              </div>

  <div class="clear"></div>

        <div class="filtros2">
    <div> <i class="fa fa-calendar"></i>
      <input type="text" value="Desde" id="datepicker" name="fecha_desde"/>
    </div>
    <div> <i class="fa fa-calendar"></i>
      <input type="text" value="Hasta" id="datepicker_2" name="fecha_hasta" />
    </div>
    <div>
                    <button type="submit" id="filtrar" class="btn btn-success">Filtrar</button>
    </div>
  </div>
          </form>

 <span class="clear"></span>


   <!--
   <div>
        <label>Desde: </label>
        <input type="text" id="datepicker" name="fecha_desde" />
        <i class="fa fa-calendar"></i> </div>


   <div>
        <label>Hasta: </label>
        <input type="text" id="datepicker_2" name="fecha_hasta" />
        <i class="fa fa-calendar"></i> </div>-->

  <div class="contenedor-tabla"> 
    <a href="/fichas_clinicas/pacientes/exportar_pacientes"><button class="btn-exportar-tabla">Exportar a excel</button></a>

  <table class="table table-hover table-striped table-bordered">
    <thead>
      <tr>
        <th>Centro Medico </th>
        <th>Unidad</th>
        <th>Nº Cama</th>
        <th>Nombre Completo </th>
        <th>RUT</th>
        <th>Edad</th>
        <th>Fecha de ingreso</th>
        <th>Diagnostico</th>
        <th>Equipos</th>
        <th>Insumos</th>
        <th>Modo Ventilatorio</th>
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
         <td><?php  foreach($rel7 as $re7) {?>
          <?php  foreach($rel6 as $re6) {?>
                    <?php  foreach($rel2 as $re2) {?>

            <?php  if($re7->codigo == $dato->ficha_clinica && $re7->unidad_2 ==   $re6->codigo && $re6->centro_medico ==   $re2->codigo) {?> <?=$re2->nombre?> <?php } ?><?php } ?><?php  }?><?php  }?></td>

                 <td><?php  foreach($rel7 as $re7) {?>
          <?php  foreach($rel6 as $re6) {?>
            <?php  if($re7->codigo == $dato->ficha_clinica && $re7->unidad_2 ==   $re6->codigo) {?> <?=$re6->nombre?> <?php } ?><?php  }?><?php  }?></td>

             <!-- <td <?php  foreach($rel6 as $re) {?>
            <?php  if($re->codigo ==   $dato->unidad) {?> ><?=$re->nombre?> <?php } ?><?php  }?></td>-->
 
                       <!--  <td <?php  foreach($rel6 as $re) {?>
            <?php  if($re->codigo ==   $dato->unidad) {?> ><?=$re->numero_cama?> <?php } ?><?php  }?></td>-->


                   <td><?php  foreach($rel7 as $re7) {?>
          <?php  foreach($rel6 as $re6) {?>
            <?php  if($re7->codigo == $dato->ficha_clinica && $re7->unidad_2 ==   $re6->codigo) {?> <?=$re6->numero_cama?> <?php } ?><?php  }?><?php  }?></td>


               <td><?php  foreach($rel7 as $re7) {?>
            <?php  if($re7->codigo == $dato->ficha_clinica ) {?> <?=$re7->nombre_completo?> <?php } ?><?php  }?></td>
                      <td><?php  foreach($rel7 as $re7) {?>
            <?php  if($re7->codigo == $dato->ficha_clinica ) {?> <?=$re7->rut_?> <?php } ?><?php  }?></td>
                      <td><?php  foreach($rel7 as $re7) {?>
            <?php  if($re7->codigo == $dato->ficha_clinica ) {?> <?=$re7->edad?> <?php } ?><?php  }?></td>
                     <!-- <td><?php  foreach($rel7 as $re7) {?>
            <?php  if($re7->codigo == $dato->ficha_clinica ) {?> <?=$re7->fecha_ingreso?> <?php } ?><?php  }?></td>-->
               <td> <?=$dato->fecha_ingreso?> </td>
                      <td><?php  foreach($rel7 as $re7) {?>
            <?php  if($re7->codigo == $dato->ficha_clinica ) {?> <?=$re7->diagnostico?> <?php } ?><?php  }?></td>

        <td>  <?php  foreach($rel3 as $re) {?>
          <?php  if($re->codigo ==   $dato->equipo) {?><?=$re->nombre?> <?php } ?><?php  }?></td>
                 <!--  <td>  <?php  foreach($rel4 as $re) {?>
           <?php  if($re->codigo ==   $dato->insumo) {?><?=$re->nombre?> <?php } ?><?php  }?></td>-->

           <td>    <span><a href="#" class="open">Insumos</a></span>
</td>
                   <td> <?php  foreach($rel5 as $re) {?>
            <?php  if($re->codigo ==   $dato->modo_ventilatorio_pc) {?><? echo $re->nombre ;?> <?php } ?>
             <?php if ( $re->codigo ==   $dato->modo_ventilatorio_vc) {?><? echo $re->nombre ;?> <?php } ?>
            <?php   if ($re->codigo ==   $dato->modo_ventilatorio_duales) {?><? echo $re->nombre ;?> <?php } ?>
             <?php    if ($re->codigo ==   $dato->modo_ventilatorio_otro)  {?><?echo $re->nombre;?> <?php } ?><?php  }?></td>
                


            <td><?php if($dato->estado == 1) echo "Activo"; else echo "Inactivo"; ?></td>
        <?php //if($this->permisos->editar || $this->permisos->eliminar){ ?>


        <?php //} ?>
      </tr>
    <?php endforeach;
  }else echo "<p>No hay datos registrados</p>";?>

    </tbody>
  </table>


  <div class="insumos" class="insumos"style="display: none;">
  <div class="content">
    <h3>Recuperar Contraseña</h3>
    <div><i class="fa fa-user"></i>
      <input type="text" placeholder="Ingrese su correo electrónico" />
    </div>
    <button class="btn-ingresar">Enviar contraseña nueva</button>
    <i class="fa fa-close close"></i> </div>
</div>

<div class="text-right">

     <?php echo $pagination; ?>

    
</div>

</div>

</div>



 
<!--<div class="container">
  <h2>Basic Modal Example</h2>
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>-->
 <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->

<script>
$(document).ready(function(){
    $(".close").click(function(){
        $(".insumos").fadeOut();
    });
    $(".open").click(function(){
        $(".insumos").fadeIn();
    });
});
</script>
 
<!--
 <script src = "js / jquery.validationEngine.min.js" type = "text / javascript" charset = "utf-8"> </ script> -->
