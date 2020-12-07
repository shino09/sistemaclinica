<script>
$(function() {
    $("#desde").datepicker({
      changeMonth: true,
      changeYear: true,
      onClose: function( selectedDate ) {
        $("#hasta").datepicker( "option", "minDate", selectedDate );
      }
    });
    $("#hasta").datepicker({
      changeMonth: true,
	  changeYear: true,
      onClose: function( selectedDate ) {
        $("#desde").datepicker( "option", "maxDate", selectedDate );
      }
    });
});
</script>

<div class="page-header">
	<h1>Historial</h1>
	<div class="row filtro">
		<form role="form" action="<?php echo base_url(); ?>/historial/" method="get">
			<div class="col-lg-4">
                <div style="margin-top:15px;" class="form-group">
    				<div class="col-lg-6 mb-j">
    					<input type="text" placeholder="Desde" class="form-control" id="desde" name="desde" value="<?php echo $desde_q; ?>" />
    				</div>
    				<div class="col-lg-6 mb-j">
    					<input type="text" placeholder="Hasta" class="form-control" id="hasta" name="hasta" value="<?php echo $hasta_q; ?>" />
    				</div>
				</div>
			</div>
            <div class="col-lg-4">
				<div style="margin-top:15px;" class="form-group input-group">
					<input type="text" name="q" class="form-control" value="<?php echo $q_f; ?>" />
					<span class="input-group-btn">
					  <button class="btn btn-default" type="submit"><i class="icon-search"></i></button>
					</span>
				</div>
			</div>
		</form>
	</div>
</div>


<div class="thumbnail table-responsive all-responsive">
	<table border="0" cellspacing="0" cellpadding="0" class="table tablesorter table-hover" style="margin-bottom:0;">
		<thead>
			<tr>
				<th scope="col">Acción</th>
				<th scope="col">Tabla</th>
				<th scope="col">Campo Anterior</th>
				<th scope="col">Campo Nuevo</th>
				<th scope="col">Usuario</th>
				<th scope="col">Fecha</th>
				<th scope="col">Comentario</th>
				<th scope="col" class="last"></th>
			</tr>
		</thead>
		<tbody>
			<?php if($historial){ ?>
				<?php foreach($historial as $aux){ ?>
					<tr>
						<td><?php echo $aux->accion->nombre; ?></td>
						<td><?php echo ($aux->tabla->nombre)?$aux->tabla->nombre:'-'; ?></td>
						<td>
                            <?php if($aux->campo_a){ ?>
                                <a href="#" class="detalle_campo" rel="<?php echo $aux->campo_a->codigo;?>"><?php echo $aux->campo_a->nombre; ?> <i class="icon-search"></i></a>
                            <?php } else echo '-'; ?>
                        </td>
						<td>
                            <?php if($aux->campo_n){ ?>
                                <a href="#" class="detalle_campo" rel="<?php echo $aux->campo_n->codigo;?>"><?php echo $aux->campo_n->nombre; ?> <i class="icon-search"></i></a>
                            <?php } else echo '-'; ?>
                        </td>
						<td><?php echo ($aux->usuario->nombre)?$aux->usuario->nombre:'-'; ?></td>
						<td><?php echo $aux->fecha; ?></td>
						<td><?php echo $aux->comentario; ?></td>
						<td class="editar">
                            <?php if($aux->deshecha) echo 'Acción Deshecha';
                            else{ ?>
							  <button title="Deshacer" type="button" rel="<?php echo $aux->codigo; ?>" class="btn btn-success btn-sm deshacer">Deshacer acción</button>
                            <?php } ?>
                        </td>
					</tr>
				<?php } ?>
			<?php } else{ ?>
				<tr>
					<td colspan="7" style="text-align:center;"><i>No hay registros</i></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>
<?php echo $pagination; ?>


<!-- Muestra detalle de los campos -->
<div class="modal fade" id="DetalleCampo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="modal-title titulo_campo" id="myModalLabel"></h3>
			</div>
			<div class="modal-body" id="contenido_campo"></div>
		</div>
	</div>
</div>
