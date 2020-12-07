<div class="page-header">
	<h1>Tablas</h1>
	<div class="row filtro">
		<form role="form" action="<?php echo base_url(); ?>/contenido/" method="get">
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
				<th scope="col" class="last"></th>
			</tr>
		</thead>
		<tbody>
			<?php if($tablas){ ?>
				<?php foreach($tablas as $aux){ ?>
					<tr>
						<td title="<?php echo $aux->comentario; ?>"><a href="<?php echo base_url(); ?>/contenido/registros/<?php echo $aux->codigo; ?>/"><?php echo $aux->nombre; ?></a></td>
						<td class="editar">
							<a href="<?php echo base_url(); ?>/contenido/registros/<?php echo $aux->codigo; ?>/"><button title="Editar" type="button" class="btn btn-success btn-sm"><i class="icon-search"></i></button></a>
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