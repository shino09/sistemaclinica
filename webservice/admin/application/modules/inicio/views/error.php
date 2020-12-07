<div id="page-wrapper">
	<div class="row col-lg-12 mb-j3">
		<a  style="cursor:pointer;" onClick="history.go(-1);" class="btn btn-primary btn-lg"><i class="icon-arrow-left" style=" margin-right:5px;"></i>Volver</a>
	</div>  

	<div class="row mb-j">
		<div class="col-lg-12">
			<h1>Ha ocurrido un error inesperado</h1>
		</div>
	</div>
	
	<?php if(isset($error)){ ?>
		<div class="row mb-j">
			<div class="col-lg-12">
				<h4><?php echo $error; ?></h4>
			</div>
		</div>
	<?php } ?>
</div>  