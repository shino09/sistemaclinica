<div class="page-header">
	<div class="pull-right">
		<button onclick="javascript:location.href='<?php echo base_url(); ?>/usuarios/crear/'" type="button" class="btn btn-primary">Agregar</button>
	</div>
	<h1>Usuarios</h1>
	<div class="row filtro">
		<form role="form" action="<?php echo base_url(); ?>/usuarios/" method="get">
			<div class="col-lg-4">
				<div style="margin-top:15px;" class="form-group input-group">
					<input type="text" name="q" class="form-control" value="<?php echo (isset($q_f))?$q_f:''; ?>" />
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
				<th scope="col">Nombre</th>
				<th scope="col">Exportar</th>
				<th scope="col" class="last"></th>
			</tr>
		</thead>
		<tbody>
			<?php if($usuarios){ ?>
				<?php foreach($usuarios as $aux){ ?>
					<tr>
						<td><a href="<?php echo base_url(); ?>/usuarios/editar/<?php echo $aux->codigo; ?>/"><?php echo $aux->nombre; ?></a></td>
						<td>
							<a href="<?php echo base_url(); ?>/usuarios/exportar_pdf/<?php echo $aux->codigo; ?>/"><button title="Exportar PDF" type="button" class="btn btn-success btn-sm">Documentación PDF</button></a>
						</td>
                        <td class="editar">
							<a href="<?php echo base_url(); ?>/usuarios/editar/<?php echo $aux->codigo; ?>/"><button title="Editar" type="button" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button></a>
							<button title="Eliminar" type="button" rel="<?php echo $aux->codigo; ?>" class="btn btn-danger btn-sm eliminar"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
						</td>
					</tr>
				<?php } ?>
			<?php } else{ ?>
				<tr>
					<td colspan="2" style="text-align:center;"><i>No hay registros</i></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>
<?php echo $pagination; ?>