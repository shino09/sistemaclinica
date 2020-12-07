
<?php if(isset($home_indicador)){ ?>

<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="navbar-header"> <span class="navbar-brand"><img src="/imagenes/template/logo.png" height="40" alt="WebService" /></span> </div>
</nav>
<?php } else{ ?>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
    <span class="navbar-brand"><img src="/imagenes/template/logo.png" height="40" alt="WebService" /></span> </div>
  <div class="collapse navbar-collapse navbar-ex1-collapse" id="menu">
    <ul class="nav navbar-nav navbar-right navbar-user">
      <li class="dropdown user-dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i> <?php echo ($this->session->userdata('usuario'))?$this->session->userdata('usuario')->email:''; ?> <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="<?php echo base_url(); ?>/logout/"><i class="icon-power-off"></i> Cerrar sesión</a></li>
        </ul>
      </li>
    </ul>
    <ul class="nav navbar-nav side-nav">
      <li><a href="<?php echo base_url(); ?>/tablas/">Tablas</a></li>
      <li><a href="<?php echo base_url(); ?>/vistas/">Vistas</a></li>
      <li><a href="<?php echo base_url(); ?>/triggers/">Triggers</a></li>
      <li><a href="<?php echo base_url(); ?>/historial/">Historial</a></li>
      <li><a href="<?php echo base_url(); ?>/usuarios/">Cuentas de usuario</a></li>
      <li><a href="<?php echo base_url(); ?>/contenido/">Contenido</a></li>
    </ul>
  </div>
</nav>
<?php } ?>
