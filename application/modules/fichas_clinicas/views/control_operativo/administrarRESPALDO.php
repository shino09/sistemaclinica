<div class="navegacion">
  <div class="center">
    <?=$this->layout->getNav();?>
  </div>
</div>

<?php if($this->uri->segment(4)){ ?>
<input type="hidden" name="codigo" id="codigo" value="<?=$this->uri->segment(4)?>"/>
<?php } ?>

<form  action="#" id="form" class="form-horizontal" method="post">


<div class="center agregar-control">
  <h2>Agregar nuevo control operativo</h2>
  <div class="grupos">
    <div class="info">


        <input type="hidden" id="con_ficha_clinica" name="con_ficha_clinica" value="<?=$this->uri->segment(4)?>" />

                <!--<input type="hidden" id="con_codigo" name="con_codigo" value="<?=$this->uri->segment(4)?>" />-->


  <!--  <div id="con_centro_medico"  name="con_centro_medico" > Centro médico: <strong> <?php  foreach($rel as $re) {?>

      <?php  if($re->codigo ==   $dato->centro_medico) {?> <td><?=$re->nombre?></td> <?php } ?><?php  }?>

     </strong></div>-->


<div>Centro Medico: 
         <strong>  <?php foreach($rel as $re){ ?>
                                <?php foreach($rel10 as $re10){ ?>

           <?php foreach($rel2 as $re2){ ?>
                <?php if($this->uri->segment(4) == $re->codigo && $re->unidad_2 == $re10->codigo && $re10->centro_medico ==  $re2->codigo) { echo $re2->nombre;}?><input type="hidden" id="con_centro_medico"  name="con_centro_medico" value="<?=@$re2->codigo?>" />
          <?php }  ?>
                    <?php }  ?>

          <?php }  ?>
</strong>
</div>

<div>Unidad: 
         <strong>  <?php foreach($rel as $re){ ?>
                      <?php foreach($rel10 as $re10){ ?>

                <?php if($this->uri->segment(4) == $re->codigo &&  $re->unidad_2 ==$re10->codigo) { echo $re10->nombre;}?><input type="hidden" id="con_unidad"  name="con_unidad" value="<?=@$re10->codigo?>" />
          <?php }  ?>
          <?php }  ?>
</strong>
</div>




<div id="con_fecha"  name="con_fecha">Fecha: 
         <strong>  <?php foreach($rel as $re){ ?>
        <?php if($this->uri->segment(4) == $re->codigo) { echo $re->fecha_ingreso;}?>
          <?php }  ?>
</strong>
</div>
    </div>

<div class="info">
  <div id="con_hora"  name="con_hora">Hora: 
         <strong>  <?php foreach($rel as $re){ ?>
        <?php if($this->uri->segment(4) == $re->codigo) { echo $re->hora_ingreso;}?>
          <?php }  ?>
</strong>
</div>
   <!-- <div class="info">
<div id="con_hora"  name="con_hora">Hora: 
         <strong>  <?php foreach($rel as $dat){ ?>
        <?php if($dato->ficha_clinica == $dat->codigo) { echo $dat->hora_ingreso;}?>
          <?php }  ?>
</strong>
</div>      -->
<div id="con_nombre_completo"  name="con_nombre_completo">Nombre: 
         <strong>  <?php foreach($rel as $re){ ?>
        <?php if($this->uri->segment(4)  == $re->codigo) { echo $re->nombre_completo;}?>
          <?php }  ?>
</strong>
</div>


<div >Rut: 
         <strong>  <?php foreach($rel as $re){ ?>
        <?php if($this->uri->segment(4)  == $re->codigo) {?>        <input type="hidden" id="con_rut"  name="con_rut" value="<?=@$re->rut_?>" />
 <?php echo $re->rut_;}?>
          <?php }  ?>
</strong>
</div>    </div>


  </div>

    <div class="cont">
        
   <div>
        <label>Fecha: </label>
        <input type="text" id="datepicker"  class="form-control validate[required]" name="con_fecha_ingreso" value="<?=@$dato->fecha_ingreso?>" />
        <i class="fa fa-calendar"></i> </div>

      <div>
                  <label >Hora</label>

        <input id="con_hora_ingreso"  class="form-control validate[required]" name="con_hora_ingreso" type="time" placeholder="hora" value="<?=@$dato->hora_ingreso?>" />
        <i class="fa fa-calendar"></i> </div>
      </div>
    <div class="cont">
      <div>
        <label>Cupos:</label>
        <select id="con_cupos" class="form-control validate[required]"  name="con_cupos">
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option> 
          <option value="5">5</option>
          <option value="6">6</option>
          <option value="7">7</option>
          <option value="8">8</option> 
          <option value="9">9</option>
          <option value="10">10</option>
          <option value="11">11</option>
          <option value="12">12</option>   
          <option value="13">13</option>
          <option value="14">14</option>
          <option value="15">15</option>
          <option value="16">16</option>       </select>
      </div>
  


     <!-- <div>Tipos de control: 
         <strong>  <?php foreach($rel7 as $dat){ ?>
        <?php if($dato->tipos_de_control == $dat->codigo) { echo $dat->nombre;}?>
          <?php }  ?>
</strong>
</div>-->

    <!--  <div>
      <label >Tipos de control:</label>
        <select id="con_tipos_de_control" class="form-control validate[required]"  name="con_tipos_de_control">
          <option >Seleccione</option>
            <?php foreach($rel7 as $dat){ ?>
            <option  value="<?=$dat->codigo?>" <?php echo " SELECTED" ;?> > <?=$dat->nombre?><?php }?></option>
        </select>
    </div>-->

    <!--<div>
        <label>Tipos de control:</label>
          <select id="con_tipos_de_control" class="form-control validate[required]"  name="con_tipos_de_control">
            <?php foreach($rel7 as $dat): ?>
            <option<?php  echo " SELECTED";?> value="<?=$dat->codigo?>"><?=$dat->nombre?></option>
          <?php endforeach; ?>
        </select>
      </div>-->

       <div>

        <input type="hidden" id="con_codigo" name="con_codigo" value="<?=$this->uri->segment(4)?>" />

                           <!--  <input type="hidden" name="con_codigo" class="con_codigo" value="<?=$dato->codigo?>" />-->

          <select name="con_tipos_de_control"  class=con_tipos_de_control" rel="<?=$dato->codigo?>" >
  <?php foreach($rel7 as $dat): ?>
            <option<?php  echo " SELECTED";?> value="<?=$dat->codigo?>"><?=$dat->nombre?></option>
          <?php endforeach; ?>
        </select>
        </div>


    </div>



    <div class="cont">
      <div>
        <label>Tipo de soporte:</label>
        <select id="con_tipo_de_soporte" class="form-control validate[required]"  name="con_tipo_de_soporte">
          <option value="1">VMI</option>
          <option value="2">ALTA FRECUENCIA (VAFO)</option>
          <option value="3">VMNI</option>
          <option value="4">CANULA ALTO FLUJO</option> 
      </div>
    </div>

    <div>
        <label>Equipos en uso:</label>
          <select >
         <!-- <option value="">Seleccione</option>-->
            <?php foreach($rel as $dat): ?>
            <option<?php  echo " SELECTED";?> value="<?=$dat->codigo?>"><?=$dat->nombre?></option>
          <?php endforeach; ?>
        </select>
      </div>
    <div class="cont">
      <div>
        <label>Equipos en uso:</label>
          <select id="con_equipo" class="form-control validate[required]"  name="con_equipo">
         <!-- <option value="">Seleccione</option>-->
            <?php foreach($rel4 as $dat): ?>
            <option<?php  echo " SELECTED";?> value="<?=$dat->codigo?>"><?=$dat->nombre?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <!--  revisar checkbox nombre -->
      <div>
        <label>Soporte adicional:</label>
    <input type="checkbox" id="con_soporte_adicional_inomax"  name="con_soporte_adicional_inomax" value="1"/>
        iNOMAX
        <input type="checkbox" id="con_soporte_adicional_ecmo_1"  name="con_soporte_adicional_ecmo_1" value="1"/>
        ECMO </div>

          <!--<input type="radio" id="con_soporte_adicional_inomax"  name="con_soporte_adicional_inomax" value="1"/>
        iNOMAX
        <input type="radio" id="con_soporte_adicional_ecmo_1"  name="con_soporte_adicional_ecmo_1" value="1"/>
        ECMO </div>-->
    <div class="cont">
     

         

      <div>
        <label>Insumo: </label>
            <select id="con_insumo_circuito"  name="con_insumo_circuito">
          <option value="">Circuito</option>
            <?php foreach($rel6 as $dat){ ?>
            <option<?php if( $dat->tipo == 1) {echo " SELECTED";?> value="<?=$dat->codigo?>"><?=$dat->nombre ?><?php }?></option>
          <?php } ?>
        </select>
      </div>
                <form action="#" id="form-insumo" method="post" enctype="multipart/form-data"> 


<!--<div >
         
              <input onclick="document.getElementById('insumo_circuito_otro').disabled=false;document.getElementById('insumo_filtro_otro').disabled=true;"" type="radio" name="example" value="Otro" id="example_0" />
              Otro</div>
                <div>
      <input type="text" id="insumo_circuito_otro" name="insumo_circuito_otro" placeholder="" disabled="true" />
    </div>-->


       <div>
            <select id="con_insumo_filtro"  name="con_insumo_filtro">
          <option value="">Filtro</option>
            <?php foreach($rel6 as $dat){ ?>
            <option<?php if($dat->tipo == 2) {echo " SELECTED";?> value="<?=$dat->codigo?>"><?=$dat->nombre?><?php }?></option>
          <?php } ?>
        </select>
      </div>


      <!--<div>
          <input onclick="document.getElementById('insumo_circuito_otro').disabled=true;document.getElementById('insumo_filtro_otro').disabled=false;" type="radio" name="example" value="Otro" id="example_1" />
         Otro
      </div>
    
    <div>
      <input type="text" id="insumo_filtro_otro" name="insumo_filtro_otro" placeholder="" disabled="true"  />
    </div>-->
  </form>

      <a href="#" data-toggle="modal" data-target="#modal-avisolegal">Agregar Otro Insumo tipo filtro </a>

  </div>


<!--
 <div role="dialog" tabindex="-1" class="modal fade" id="modal-avisolegal" 
style="max-width:600px;margin-right:auto;margin-left:auto;">
   <div class="modal-dialog" role="document">
     <div class="modal-content">
       <div class="modal-header"> 
       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
       <h4 class="text-center modal-title">Aviso Legal</h4>
       </div>
           <form action="#" method="post" id="form-agregar-insumo">
          <div class="modal-body"  >
       

             <div>
        <label>Nombre:</label>
        <input type="text" id="nombre"  name="ins_nombre" value="<?=@$dato->nombre?>" />
      </div>

        <label for="tipo" class="col-sm-4 control-label">tipo:</label>
          <select id="tipo"  name="ins_tipo">
            <option<?php if(@$dato->tipo == 1) echo " SELECTED";?> value="1">Circuito</option>
            <option<?php if(@$dato->tipo == 2) echo " SELECTED";?> value="2">Filtro</option>
          </select>
    
      <div>
        <label>Stock Alerta:</label>
        <input type="text" id="stock"  name="ins_stock_de_alerta" value="<?=@$dato->stock_de_alerta?>" />
      </div>

      <div>
        <label>Descripción:</label>
        <input type="text" id="descripcion"  name="ins_descripcion" value="<?=@$dato->descripcion?>" />
      </div>

      <div>
        <label>Precio:</label>
        <input type="text" id="precio"  name="ins_precio" value="<?=@$dato->precio?>" />
      </div>
    

      <label for="estado" class="col-sm-4 control-label">Estado:</label>
        <select id="estado"  name="ins_estado">
            <option<?php if(@$dato->estado == 1) echo " SELECTED";?> value="1">Activo</option>
            <option<?php if(@$dato->estado == 0) echo " SELECTED";?> value="0">Inactivo</option>
        </select>

              
    
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-default">Aceptar</button>
              <button type="button" class="btn btn-can" data-dismiss="modal">Cancelar</button>
            </div>
        </form>
       
     </div>
   </div>
</div>



  <div class="agregar-insumo_otro modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h2 class="col-md-12">Agregar Nuevo Insumo</h2>
        </div>
        <form action="#" method="post" id="form-agregar-insumo">
          <div class="modal-body"  >
       

             <div>
        <label>Nombre:</label>
        <input type="text" id="nombre"  name="ins_nombre" value="<?=@$dato->nombre?>" />
      </div>

        <label for="tipo" class="col-sm-4 control-label">tipo:</label>
        <div class="col-sm-7">
          <select id="tipo"  name="ins_tipo">
            <option<?php if(@$dato->tipo == 1) echo " SELECTED";?> value="1">Circuito</option>
            <option<?php if(@$dato->tipo == 2) echo " SELECTED";?> value="2">Filtro</option>
          </select>
        </div>
    
      <div>
        <label>Stock Alerta:</label>
        <input type="text" id="stock"  name="ins_stock_de_alerta" value="<?=@$dato->stock_de_alerta?>" />
      </div>

      <div>
        <label>Descripción:</label>
        <input type="text" id="descripcion"  name="ins_descripcion" value="<?=@$dato->descripcion?>" />
      </div>

      <div>
        <label>Precio:</label>
        <input type="text" id="precio"  name="ins_precio" value="<?=@$dato->precio?>" />
      </div>
    

      <label for="estado" class="col-sm-4 control-label">Estado:</label>
      <div class="col-sm-7">
        <select id="estado"  name="ins_estado">
            <option<?php if(@$dato->estado == 1) echo " SELECTED";?> value="1">Activo</option>
            <option<?php if(@$dato->estado == 0) echo " SELECTED";?> value="0">Inactivo</option>
        </select>
      </div>

              </div>
    
            <div class="modal-footer">
              <button type="submit" class="btn btn-default">Aceptar</button>
              <button type="button" class="btn btn-can" data-dismiss="modal">Cancelar</button>
            </div>
        </form>
      </div>
    </div>
  </div> -->
  

     



    <!--  <div >
          <select name="area"  id="area">
            <option value="1">TQT</option>
            <option value="2">TET</option>
          </select>
        </div>

        <div>
          <select name="tipoarea"  id="tipoarea">
            <option value="">Tipo Area</option>
          </select>
        </div>-->


   <!-- <div class="cont">
      <div>
        <label>Vía aérea:</label>
         <div >
          <select name="area"  id="area" >

            <option value="1">TQT</option>
            <option value="2">TET</option>
          </select>
        </div>

        <div>
          <select name="tipoarea"  id="tipoarea">
            <option value="">Tipo Area</option>
          </select>
        </div>
      </div>
    </div>-->

 <div>
        <label>Kinesiologo Responsable:</label>
          <select id="con_kinesiologo" class="form-control validate[required]"  name="con_kinesiologo">
            <?php foreach($rel3 as $dat): ?>
            <option<?php  echo " SELECTED";?> value="<?=$dat->codigo?>"><?=$dat->nombre?></option>
          <?php endforeach; ?>
        </select>
      </div>
           
  <div>
                  <label >Hora LLamado</label>

        <input id="con_hora_llamado_kinesiologo" name="con_hora_llamado_kinesiologo" type="time" placeholder="hora" value="<?=@$dato->hora_llamado_kinesiologo?>" />
        <i class="fa fa-calendar"></i> </div>
     <div>
                  <label >Hora LLegada</label>

        <input id="con_hora_llegada_kinesiologo" name="con_hora_llegada_kinesiologo" type="time" placeholder="hora" value="<?=@$dato->con_hora_llegada_kinesiologo?>" />
        <i class="fa fa-calendar"></i> </div>
   
       <div>
                  <label >Hora Salida</label>

        <input id="con_hora_salida_kinesiologo" name="con_hora_salida_kinesiologo" type="time" placeholder="hora" value="<?=@$dato->con_hora_salida_kinesiologo?>" />
        <i class="fa fa-calendar"></i> </div>
  

      <div>
        <label>Responsable Llamado</label>
        <input type="text" id="con_responsable_llamado"  name="con_responsable_llamado" value="<?=@$dato->con_responsable_kinesiologo?>"/>
      </div>



    <div class="cont">
      <div>
        <label>Vía aérea:</label>
         <div >
          <select name="con_via_aerea"  id="con_via_aerea" >

             <!--<select id="con_via_aerea"  name="con_via_aerea">-->
                          <option value="">Seleccione Via Aerea</option>

            <option value="1">TQT</option>
            <option value="2">TET</option>
          </select>
        </div>

        <div>
          <select name="con_tipo_via_aerea"  id="con_tipo_via_aerea">
              <!--<select id="con_tipo_via_aerea"  name="con_tipo_via_aerea">-->
            <option value="">Tipo Area</option>
          </select>
        </div>
      </div>
    </div>



    <div class="cont">
      <div style="width: 40px;">
        <label>Cuff:</label>
     <div>

<label>
             <input onclick="document.getElementById('con_cuff_volumen').disabled=false;document.getElementById('con_cuff_presion').disabled=false;" type="radio" name="con_cuff_radio" value="si" id="con_cuff_volumen_radio" />
              Si</label>
  
   <label>
          <input onclick="document.getElementById('con_cuff_volumen').disabled=true;document.getElementById('con_cuff_presion').disabled=true;" type="radio" name="con_cuff_radio" value="No" id="con_cuff_presion_radio" />
          No</label>
        </div>
<div>
                <label>Volumen:</label>

        <select id="con_cuff_volumen"  name="con_cuff_volumen" disabled >
      
<?php
    for ($i=0; $i<=20; $i=$i+1)
    {
        ?>
            <option value="<?php echo $i;?>"><?php echo $i;?></option>
        <?php
    }
?>
</select>
      </div>
      <div>
                <label>Presión:</label>

        <select id="con_cuff_presion"  name="con_cuff_presion" disabled >
 
<?php
    for ($i=0; $i<=20; $i=$i+1)
    {
        ?>
            <option value="<?php echo $i;?>"><?php echo $i;?></option>
        <?php
    }
?>
</select>
      </div>
      
    </div>

  
    </div>

    <select>
<?php
    for ($i=0; $i<=100; $i=$i+10)
    {
        ?>
            <option value="<?php echo $i;?>"><?php echo $i;?></option>
        <?php
    }
?>
</select>




    <div class="cont-sup">
      <div>
        <label>Frecuencia cardiaca</label>
 <select id="con_frecuencia_cardiaca"  name="con_frecuencia_cardiaca">
<?php
    for ($i=40; $i<=255; $i=$i+5)
    {
        ?>
            <option value="<?php echo $i;?>"><?php echo $i;?></option>
        <?php
    }
?>
</select>   </div>
      <div>
        <label>Frecuencia Respiratoria</label>
 <select id="con_frecuencia_respiratoria"  name="con_frecuencia_respiratoria">
<?php
    for ($i=8; $i<=80; $i=$i+1)
    {
        ?>
            <option value="<?php echo $i;?>"><?php echo $i;?></option>
        <?php
    }
?>
</select>       </div>


      


      <div>
        <label>Presión Arterial:</label>
        <span>
        <div>
          <label>Sistólica</label>
 <input type="text" id="con_presion_sistolica"  name="con_presion_sistolica">
        </div>
        <div>
          <label>Diastólica</label>
 <input type="text" id="con_presion_diastolica"  name="con_presion_diastolica">
        </div>
        <div>
           <input type="button" value="Calcular" onclick="Calcular();">
 
          <label>Presión arterial media</label>
<p id="con_presion_arterial_media" ></p>
<input type="hidden" id="con_presion_arterial_media2"  name="con_presion_arterial_media" >
        </div>
        </span> </div>
    </div>


    <div class="cont-sup">
      <div>
        <label>Saturación:</label>
        <span>
        <div>
          <label>Preductal</label>
          <input type="text" id="con_saturacion_preductual"  name="con_saturacion_preductual"/>
        </div>
        <div>
          <label>Postductal</label>
          <input type="text" id="con_saturacion_postductual"  name="con_saturacion_postductual"/>
        </div>
        </span> </div>
    </div>
    <div class="cont">
      <div>
          <input onclick="document.getElementById('con_modo_ventilatorio_pc').disabled=false;" type="radio" name="con_modo_ventilatorio_pc_radio" value="si" id="con_modo_ventilatorio_pc_radio" /> Modo ventilatorio PC </div>
       <div>
            <select id="con_modo_ventilatorio_pc"  name="con_modo_ventilatorio_pc" disabled>
          <option value="">Modo Ventilatorio</option>
            <?php foreach($rel8 as $dat){ ?>
            <option<?php if($dat->tipo == 1) {echo " SELECTED";?> value="<?=$dat->codigo?>"><?=$dat->nombre?><?php }?></option>
          <?php } ?>
        </select>
      </div>
      </div>
      <div>
        <input onclick="document.getElementById('con_modo_ventilatorio_vc').disabled=false;" type="radio" name="con_modo_ventilatorio_vc_radio" value="si" id="con_modo_ventilatorio_vc_radio" /> 
        Modo ventilatorio VC </div>
      <div>
                <select id="con_modo_ventilatorio_vc"  name="con_modo_ventilatorio_vc" disabled>
          <option value="">Modo Ventilatorio</option>
            <?php foreach($rel8 as $dat){ ?>
            <option<?php if($dat->tipo == 2) {echo " SELECTED";?> value="<?=$dat->codigo?>"><?=$dat->nombre?><?php }?></option>
          <?php } ?>
        </select>
      </div>
      <div>
        <input onclick="document.getElementById('con_modo_ventilatorio_duales').disabled=false;" type="radio" name="con_modo_ventilatorio_duales_radio" value="si" id="con_modo_ventilatorio_duales_radio" />      Modos duales </div>
      <div>
                <select id="con_modo_ventilatorio_duales"  name="con_modo_ventilatorio_duales" disabled>
          <option value="">Modo Ventilatorio</option>
            <?php foreach($rel8 as $dat){ ?>
            <option<?php if($dat->tipo == 3) {echo " SELECTED";?> value="<?=$dat->codigo?>"><?=$dat->nombre?><?php }?></option>
          <?php } ?>
        </select>
      </div>

 

      <div>
 <input onclick="document.getElementById('con_modo_ventilatorio_otro').disabled=false;" type="radio" name="con_modo_ventilatorio_otro_radio" value="si" id="con_modo_ventilatorio_otro_radio" />        Otros </div>
      <div>
      <input type="text" id="con_modo_ventilatorio_otro" name="con_modo_ventilatorio_otro" placeholder="" disabled="true" />
      </div>
    </div>
    <div class="cont3">
      <div>
        <label>PIM/PMAX</label>
         <select id="con_pimpmax_"  name="con_pimpmax_">
<?php
    for ($i=1; $i<=50; $i=$i+1)
    {
        ?>
            <option value="<?php echo $i;?>"><?php echo $i;?></option>
        <?php
    }
?>
</select> 
      </div>
      <div>
        <label>Presión plateau</label>
               <select id="con_presion_plateu"  name="con_presion_plateu">
<?php
    for ($i=1; $i<=50; $i=$i+1)
    {
        ?>
            <option value="<?php echo $i;?>"><?php echo $i;?></option>
        <?php
    }
?>
</select> 
      </div>
      <div>
        <label>PEEP:</label>
               <select id="con_peep"  name="con_peep">
<?php
    for ($i=1; $i<=30; $i=$i+1)
    {
        ?>
            <option value="<?php echo $i;?>"><?php echo $i;?></option>
        <?php
    }
?>
</select> 
      </div>
      <div>
        <label>Presión media</label>
             <select id="con_presion_media"  name="con_presion_media">
<?php
    for ($i=1; $i<=40; $i=$i+1)
    {
        ?>
            <option value="<?php echo $i;?>"><?php echo $i;?></option>
        <?php
    }
?>
</select> 
      </div>
      <div>
        <label>Presión de soporte</label>
        <select id="con_presion_de_soporte" name="con_presion_de_soporte"> 
<?php
    for ($i=1; $i<=999; $i=$i+1)
    {
        ?>
            <option value="<?php echo $i;?>"><?php echo $i;?></option>
        <?php
    }
?>
</select> 
      </div>

      <div class="sub-contenedor">
        <label>Alarma de presión</label>
        <input type="text" placeholder="Alta"  id="con_alarma_de_presion_alta_1"  name="con_alarma_de_presion_alta_1"/>
      </div>
      <div class="sub-contenedor">
        <input type="text" placeholder="Baja" id="con_alarma_de_presion_baja_1"  name="con_alarma_de_presion_baja_1" />
      </div>     
      <div>
        <label>VC ins:</label>
             <select id="con_vc_ins"  name="con_vc_ins">
<?php
    for ($i=1; $i<=999; $i=$i+1)
    {
        ?>
            <option value="<?php echo $i;?>"><?php echo $i;?></option>
        <?php
    }
?>
</select> 
      </div>
      <div>
        <label>VC Esp:</label>
    
             <select id="con_vc_esp"  name="con_vc_esp">
<?php
    for ($i=1; $i<=999; $i=$i+1)
    {
        ?>
            <option value="<?php echo $i;?>"><?php echo $i;?></option>
        <?php
    }
?>
</select> 
      </div>
      <div>
        <label>V min:</label>
           <select id="con_v_min"  name="con_v_min">
<?php
    for ($i=1; $i<=999; $i=$i+1)
    {
        ?>
            <option value="<?php echo $i;?>"><?php echo $i;?></option>
        <?php
    }
?>
</select> 
      </div>
      <div class="sub-contenedor">
        <label>Alarma de volumen corriente:</label>
        <input type="text" placeholder="Alta" id="con_alarma_de_volumen_corriente_alta"  name="con_alarma_de_volumen_corriente_alta"/>
      </div>
      <div class="sub-contenedor">
        <input type="text" placeholder="Baja" id="con_alarma_de_volumen_corriente_baja"  name="con_alarma_de_volumen_corriente_baja" />
      </div>
      <div></div>
      <div class="sub-contenedor">
        <label>Alarma de volumen Minuto:</label>
        <input type="text" placeholder="Alta"  id="con_alarma_de_volumen_minuto_alta"  name="con_alarma_de_volumen_minuto_alta"/>
      </div>
      <div class="sub-contenedor">
        <input type="text" placeholder="Baja" id="con_alarma_de_volumen_minuto_baja"  name="con_alarma_de_volumen_minuto_baja"/>
      </div>
      <div>
        <label>FR VM:</label>
    
             <select id="con_fr_vm"  name="con_fr_vm">
<?php
    for ($i=1; $i<=60; $i=$i+1)
    {
        ?>
            <option value="<?php echo $i;?>"><?php echo $i;?></option>
        <?php
    }
?>
</select> 
      </div>
      <div>
        <label>FR total:</label>
   
             <select id="con_fr_total"  name="con_fr_total">
<?php
    for ($i=1; $i<=60; $i=$i+1)
    {
        ?>
            <option value="<?php echo $i;?>"><?php echo $i;?></option>
        <?php
    }
?>
</select> 
      </div>
      <div>
        <label>Tiempo inspiratorio:</label>
             <select id="con_tiempo_inspiratorio"  name="con_tiempo_inspiratorio">
<?php
    for ($i=0; $i<=4; $i=$i+1)
    {
        ?>
            <option value="<?php echo $i;?>"><?php echo $i;?></option>
        <?php
    }
?>
</select> 
      </div>
      <div>
        <label>Relación I;E:</label>
        <input type="text" id="con_relacion_ie"  name="con_relacion_ie" />
      </div>
      <div>
        <label>Flujo inspiratorio:</label>
        <input type="text" id="con_flujo_inspiratorio"  name="con_flujo_inspiratorio"/>
      </div>
      <div>
        <label>Flujo espiatorio:</label>
        <input type="text" id="con_flujo_espiatorio"  name="con_flujo_espiatorio"/>
      </div>
      <div class="sub-contenedor">
        <label>Humidificación:</label>
           <select id="con_humidificacion"  name="con_humidificacion">
          <option value="1">MR810</option>
          <option value="2">MR850</option>
          <option value="3">MR730</option>
          <option value="4">HME</option> 
              </select>
      </div>
      <div class="sub-contenedor">
        <label>Temperatura:</label>
                    <select id="con_temperatura"  name="con_temperatura">
<?php
    for ($i=0; $i<=60; $i=$i+1)
    {
        ?>
            <option value="<?php echo $i;?>"><?php echo $i;?></option>
        <?php
    }
?>
</select> 
      </div>
      <div class="sub-contenedor">
        <label>Nivel:</label>
         <select id="con_nivel"  name="con_nivel">
          <option value="1">Nivel 1</option>
          <option value="2">Nivel 2</option>
          <option value="3">Nivel 3</option>
              </select>
      </div>
    </div>
    <div class="cont3">
      <div>
        <label>Cambio Matraz/Llenado de cámara humidificadora</label>
        <select id="con_cambio_matraz_llenado_camara_humidificacion_1"  name="con_cambio_matraz_llenado_camara_humidificacion_1">
          <option value="1">Si</option>
          <option value="2">No</option>
         
              </select>
      </div>
    </div>

    <div class="columnas">
      <p>Exámenes de laboratorio</p>
      <div class="col">
        <h3>Gases Arteriales</h3>
        <div>
          <label>pH:</label>
          <input type="text" id="gases_arteriales_ph_"  name="gases_arteriales_ph_"/>
        </div>
        <div>
          <label>Pa02:</label>
          <input type="text" id="con_gases_arteriales_pao2"  name="con_gases_arteriales_pao2" />
        </div>
        <div>
          <label>PaO2:</label>
          <input type="text"  id="con_gases_arteriales_paco2"  name="con_gases_arteriales_paco2"/>
        </div>
        <div>
          <label>HCO3:</label>
          <input type="text" id="con_gases_arteriales_hco3"  name="con_gases_arteriales_hco3"/>
        </div>
        <div>
          <label>BE:</label>
          <input type="text" id="con_gases_arteriales_be"  name="con_gases_arteriales_be"/>
        </div>
        <div>
          <label>FiO2 GSA:</label>
          <input type="text" id="con_gases_arteriales_fio2_gsa"  name="con_gases_arteriales_fio2_gsa" />
        </div>
        <div>
          <label>Pa/Fi:</label>
          <input type="text" id="con_gases_arteriales_pafi"  name="con_gases_arteriales_pafi" />
        </div>
        <div>
          <label>lox:</label>
          <input type="text" id="con_gases_arteriales_iox"  name="con_gases_arteriales_iox" />
        </div>
        <div>
          <label>etCO2:</label>
          <input type="text" id="con_gases_arteriales_etco2"  name="con_gases_arteriales_etco2"/>
        </div>
      </div>
      <hr />
      <div class="col">
        <h3>Sangre</h3>
        <div>
          <label>HTC:</label>
          <input type="text" id="con_sangre_htc"  name="con_sangre_htc"/>
        </div>
        <div>
          <label>Hb:</label>
          <input type="text" id="con_sangre_hb"  name="con_sangre_hb"/>
        </div>
        <div>
          <label>Gb:</label>
          <input type="text" id="con_sangre_gb"  name="con_sangre_gb"/>
        </div>
        <div>
          <label>Plaquetas:</label>
          <input type="text" id="con_sangre_plaqueta"  name="con_sangre_plaqueta"/>
        </div>
          <div>
          <label>S:</label>
          <input type="text" id="con_sangre_s"  name="con_sangre_s"/>
        </div>
      </div>
      <hr />
      <div class="col">
        <h3>Electrolitos de sangre</h3>
        <div>
          <label>Na:</label>
          <input type="text" id="con_electrolito_na"  name="con_electrolito_na" />
        </div>
        <div>
          <label>k:</label>
          <input type="text" id="con_electrolito_k"  name="con_electrolito_k"/>
        </div>
        <div>
          <label>CI:</label>
          <input type="text" id="con_electrolito_cl"  name="con_electrolito_cl"/>
        </div>
        <div>
          <label>Ca:</label>
          <input type="text" id="con_electrolito_ca"  name="con_electrolito_ca"/>
        </div>
        <div>
          <label>P:</label>
          <input type="text" id="con_electrolito_p"  name="con_electrolito_p"/>
        </div>
        <div>
          <h3>Inflamatorios</h3>
        </div>
        <div>
          <label>PCR:</label>
          <input type="text" id="con_inflamatorio_pcr"  name="con_inflamatorio_pcr"/>
        </div>
      </div>
    </div>
    <div class="cont3">
      <p>Función Pulmonar</p>
      <div>
        <label>Distensibilidad dinámica:</label>
        <input type="text" id="con_pulmonar_distensibilidad_dinamica"  name="con_pulmonar_distensibilidad_dinamica"/>
      </div>
      <div>
        <label>Distensibilidad estática:</label>
        <input type="text" id="con_pulmonar_distensibilidad_estatica"  name="con_pulmonar_distensibilidad_estatica" />
      </div>
      <div>
        <label>Resistencia:</label>
        <input type="text" id="con_pulmonar_distensibilidad_resistnecia"  name="con_pulmonar_distensibilidad_resistnecia"/>
      </div>
      <div>
        <label>Cte. Tpo:</label>
        <input type="text" id="con_pulmonar_distensibilidad_cte_tpo"  name="con_pulmonar_distensibilidad_cte_tpo" />
      </div>
      <div>
        <label>C20/C:</label>
        <input type="text" id="con_pulmonar_distensibilidad_c20c"  name="con_pulmonar_distensibilidad_c20c"/>
      </div>
      <div>
        <label>P0,1:</label>
        <input type="text" id="con_pulmonar_po1"  name="con_pulmonar_po1"/>
      </div>
    </div>
    <div class="cont3">
      <p>VAFO</p>
      <div>
        <label>Frecuencia</label>
        <input type="text" id="con_vafo_frecuencia1"  name="con_vafo_frecuencia1"/>
      </div>
      <div>
        <label>Amplitud:</label>
        <input type="text" id="con_vafo_amplitud"  name="con_vafo_amplitud"/>
      </div>
      <div>
        <label>Delta P:</label>
        <input type="text" id="con_vafo_delta_p"  name="con_vafo_delta_p"/>
      </div>
      <div>
        <label>Flujo base</label>
        <input type="text" id="con_vafo_flujo_base"  name="con_vafo_flujo_base"/>
      </div>
      <div class="sub-contenedor">
        <label>Alarmas:</label>
        <input type="text" placeholder="Alta" id="con_vafo_alarma_alta"  name="con_vafo_alarma_alta" />
      </div>
      <div class="sub-contenedor">
        <label>Alarmas:</label>
        <input type="text" placeholder="Baja" id="con_vafo_alarma_baja"  name="con_vafo_alarma_baja"/>
      </div>
    </div>
    <div class="cont3">
      <div>
        <label>Respaldo</label>

     



 <select id="con_respaldo"  name="con_respaldo">
          <option value="">Respaldo</option>
            <?php foreach($rel5 as $dat){ ?>
            <option <?php echo " SELECTED";?> value="<?=$dat->codigo?>"><?=$dat->nombre ?></option>
          <?php } ?>
        </select>


   
      </div>
    </div>


     


    <div class="cont3">
      <div class="sub-contenedor">
        <label>Cambio circuito:</label>
        <select id="con_cambio_circuito_1"  name="con_cambio_circuito_1">
  <option value="1">Si</option>
          <option value="0">No</option>        </select>
      </div>


      <div class="sub-contenedor">

         <div>
        <label>Fecha de cambio: </label>
        <input type="text" id="datepicker_2" name="con_fecha_cambio" value="<?=@$dato->fecha_cambio?>" />
        <i class="fa fa-calendar"></i> </div>



        <!--<label>Fecha de cambio:</label>
        <div>
          <input type="text" id="con_fecha_cambio" name="con_fecha_cambio" value="<?=@$dato->fecha_cambio?>" />
        <i class="fa fa-calendar"></i> </div>--></div>
      <div>
        <label>Aseo diario</label>
        <select id="con_aseo_diario_2"  name="con_aseo_diario_2">
  <option value="1">Si</option>
          <option value="0">No</option>        </select>
      </div>
      

    </div>
    <div class="cont3">
      <p>iNO</p>
      <div>
        <label>NO</label>
        <input type="text" id="con_ino_no"  name="con_ino_no"/>
      </div>
      <div>
        <label>NO2</label>
        <input type="text" id="con_ino_no2"  name="con_ino_no2"/>
      </div>
      <div>
        <label>FiO2</label>
        <input type="text" id="con_ino_fio2"  name="con_ino_fio2"  />
      </div>
      <div>
        <label>Carga</label>
        <input type="text"  id="con_ino_carga"  name="con_ino_carga" />
      </div>
      <div>
        <label>iNO meter</label>
        <input type="text"  id="con_ino_meter"  name="con_ino_meter" />
      </div>
      <div>
        <label>Calibración baja</label>
        <input type="text"  id="con_ino_calibracion_baja"  name="con_ino_calibracion_baja" />
      </div>
      <div>
        <label>Calibración alta</label>
        <input type="text" id="con_ino_calibracion_alta"  name="con_ino_calibracion_alta" />
      </div>
      <div>
        <label>Calibración</label>
        <input type="text" id="con_ino_calibracion_"  name="con_ino_calibracion_" />
      </div>
      <div>
        <label>Desinfección</label>
        <input type="text" id="con_ino_desinfeccion"  name="con_ino_desinfeccion" />
      </div>
      <div>
        <label>PSI actuales</label>
        <input type="text" id="con_ino_psi_actuales"  name="con_ino_psi_actuales" />
      </div>
      <div class="sub-contenedor">
        <label>Nro de serie balon:</label>
        <input type="text" id="con_ino_numero_serie_balon"  name="con_ino_numero_serie_balon" />
      </div>
      <div class="sub-contenedor">
        <label>Consumo últimas 24 hrs:</label>
        <input type="text" id="con_ino_consumo_24_horas"  name="con_ino_consumo_24_horas" />
      </div>
    </div>
    <div class="cont3">
      <p>ECMO</p>
      <div>
        <label>FiO2 ECMO / Volumen CUFF</label>
        <input type="text" id="con_ecmo_fio2_volumen_cuff"  name="con_ecmo_fio2_volumen_cuff" />
      </div>
      <div>
        <label>Flujo aire / O2 / Presión CUFF</label>
        <input type="text" id="con_ecmo_flujo_aire_o2_presion_cuff"  name="con_ecmo_flujo_aire_o2_presion_cuff" />
      </div>
      <div>
        <label>Flujo CO2 / N2</label>
        <input type="text" id="con_ecmo_co2_n2"  name="con_ecmo_co2_n2" />
      </div>
      <div>
        <label>Carga CO2 / N2</label>
        <input type="text" id="con_ecmo_carga_co2_n2"  name="con_ecmo_carga_co2_n2" />
      </div>


  <label for="con_estado" class="col-sm-4 control-label">Estado:</label>
      <div class="col-sm-7">
        <select id="con_estado"  name="con_estado">
            <option value="1">Activo</option>
            <option value="0">Inactivo</option>
        </select>
      </div>
    </div>


    </div>
     <div class="fondo-botones">
      <div class="btn-group">
        <!--<input type="submit" value="Enviar">-->
        <button type="submit">Guardar</button>
      </div>
    </div>
  </form>
</div>

   <!-- <a href="#" data-toggle="modal" data-target="#modal-avisolegal">Leer Aviso Legal </a>-->


 <!--<div role="dialog" tabindex="-1" class="modal fade" id="modal-avisolegal" 
style="max-width:600px;margin-right:auto;margin-left:auto;">
   <div class="modal-dialog" role="document">
     <div class="modal-content">
       <div class="modal-header"> 
       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
       <h4 class="text-center modal-title">Aviso Legal</h4>
       </div>
       <div class="modal-body"> 
       <p>TEXTO A MOSTRAR</p>
       </div>
       <div class="modal-footer"> 
       <button class="btn btn-default btn btn-primary btn-lg" type="button" data-dismiss="modal">Cerrar </button>
       </div>
     </div>
   </div>
</div>-->

<script>
 function Calcular() {
 var vr1 = document.getElementById('con_presion_sistolica').value;
 var vr2 = document.getElementById('con_presion_diastolica').value;
 var p = (parseFloat(vr1)+parseFloat(vr2 * 2))/3;
var p = isNaN(parseInt(p)) ? 0 : parseInt(p) 
document.getElementById('con_presion_arterial_media').innerHTML = p;
$("#con_presion_arterial_media2").val(p);
 }
</script>

<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>-->



   <!--<script src = "js / jquery.validationEngine.min.js" type = "text / javascript" charset = "utf-8"> </ script> -->
