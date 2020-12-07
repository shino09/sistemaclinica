<div class="page-header">
	<h1>Registros tabla <?php echo $tabla->nombre; ?></h1>
</div>

<ul class="nav nav-tabs">
	<li class="active"><a>Registros</a></li>
	<li><a href="<?php echo base_url(); ?>/contenido/insertar/<?php echo $tabla->codigo; ?>/" >Insertar</a></li>
</ul>

<div class="tab-content">
	<div  class="tab-pane active" id="generales">
        <div style="overflow-x: scroll; width: 100%;" class="thumbnail table-responsive all-responsive">
        	<table border="0" cellspacing="0" cellpadding="0" class="table tablesorter table-hover" style="margin-bottom:0;">
        		<thead>
        			<tr>
        				<?php foreach($tabla->campos as $aux){ ?>
                            <?php
                                $color = "";
                                if($aux->primaria)
                                    $color = 'text-warning';
                                elseif($aux->campo_relacion)
                                    $color = 'text-info';
                            ?>
                            <th class="<?php echo $color; ?>" scope="col"><?php echo $aux->nombre; ?></th>
                        <?php } ?>
        				<th scope="col" class="last"></th>
        			</tr>
        		</thead>
        		<tbody>
        			<?php if($registros){ ?>
        				<?php foreach($registros as $aux){ ?>
        					<tr>
                                <?php foreach($tabla->campos as $cam){ ?>
        						  <?php
                                    $campo = $cam->nombre_campo;
                                    $puntos = (strlen($aux->$campo)> 22)?'...':'';
                                  ?>
                                  <td><?php echo substr($aux->$campo,0,22).$puntos; ?></td>
                                <?php } ?>
        						<td style="white-space: nowrap;" class="editar">
        							<a href="<?php echo base_url(); ?>/contenido/editar/<?php echo $tabla->codigo; ?>/<?php echo $aux->codigo; ?>/"><button title="Editar" type="button" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button></a>
                                    <button title="Eliminar" type="button" rel="<?php echo $tabla->codigo.'_'.$aux->codigo; ?>" class="btn btn-danger btn-sm eliminar"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        						</td>
        					</tr>
        				<?php } ?>
        			<?php } else{ ?>
        				<tr>
        					<td colspan="<?php echo count($tabla->campos) + 1; ?>" style="text-align:center;"><i>No hay registros</i></td>
        				</tr>
        			<?php } ?>
        		</tbody>
        	</table>
        </div>
    </div>
</div>
<?php echo $pagination; ?>