
<div class="center"> 
  <!-- [LOGO] -->

    <!-- <?php
                $tam = 8;
             
                    
                if($notificaciones)
                    $tam -= 2;
            
            ?>-->
  <div id="logo">
    <?php if(isset($home_indicador)){ ?>
    <h1>Pyme Base Framework 3.0, Versión 2012</h1>
    <?php } else{ ?>
    <a href="/" title="Inicio: Tecla de Acceso 0" accesskey="0"><img src="/imagenes/template/logo.jpg" width="109" height="108" alt="Pyme Base Framework 3.0, Versión 2015" /></a> 
  
    <?php } ?>
  </div>


 <?php if($notificaciones){ ?>
                <div class="col-md-2">
                    <div class="dropdown">
                        <button id="mibotonctm" class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                            Notificaciones (<span class="not-cantidad"><?php echo count($notificaciones); ?></span>)
                            <span class="caret"></span>  
                        </button>
                        <ul class="dropdown-menu">
                            <?php foreach($notificaciones as $aux){ ?>
                                <li>
                                    <a class="notificacion_vista" rel="<?php echo $aux->codigo;?>" href="<?php echo $aux->enlace; ?>"><?php echo $aux->notificacion; ?></a>
                                </li>
                                <li class="divider" rel="<?php echo $aux->codigo;?>"></li>  
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <script>
                    $(function(){
                        $(".notificacion_vista").click(function(e){
                            e.preventDefault();
                            var href = $(this).attr('href');
                            var notificacion = $(this).attr('rel');
                            var obj = $(this);
                            $.ajax({
                          url: "/inicio/notificacion_vista/",
                          type: 'post',
                          dataType: 'json',
                          data: 'notificacion='+notificacion, 
                          success: function(json){
                                    if(href != "")
                                        window.location.href = href;
                                    else{
                                        obj.parent().remove();
                                        $(".divider[rel="+notificacion+"]").remove();
                                        $(".not-cantidad").text(parseInt($(".not-cantidad").text()) - 1);
                                    }
                          }
                        });
                        });
                    });
                </script>
            <?php } ?>
  <div class="user">
    <button class="menu"><i class="fa fa-bars" aria-hidden="true"></i></button>
    <div class="dropmenu" style="display: none;">
      <ul>
        <li><a href="/fichas_clinicas/pacientes"><i class="fa fa-users"></i> Pacientes</a></li>
        <li><a href="/fichas_clinicas/fichas_clinicas"><i class="fa fa-file-text-o"></i> Fichas Clínicas</a></li>
        <li><a href="/mantenedores/centros_medicos"><i class="fa fa-hospital-o"></i> Centros Médicos2</a></li>
        <li><a href="/mantenedores/insumos"><i class="fa fa-flask"></i> Insumos</a></li>
      </ul>
    </div>
    <button class="config-btn"><i class="fa fa-cog"></i></button>
    <div class="menuconfig" style="display:none"> <a href="/mantenedores/tipos_de_control">Tipos de control</a> <a href="/mantenedores/equipos">Equipos</a> <a href="/mantenedores/usuarios">Usuarios del sistema</a> <a href="/mantenedores/kinesiologos">Kinesiologos</a> <a href="/mantenedores/modos_ventilatorios">Modos ventilatorios</a> <a href="/mantenedores/horarios/administrar/1">Horarios</a> </div>
    <div class="usuario"><i class="fa fa-user-circle-o"></i> <?=$this->session->userdata('usuario_sa')->email?> <i class="fa fa-caret-down" aria-hidden="true" style="margin-left: 7px;"></i></div>
    <div class="dropdown">

       <ul id="top-usuario">
    <li><span class="btn-usuario" data-toggle="dropdown"><img class="img-circle" src="<?=$this->session->userdata('usuario_sa')->imagen?> " width="40" height="40" alt="<?=$this->session->userdata('usuario_sa')->nombre?>" /> <?=$this->session->userdata('usuario_sa')->nombre?> <i class="caret"></i></span>
     <!-- <ul class="dropdown-menu" role="menu" aria-labelledby="btnGroupVerticalDrop2">
        <li><a href="/editar-mis-datos/"><i class="glyphicon glyphicon-user"></i> Mi perfil</a></li>
        <li><a href="/logout"><i class="glyphicon glyphicon-log-out"></i> Cerrar sesión</a></li>
      </ul>-->
    </li>
  </ul>

      <ul>
        <li><a href="/editar-mis-datos/"><i class="fa fa-user"></i> Mi perfil</a></li>
        <li><a href="/logout"><i class="fa fa-sign-out"></i> Cerrar sesión </li>
      </ul>
    </div>
    <div class="clear"></div>
  </div>
  <div class="nav">
    <ul>
      <li><a href="/fichas_clinicas/pacientes"><i class="fa fa-users"></i> Pacientes</a></li>
      <li><a href="/fichas_clinicas/fichas_clinicas"><i class="fa fa-file-text-o"></i> Fichas Clínicas</a></li>
      <li><a href="/mantenedores/centros_medicos"><i class="fa fa-hospital-o"></i> Centros Médicos</a></li>
      <li><a href="/mantenedores/insumos"><i class="fa fa-flask"></i> Insumos</a></li>
    </ul>
  </div>
  <div class="clear"></div>
</div>
<script>
    $(".usuario").click(function(){
        $(".dropdown").fadeToggle();
});

    $(".menu").click(function(){
        $(".dropmenu").fadeToggle();
});

    $(".config-btn").click(function(){
        $(".menuconfig").fadeToggle();
});


</script>