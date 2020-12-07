<div class="navegacion">
  <div class="center">
    <?=$this->layout->getNav();?>
  </div>
</div>


<div class="center">
  <h2>Estadia</h2>


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
                              <label>Nombre:</label>

              <input type="text"    class="form-control" id="nombre" name="nombre" placeholder="Nombre Paciente" />

                </div>

                     <div>
                              <label>Rut:</label>

              <input type="text"    class="form-control" id="rut" name="rut" placeholder="Rut Paciente"  />

                </div>

          

                <!--<div>
                        <label>Nombre:</label>

                  <input type="text"    class="form-control" id="busqueda" name="fichas_clinicas" placeholder="Nombre Paciente" value="<?php echo $estadia_f; ?>" />
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

  <div class="contenedor-tabla" style="overflow-x:auto;"> 
    <a href="/fichas_clinicas/estadia/exportar_estadia"><button class="btn-exportar-tabla">Exportar a excel</button></a>
      <table class="table table-hover table-striped table-bordered">

<thead>
          <?php $i=0;?>
<?php $k=count(@$datos);?>
        <?php while ($i <= $k) {?>



              <?php if ($i==0) {?>

        <th>ITEM</th>
  
            <?php  }?>
               <?php if ($i!=0) {?>

        <th>Dia<?php echo ': ';echo $i; ?></th>
  
              <?php  }?>
<?php $i++; ?>
            <?php  }?>

              </thead>

    <tbody>

      

                     <?php $i=0;?>
<?php $k=count(@$datos);?>
<?php if(count(@$datos)>0){ ?>

       <!-- <?php while ($i <= $k) {?>-->
               <tr><td>Codigo</td><?php foreach($datos as $dato){?><td><?php echo $dato->codigo;?></td><?php } ?></tr>

        <tr><td>Tipo Soporte</td><?php foreach($datos as $dato){?><td><?php echo $dato->tipo_de_soporte;?></td><?php } ?></tr>
        <tr><td>Equipo en Uso</td><?php foreach($datos as $dato){?><td><?php echo $dato->equipo;?></td><?php } ?></tr>
        <tr><td>Insumos</td><?php foreach($datos as $dato){?><td><?php echo $dato->insumo_filtro;?></td><?php } ?></tr>
       <tr><td>Vía Aerea</td><?php foreach($datos as $dato){?><td><?php echo $dato->via_aerea;?></td><?php } ?></tr>
        <tr><td>Frecuancia Cardiaca</td><?php foreach($datos as $dato){?><td><?php echo $dato->frecuencia_cardiaca;?></td><?php } ?></tr>
        <tr><td>Frecuencia Respiratoria</td><?php foreach($datos as $dato){?><td><?php echo $dato->frecuencia_respiratoria;?></td><?php } ?></tr>
        <tr><td>Presion Arterial Sistolica</td><?php foreach($datos as $dato){?><td><?php echo $dato->presion_sistolica;?></td><?php } ?></tr>
        <tr><td>Presion Arterial Diastolica</td><?php foreach($datos as $dato){?><td><?php echo $dato->presion_diastolica;?></td><?php } ?></tr>
        <tr><td>Presion Arterial Media</td><?php foreach($datos as $dato){?><td><?php echo $dato->presion_arterial_media;?></td><?php } ?></tr>
     <!--<tr><td>Saturacion Arterial</td><?php foreach($datos as $dato){?><td><?php echo $dato->tipo_de_soporte;?></td><?php } ?></tr>-->
        <tr><td>Saturacion Preductal</td><?php foreach($datos as $dato){?><td><?php echo $dato->saturacion_preductual;?></td><?php } ?></tr>
        <tr><td>Saturacion Post Ductal</td><?php foreach($datos as $dato){?><td><?php echo $dato->saturacion_postductual;?></td><?php } ?></tr>
        <tr><td>Modo Ventilatorio</td><?php foreach($datos as $dato){?><td><?php echo $dato->modo_ventilatorio_pc;?></td><?php } ?></tr>
        <tr><td>PIM/PMAX</td><?php foreach($datos as $dato){?><td><?php echo $dato->pimpmax_;?></td><?php } ?></tr>
        <tr><td>Presion Plateau</td><?php foreach($datos as $dato){?><td><?php echo $dato->presion_plateu;?></td><?php } ?></tr>
        <tr><td>Presion Media</td><?php foreach($datos as $dato){?><td><?php echo $dato->presion_media;?></td><?php } ?></tr>
        <tr><td>Insumos</td><?php foreach($datos as $dato){?><td><?php echo $dato->insumo_filtro;?></td><?php } ?></tr>
       <tr><td>Vía Aerea</td><?php foreach($datos as $dato){?><td><?php echo $dato->via_aerea;?></td><?php } ?></tr>
        <tr><td>PEEP</td><?php foreach($datos as $dato){?><td><?php echo $dato->peep;?></td><?php } ?></tr>
        <tr><td>Presion de Soporte</td><?php foreach($datos as $dato){?><td><?php echo $dato->presion_de_soporte;?></td><?php } ?></tr>
        <tr><td>Alarma Alta de Presion</td><?php foreach($datos as $dato){?><td><?php echo $dato->alarma_de_presion_alta;?></td><?php } ?></tr>
        <tr><td>Alarma Baja de Presion</td><?php foreach($datos as $dato){?><td><?php echo $dato->alarma_de_presion_baja;?></td><?php } ?></tr>
        <!--<tr><td>VC Programado</td><?php foreach($datos as $dato){?><td><?php echo $dato->tipo_de_soporte;?></td><?php } ?></tr>-->
        <tr><td>VC Inspirado</td><?php foreach($datos as $dato){?><td><?php echo $dato->vc_ins;?></td><?php } ?></tr>
        <tr><td>VC Espirado</td><?php foreach($datos as $dato){?><td><?php echo $dato->vc_esp;?></td><?php } ?></tr>
        <tr><td>Volumen Minuto</td><?php foreach($datos as $dato){?><td><?php echo $dato->v_min;?></td><?php } ?></tr>
        <tr><td>Alarma VMin Alta</td><?php foreach($datos as $dato){?><td><?php echo $dato->tipo_de_soporte;?></td><?php } ?></tr>
        <tr><td>Alarma VMin Baja</td><?php foreach($datos as $dato){?><td><?php echo $dato->tipo_de_soporte;?></td><?php } ?></tr>
           <tr><td>Alarma VC Alta</td><?php foreach($datos as $dato){?><td><?php echo $dato->alarma_de_volumen_corriente_alta;?></td><?php } ?></tr>
        <tr><td>Alarma VC Baja</td><?php foreach($datos as $dato){?><td><?php echo $dato->alarma_de_volumen_corriente_baja;?></td><?php } ?></tr>
        <!--<tr><td>Frecuencia Respiratoria VM</td><?php foreach($datos as $dato){?><td><?php echo $dato->tipo_de_soporte;?></td><?php } ?></tr>-->
        <!--<tr><td>Frecuencia Respiratoria Total</td><?php foreach($datos as $dato){?><td><?php echo $dato->tipo_de_soporte;?></td><?php } ?></tr>-->
        <!--<tr><td>Tiempo Inspiratorio</td><?php foreach($datos as $dato){?><td><?php echo $dato->tipo_de_soporte;?></td><?php } ?></tr>-->
       <tr><td>Relacion I:E</td><?php foreach($datos as $dato){?><td><?php echo $dato->relacion_ie;?></td><?php } ?></tr>
        <tr><td>Flujo Inspiratorio</td><?php foreach($datos as $dato){?><td><?php echo $dato->flujo_respiratorio;?></td><?php } ?></tr>
        <tr><td>Flujo Espiratorio</td><?php foreach($datos as $dato){?><td><?php echo $dato->flujo_espiatorio;?></td><?php } ?></tr>
        <tr><td>Tipo Humidificacion</td><?php foreach($datos as $dato){?><td><?php echo $dato->humidificacion;?></td><?php } ?></tr>
        <tr><td>Cambio Matraz</td><?php foreach($datos as $dato){?><td><?php echo $dato->cambio_matraz_llenado_camara_humidificacion;?></td><?php } ?></tr>
        <tr><td>pH</td><?php foreach($datos as $dato){?><td><?php echo $dato->tipo_de_soporte;?></td><?php } ?></tr>
        <tr><td>PaO2</td><?php foreach($datos as $dato){?><td><?php echo $dato->gases_arteriales_pao2;?></td><?php } ?></tr>
        <tr><td>PaCO2</td><?php foreach($datos as $dato){?><td><?php echo $dato->gases_arteriales_paco2;?></td><?php } ?></tr>
        <tr><td>HCO3</td><?php foreach($datos as $dato){?><td><?php echo $dato->gases_arteriales_hco3;?></td><?php } ?></tr>
        <tr><td>BE</td><?php foreach($datos as $dato){?><td><?php echo $dato->gases_arteriales_be;?></td><?php } ?></tr>
        <tr><td>FiO2 GSA</td><?php foreach($datos as $dato){?><td><?php echo $dato->gases_arteriales_fio2_gsa;?></td><?php } ?></tr>
        <tr><td>Pa/Fi</td><?php foreach($datos as $dato){?><td><?php echo $dato->tipo_de_soporte;?></td><?php } ?></tr>
        <tr><td>IOX</td><?php foreach($datos as $dato){?><td><?php echo $dato->gases_arteriales_iox;?></td><?php } ?></tr>
        <tr><td>EtCO2</td><?php foreach($datos as $dato){?><td><?php echo $dato->gases_arteriales_etco2;?></td><?php } ?></tr>
        <tr><td>HTC</td><?php foreach($datos as $dato){?><td><?php echo $dato->sangre_htc;?></td><?php } ?></tr>
        <tr><td>Hb</td><?php foreach($datos as $dato){?><td><?php echo $dato->sangre_hb;?></td><?php } ?></tr>
        <tr><td>GB</td><?php foreach($datos as $dato){?><td><?php echo $dato->sangre_gb;?></td><?php } ?></tr>
        <tr><td>Plaquetas</td><?php foreach($datos as $dato){?><td><?php echo $dato->sangre_plaqueta;?></td><?php } ?></tr>
        <tr><td>Na</td><?php foreach($datos as $dato){?><td><?php echo $dato->electrolito_na;?></td><?php } ?></tr>
        <tr><td>K</td><?php foreach($datos as $dato){?><td><?php echo $dato->electrolito_k;?></td><?php } ?></tr>
        <tr><td>Cl</td><?php foreach($datos as $dato){?><td><?php echo $dato->electrolito_cl;?></td><?php } ?></tr>
        <tr><td>Ca</td><?php foreach($datos as $dato){?><td><?php echo $dato->tipo_de_soporte;?></td><?php } ?></tr>
        <tr><td>P</td><?php foreach($datos as $dato){?><td><?php echo $dato->electrolito_p;?></td><?php } ?></tr>
        <tr><td>PCR</td><?php foreach($datos as $dato){?><td><?php echo $dato->inflamatorio_pcr;?></td><?php } ?></tr>
        <tr><td>Distensibilidad Dinamica</td><?php foreach($datos as $dato){?><td><?php echo $dato->pulmonar_distensibilidad_dinamica;?></td><?php } ?></tr>
        <tr><td>Distensibilidad Estática</td><?php foreach($datos as $dato){?><td><?php echo $dato->pulmonar_distensibilidad_estatica;?></td><?php } ?></tr>
        <tr><td>Resistencia</td><?php foreach($datos as $dato){?><td><?php echo $dato->pulmonar_distensibilidad_resistnecia;?></td><?php } ?></tr>
       <tr><td>Cte. Tpo</td><?php foreach($datos as $dato){?><td><?php echo $dato->pulmonar_distensibilidad_cte_tpo;?></td><?php } ?></tr>
        <tr><td>C20/C</td><?php foreach($datos as $dato){?><td><?php echo $dato->pulmonar_distensibilidad_c20c;?></td><?php } ?></tr>
        <tr><td>P0,1</td><?php foreach($datos as $dato){?><td><?php echo $dato->pulmonar_po1;?></td><?php } ?></tr>
        <!--<tr><td>Frecuencia</td><?php foreach($datos as $dato){?><td><?php echo $dato->tipo_de_soporte;?></td><?php } ?></tr>
        <tr><td>Amplitud</td><?php foreach($datos as $dato){?><td><?php echo $dato->tipo_de_soporte;?></td><?php } ?></tr>-->
        <!--<tr><td>Power</td><?php foreach($datos as $dato){?><td><?php echo $dato->tipo_de_soporte;?></td><?php } ?></tr>-->
        <!--<tr><td>Delta P</td><?php foreach($datos as $dato){?><td><?php echo $dato->tipo_de_soporte;?></td><?php } ?></tr>-->
        <!--<tr><td>Flujo Base</td><?php foreach($datos as $dato){?><td><?php echo $dato->tipo_de_soporte;?></td><?php } ?></tr>-->
        <tr><td>Alarma Presion Alta</td><?php foreach($datos as $dato){?><td><?php echo $dato->alarma_de_presion_alta;?></td><?php } ?></tr>
        <tr><td>Alarma Presion Baja</td><?php foreach($datos as $dato){?><td><?php echo $dato->alarma_de_presion_baja;?></td><?php } ?></tr>
        <tr><td>Respaldo</td><?php foreach($datos as $dato){?><td><?php echo $dato->respaldo;?></td><?php } ?></tr>
         <tr><td>Cambio Circuito</td><?php foreach($datos as $dato){?><td><?php echo $dato->tipo_de_soporte;?></td><?php } ?></tr>
        <tr><td>Aseo Diario</td><?php foreach($datos as $dato){?><td><?php echo $dato->tipo_de_soporte;?></td><?php } ?></tr>
        <tr><td>Respaldo</td><?php foreach($datos as $dato){?><td><?php echo $dato->cambio_circuito;?></td><?php } ?></tr>
        <tr><td>Kinesiologo Responsable</td><?php foreach($datos as $dato){?><td><?php echo $dato->kinesiologo;?></td><?php } ?></tr>
        <tr><td>NO</td><?php foreach($datos as $dato){?><td><?php echo $dato->ino_no;?></td><?php } ?></tr>
        <tr><td>NO2</td><?php foreach($datos as $dato){?><td><?php echo $dato->ino_no2;?></td><?php } ?></tr>
        <tr><td>FiO2</td><?php foreach($datos as $dato){?><td><?php echo $dato->ino_fio2;?></td><?php } ?></tr>
        <tr><td>Carga</td><?php foreach($datos as $dato){?><td><?php echo $dato->ino_carga;?></td><?php } ?></tr>
        <tr><td>Calibracion Baja</td><?php foreach($datos as $dato){?><td><?php echo $dato->ino_calibracion_baja;?></td><?php } ?></tr>
        <tr><td>Calibracion Alta</td><?php foreach($datos as $dato){?><td><?php echo $dato->ino_calibracion_alta;?></td><?php } ?></tr>
        <tr><td>Calibracion</td><?php foreach($datos as $dato){?><td><?php echo $dato->ino_calibracion_;?></td><?php } ?></tr>
        <tr><td>Desinfeccion</td><?php foreach($datos as $dato){?><td><?php echo $dato->ino_desinfeccion;?></td><?php } ?></tr>
        <tr><td>PSI Actuales</td><?php foreach($datos as $dato){?><td><?php echo $dato->ino_psi_actuales;?></td><?php } ?></tr>
        <tr><td>Numero Serie Balon</td><?php foreach($datos as $dato){?><td><?php echo $dato->ino_numero_serie_balon;?></td><?php } ?></tr>
        <tr><td>FiO2 ECMO</td><?php foreach($datos as $dato){?><td><?php echo $dato->ecmo_fio2_volumen_cuff;?></td><?php } ?></tr>
       <!--<tr><td>Volumen Cuff</td><?php foreach($datos as $dato){?><td><?php echo $dato->cuff_volumen;?></td><?php } ?></tr>-->
       <!--<tr><td>Flujo Aire</td><?php foreach($datos as $dato){?><td><?php echo $dato->tipo_de_soporte;?></td><?php } ?></tr>-->
        <!--<tr><td>Flujo O2</td><?php foreach($datos as $dato){?><td><?php echo $dato->tipo_de_soporte;?></td><?php } ?></tr>-->
       <tr><td>Presion Cuff</td><?php foreach($datos as $dato){?><td><?php echo $dato->cuff_presion;?></td><?php } ?></tr>
        <tr><td>Flujo CO2/N2</td><?php foreach($datos as $dato){?><td><?php echo $dato->ecmo_co2_n2;?></td><?php } ?></tr>
        <tr><td>Carga CO2/N2 </td><?php foreach($datos as $dato){?><td><?php echo $dato->ecmo_carga_co2_n2;?></td><?php } ?></tr>



    <?php $i=$i+1;?>

     <!-- <?php }?>-->
      <?php }?>


    </tbody>

  </table>

</div>

 

<div class="text-right">

     <?php echo $pagination; ?>

    
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
