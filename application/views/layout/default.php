<!DOCTYPE html>
<html lang="es" xml:lang="es">
<!--[if IE 6]>
<html id="ie6" dir="ltr" lang="es-ES">
<![endif]-->
<!--[if IE 7]>
<html id="ie7" dir="ltr" lang="es-ES">
<![endif]-->
<!--[if IE 8]>
<html id="ie8" dir="ltr" lang="es-ES">
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]>
<html dir="ltr" lang="es-ES">
<![endif]-->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="author" content="Aeurus Ltda.">
<meta http-equiv="Content-Language" content="es-ES">
<!-- Metas -->
<?php echo $this->layout->headMeta(); ?>

<!-- title -->
<title><?php echo $this->layout->getTitle(); ?></title>

<!-- FontAwesome -->
<link type="text/css" rel="stylesheet" href="/css/font-awesome.css">

<!-- font -->
<link href="https://fonts.googleapis.com/css?family=Hind:400,600" rel="stylesheet">

<!-- CSS -->
<?php echo $this->layout->getCss(); ?>

<!-- js -->
<script class="jsbin" src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.5.3/modernizr.min.js"></script>
<?php echo $this->layout->getJs(); ?>

<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5-els.js"></script>
<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<script src="/js/sistema/template/index.js"></script>
<![endif]-->
<link href="/favicon.ico" rel="shortcut icon" />
<?php if($this->layout->current){ ?>
<script type="text/javascript">
	$(document).ready(function(){
		$("#menu li:nth-child(<?php echo $this->layout->current; ?>)").addClass("current");
	});
</script>
<?php } ?>
</head>
<body>
<div id="wrapper">
  <header> 
    <!-- Main --> 
    <?php echo $this->load->view('main'); ?> </header>
  <!-- Contenido -->
    <?=$content_for_layout?>
  
  <!-- Footer --> 
  <?php echo $this->load->view('footer'); ?> </div>
<div id="aeurus"> <a onclick="this.target='_blank'" onkeypress="this.target='_blank'" href="http://www.aeurus.cl/" title="Diseño Web - Posicionamiento Web - Sistema Web"><img width="22" height="22" src="/imagenes/template/aeurus.png" alt="Diseño Web - Posicionamiento Web - Sistema Web" /></a> </div>
</body>

<!-- Calendar -->
<!--<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src = "js / jquery.validationEngine.min.js" type = "text / javascript" charset = "utf-8"> </script> -->

  <script type="text/javascript">
  $( function() {
    $( "#datepicker" ).datepicker();
    $( "#datepicker_2" ).datepicker();
    $( "#datepicker_3" ).datepicker();
	$( "#datepicker_4" ).datepicker();
    $( "#datepicker_5" ).datepicker();
	$( "#datepicker_6" ).datepicker();

  } );
  </script>

</html>