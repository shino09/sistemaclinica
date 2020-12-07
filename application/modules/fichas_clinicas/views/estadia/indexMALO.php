<div class="navegacion">
  <div class="center">
    <?=$this->layout->getNav();?>
  </div>
</div>

<?php echo $this->uri->segment(4);?>

<div class="center">
  <h2>Estadia</h2>


        <form action="#" id="form-filtro" name="form-filtro" class="form-horizontal" method="post">
          <div class="grupos">
    <div class="info">


        <input type="hidden" id="con_ficha_clinica" name="con_ficha_clinica" value="<?=$this->uri->segment(4)?>" />

     

<div>Centro Medico: 
         <strong>  <?php foreach($rel7 as $re7){ ?>
                                <?php foreach($rel6 as $re6){ ?>

           <?php foreach($rel2 as $re2){ ?>
                <?php if($this->uri->segment(4) == $re7->codigo && $re7->unidad_2 == $re6->codigo && $re6->centro_medico ==  $re2->codigo) { echo $re2->nombre;}?><input type="hidden" id="con_centro_medico"  name="con_centro_medico" value="<?=@$re2->codigo?>" />
          <?php }  ?>
                    <?php }  ?>

          <?php }  ?>
</strong>
</div>

<div>Unidad: 
         <strong>  <?php foreach($rel7 as $re7){ ?>
                      <?php foreach($rel6 as $re6){ ?>

                <?php if($this->uri->segment(4) == $re7->codigo &&  $re7->unidad_2 ==$re6->codigo) { echo $re6->nombre;}?><input type="hidden" id="con_unidad"  name="con_unidad" value="<?=@$re6->codigo?>" />
          <?php }  ?>
          <?php }  ?>
</strong>
</div>




<div id="con_nombre_completo"  name="con_nombre_completo">Nombre: 
         <strong>  <?php foreach($rel7 as $re7){ ?>
        <?php if($this->uri->segment(4)  == $re7->codigo) { echo $re7->nombre_completo;}?>
          <?php }  ?>
</strong>
</div>


<div >Rut: 
         <strong>  <?php foreach($rel7 as $re7){ ?>
        <?php if($this->uri->segment(4)  == $re7->codigo) {?>        <input type="hidden" id="con_rut"  name="con_rut" value="<?=@$re7->rut_?>" />
 <?php echo $re7->rut_;}?>
          <?php }  ?>
</strong>
</div>    </div>


  </div>

  <div class="clear"></div>

        <div class="filtros2">
                                  <label>FECHA INGRESO CLINICA:</label>

    <div> <i class="fa fa-calendar"></i>
      <input type="text" value="" id="datepicker" name="fecha"/>
    </div>
   <!-- <div> <i class="fa fa-calendar"></i>
      <input type="text" value="Hasta" id="datepicker_2" name="fecha_hasta" />
    </div>-->
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
      <table class="table ">

<thead>

          <?php $i=0;$k=0;?>
          <?php if($datos){?>
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
                      <?php } ?>


              </thead>

    <tbody>

      

                   
               <tr><td>Codigo</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->codigo;?></td><?php } ?><?php } ?></tr>

        <tr><td>Tipo Soporte</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->tipo_de_soporte;?></td><?php } ?><?php } ?></tr>
        <tr><td>Equipo en Uso</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->equipo;?></td><?php } ?><?php } ?></tr>
        <tr><td>Insumos</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->insumo_filtro;?></td><?php } ?><?php } ?></tr>
       <tr><td>Vía Aerea</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->via_aerea;?></td><?php } ?><?php } ?></tr>
        <tr><td>Frecuancia Cardiaca</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->frecuencia_cardiaca;?></td><?php } ?><?php } ?></tr>
        <tr><td>Frecuencia Respiratoria</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->frecuencia_respiratoria;?></td><?php } ?><?php } ?></tr>
        <tr><td>Presion Arterial Sistolica</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->presion_sistolica;?></td><?php } ?><?php } ?></tr>
        <tr><td>Presion Arterial Diastolica</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->presion_diastolica;?></td><?php } ?><?php } ?></tr>
        <tr><td>Presion Arterial Media</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->presion_arterial_media;?></td><?php } ?><?php } ?></tr>
     <!--<tr><td>Saturacion Arterial</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->tipo_de_soporte;?></td><?php } ?><?php } ?></tr>-->
        <tr><td>Saturacion Preductal</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->saturacion_preductual;?></td><?php } ?><?php } ?></tr>
        <tr><td>Saturacion Post Ductal</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->saturacion_postductual;?></td><?php } ?><?php } ?></tr>
        <tr><td>Modo Ventilatorio</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->modo_ventilatorio_pc;?></td><?php } ?><?php } ?></tr>
        <tr><td>PIM/PMAX</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->pimpmax_;?></td><?php } ?><?php } ?></tr>
        <tr><td>Presion Plateau</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->presion_plateu;?></td><?php } ?><?php } ?></tr>
        <tr><td>Presion Media</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->presion_media;?></td><?php } ?><?php } ?></tr>
        <tr><td>Insumos</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->insumo_filtro;?></td><?php } ?><?php } ?></tr>
       <tr><td>Vía Aerea</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->via_aerea;?></td><?php } ?><?php } ?></tr>
        <tr><td>PEEP</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->peep;?></td><?php } ?><?php } ?></tr>
        <tr><td>Presion de Soporte</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->presion_de_soporte;?></td><?php } ?><?php } ?></tr>
        <tr><td>Alarma Alta de Presion</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->alarma_de_presion_alta;?></td><?php } ?><?php } ?></tr>
        <tr><td>Alarma Baja de Presion</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->alarma_de_presion_baja;?></td><?php } ?><?php } ?></tr>
        <!--<tr><td>VC Programado</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->tipo_de_soporte;?></td><?php } ?><?php } ?></tr>-->
        <tr><td>VC Inspirado</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->vc_ins;?></td><?php } ?><?php } ?></tr>
        <tr><td>VC Espirado</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->vc_esp;?></td><?php } ?><?php } ?></tr>
        <tr><td>Volumen Minuto</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->v_min;?></td><?php } ?><?php } ?></tr>
        <tr><td>Alarma VMin Alta</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->alarma_de_volumen_minuto_alta;?></td><?php } ?><?php } ?></tr>
        <tr><td>Alarma VMin Baja</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->alarma_de_volumen_minuto_baja;?></td><?php } ?><?php } ?></tr>
           <tr><td>Alarma VC Alta</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->alarma_de_volumen_corriente_alta;?></td><?php } ?><?php } ?></tr>
        <tr><td>Alarma VC Baja</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->alarma_de_volumen_corriente_baja;?></td><?php } ?><?php } ?></tr>
        <!--<tr><td>Frecuencia Respiratoria VM</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->tipo_de_soporte;?></td><?php } ?><?php } ?></tr>-->
        <tr><td>Frecuencia Respiratoria Total</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->fr_total;?></td><?php } ?><?php } ?></tr>
        <tr><td>Tiempo Inspiratorio</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->tiempo_inspiratorio;?></td><?php } ?><?php } ?></tr>
       <tr><td>Relacion I:E</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->relacion_ie;?></td><?php } ?><?php } ?></tr>
        <tr><td>Flujo Inspiratorio</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->flujo_inspiratorio;?></td><?php } ?><?php } ?></tr>
        <tr><td>Flujo Espiratorio</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->flujo_espiatorio;?></td><?php } ?><?php } ?></tr>
        <tr><td>Tipo Humidificacion</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->humidificacion;?></td><?php } ?><?php } ?></tr>
        <tr><td>Cambio Matraz</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->cambio_matraz_llenado_camara_humidificacion;?></td><?php } ?><?php } ?></tr>
        <tr><td>pH</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->gases_arteriales_ph;?></td><?php } ?><?php } ?></tr>
        <tr><td>PaO2</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->gases_arteriales_pao2;?></td><?php } ?><?php } ?></tr>
        <tr><td>PaCO2</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->gases_arteriales_paco2;?></td><?php } ?><?php } ?></tr>
        <tr><td>HCO3</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->gases_arteriales_hco3;?></td><?php } ?><?php } ?></tr>
        <tr><td>BE</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->gases_arteriales_be;?></td><?php } ?><?php } ?></tr>
        <tr><td>FiO2 GSA</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->gases_arteriales_fio2_gsa;?></td><?php } ?><?php } ?></tr>
        <tr><td>Pa/Fi</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->gases_arteriales_pafi;?></td><?php } ?><?php } ?></tr>
        <tr><td>IOX</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->gases_arteriales_iox;?></td><?php } ?><?php } ?></tr>
        <tr><td>EtCO2</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->gases_arteriales_etco2;?></td><?php } ?><?php } ?></tr>
        <tr><td>HTC</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->sangre_htc;?></td><?php } ?><?php } ?></tr>
        <tr><td>Hb</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->sangre_hb;?></td><?php } ?><?php } ?></tr>
        <tr><td>GB</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->sangre_gb;?></td><?php } ?><?php } ?></tr>
        <tr><td>Plaquetas</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->sangre_plaqueta;?></td><?php } ?><?php } ?></tr>
        <tr><td>Na</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->electrolito_na;?></td><?php } ?><?php } ?></tr>
        <tr><td>K</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->electrolito_k;?></td><?php } ?><?php } ?></tr>
        <tr><td>Cl</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->electrolito_cl;?></td><?php } ?><?php } ?></tr>
        <tr><td>Ca</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->dato->electrolito_ca;?></td><?php } ?><?php } ?></tr>
        <tr><td>P</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->electrolito_p;?></td><?php } ?><?php } ?></tr>
        <tr><td>PCR</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->inflamatorio_pcr;?></td><?php } ?><?php } ?></tr>
        <tr><td>Distensibilidad Dinamica</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->pulmonar_distensibilidad_dinamica;?></td><?php } ?><?php } ?></tr>
        <tr><td>Distensibilidad Estática</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->pulmonar_distensibilidad_estatica;?></td><?php } ?><?php } ?></tr>
        <tr><td>Resistencia</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->pulmonar_distensibilidad_resistnecia;?></td><?php } ?><?php } ?></tr>
       <tr><td>Cte. Tpo</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->pulmonar_distensibilidad_cte_tpo;?></td><?php } ?><?php } ?></tr>
        <tr><td>C20/C</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->pulmonar_distensibilidad_c20c;?></td><?php } ?><?php } ?></tr>
        <tr><td>P0,1</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->pulmonar_po1;?></td><?php } ?><?php } ?></tr>
        <!--<tr><td>Frecuencia</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->tipo_de_soporte;?></td><?php } ?><?php } ?></tr>
        <tr><td>Amplitud</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->tipo_de_soporte;?></td><?php } ?><?php } ?></tr>-->
        <!--<tr><td>Power</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->tipo_de_soporte;?></td><?php } ?><?php } ?></tr>-->
        <!--<tr><td>Delta P</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->tipo_de_soporte;?></td><?php } ?><?php } ?></tr>-->
        <!--<tr><td>Flujo Base</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->tipo_de_soporte;?></td><?php } ?><?php } ?></tr>-->
        <tr><td>Alarma Presion Alta</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->alarma_de_presion_alta;?></td><?php } ?><?php } ?></tr>
        <tr><td>Alarma Presion Baja</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->alarma_de_presion_baja;?></td><?php } ?><?php } ?></tr>
        <tr><td>Respaldo</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->respaldo;?></td><?php } ?><?php } ?></tr>
         <tr><td>Cambio Circuito</td><?php if($datos){?><?php foreach($datos as $dato){?><?php if($dato->cambio_circuito==1){?><td>si</td><?php } ?><?php if($dato->cambio_circuito==0){?><td>no</td><?php } ?><?php } ?><?php } ?></tr>
        <tr><td>Aseo Diario</td><?php if($datos){?><?php foreach($datos as $dato){?><?php if($dato->aseo_diario==1){?><td>si</td><?php } ?><?php if($dato->aseo_diario==0){?><td>no</td><?php } ?><?php } ?><?php } ?></tr>
        <tr><td>Respaldo</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->respaldo;?></td><?php } ?><?php } ?></tr>
        <tr><td>Kinesiologo Responsable</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->kinesiologo;?></td><?php } ?><?php } ?></tr>
        <tr><td>NO</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->ino_no;?></td><?php } ?><?php } ?></tr>
        <tr><td>NO2</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->ino_no2;?></td><?php } ?><?php } ?></tr>
        <tr><td>FiO2</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->ino_fio2;?></td><?php } ?><?php } ?></tr>
        <tr><td>Carga</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->ino_carga;?></td><?php } ?><?php } ?></tr>
        <tr><td>Calibracion Baja</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->ino_calibracion_baja;?></td><?php } ?><?php } ?></tr>
        <tr><td>Calibracion Alta</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->ino_calibracion_alta;?></td><?php } ?><?php } ?></tr>
        <tr><td>Calibracion</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->ino_calibracion_;?></td><?php } ?><?php } ?></tr>
        <tr><td>Desinfeccion</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->ino_desinfeccion;?></td><?php } ?><?php } ?></tr>
        <tr><td>PSI Actuales</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->ino_psi_actuales;?></td><?php } ?><?php } ?></tr>
        <tr><td>Numero Serie Balon</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->ino_numero_serie_balon;?></td><?php } ?><?php } ?></tr>
        <tr><td>FiO2 ECMO</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->ecmo_fio2_volumen_cuff;?></td><?php } ?><?php } ?></tr>
       <!--<tr><td>Volumen Cuff</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->cuff_volumen;?></td><?php } ?><?php } ?></tr>-->
       <!--<tr><td>Flujo Aire</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->tipo_de_soporte;?></td><?php } ?><?php } ?></tr>-->
        <!--<tr><td>Flujo O2</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->tipo_de_soporte;?></td><?php } ?><?php } ?></tr>-->
       <tr><td>Presion Cuff</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->cuff_presion;?></td><?php } ?><?php } ?></tr>
        <tr><td>Flujo CO2/N2</td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->ecmo_co2_n2;?></td><?php } ?><?php } ?></tr>
        <tr><td>Carga CO2/N2 </td><?php if($datos){?><?php foreach($datos as $dato){?><td><?php echo $dato->ecmo_carga_co2_n2;?></td><?php } ?><?php } ?></tr>



 


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
