<h1>Escritorio</h1>
<form action="#" id="form1" name="form1" method="post">
    <div class="tabla-responsiva">
        <table width="0" border="0" cellpadding="0" class="table table-hover table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">Notificaciones</th>
                    <th scope="col">ID Evento</th>
                    <th scope="col" style="width:60px;">Check</th>
                </tr>
            </thead>
            <tbody>
                <?php if($notificaciones){ ?>
                    <?php foreach($notificaciones as $aux){ ?>
                        <tr>
                            <td><a href="<?php echo $aux->url; ?>"><?php echo $aux->nombre; ?></a></td>
                            <td><a href="<?php echo $aux->url; ?>"><?php echo $aux->evento->id; ?></a></td>
                            <td class="text-center"> 
                                <span class="relative">  
                                    <input class="styled visto" type="checkbox" name="visto[]" value="<?php echo $aux->codigo; ?>"/>
                                </span>
                            </td>
                        </tr>
                    <?php } ?>
                <?php }else{ ?>
                    <tr class="text-center">
                        <td colspan="2">Sin notificaciones</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</form>
<div class="row">
    <div class="col-sm-6" style="width:33%">
        <div class="panel panel-default">
            <div class="panel-heading text-center"> <strong>Eventos por Status</strong></div>
            <div class="panel-body text-center">
                <form action="#" method="post" class="form-grafico" id="form-grafico-estado">
                    <ul class="list-inline">
                        <li style="width:250px; margin-bottom:5px;">
                            <div class="input-group input-daterange" data-provide="datepicker">
                                <input type="text" name="desde" class="form-control" value="<?php echo date('01/m/Y'); ?>" data-date-format="dd/mm/yyyy" />
                                <div class="input-group-addon"> <span class="fa fa-calendar" style="margin:0 4px;"></span> </div>
                                <input type="text" name="hasta" class="form-control" value="<?php echo date('d/m/Y', mktime(0,0,0, date('m'), date("d", mktime(0,0,0, date('m')+1, 0, date('Y'))), date('Y'))); ?>" data-date-format="dd/mm/yyyy" />
                            </div>
                        </li>
              
                        <li style="width:250px;">
                            <select class="selectpicker" name="ejecutivo">
                                <option value="">Ejecutivo</option>
                                <?php if($ejecutivos){ ?>
                                    <?php foreach($ejecutivos as $aux){ ?>
                                        <option value="<?php echo $aux->codigo; ?>"><?php echo $aux->nombre.' '.$aux->primer_apellido.' '.$aux->segundo_apellido; ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </li>
                        
                        <li style="margin-top: 15px;" class="text-center">
                            <a class="btn btn-success" id="filtrar_grafico_estado" href="#">Filtrar</a>
                        </li>
                    </ul>
                </form>
                <div id="grafico-estado"></div>
            </div>
            
            <form action="/escritorio/exportar_excel/" method="post">
                <input type="hidden" name="grafico" value="1" />
                <input type="hidden" name="ejecutivo" value="" />
                <input type="hidden" name="desde" value="" />
                <input type="hidden" name="hasta" value="" />
                <ul class="list-group">
                    <li class="list-group-item  text-center"><a class="btn btn-success exportar_grafico" href="#"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Excel</a></li>
                </ul>
            </form>
        </div>
    </div>
  
  
    <div class="col-sm-6" style="width:33%">
        <div class="panel panel-default">
            <div class="panel-heading text-center"> <strong>Eventos por Ejecutivos</strong></div>
            <div class="panel-body text-center">
                <form action="#" method="post" class="form-grafico">
                    <ul class="list-inline">
                        <li style="width:250px; margin-bottom:5px;">
                            <div class="input-group input-daterange" data-provide="datepicker">
                                <input type="text" name="desde" class="form-control" value="<?php echo date('01/m/Y'); ?>" data-date-format="dd/mm/yyyy" />
                                <div class="input-group-addon"> <span class="fa fa-calendar" style="margin:0 4px;"></span> </div>
                                <input type="text" name="hasta" class="form-control" value="<?php echo date('d/m/Y', mktime(0,0,0, date('m'), date("d", mktime(0,0,0, date('m')+1, 0, date('Y'))), date('Y'))); ?>" data-date-format="dd/mm/yyyy" />
                            </div>
                        </li>
                        <li style="width:250px;">
                            <select class="selectpicker" name="estado">
                                <option value="">Estado</option>
                                <?php if($estados){ ?>
                                    <?php foreach($estados as $aux){ ?>
                                        <option value="<?php echo $aux->codigo; ?>"><?php echo $aux->nombre; ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </li>
                        
                        <li style="margin-top: 15px;" class="text-center">
                            <a class="btn btn-success" id="filtrar_grafico_ejecutivo" href="#">Filtrar</a>
                        </li>
                    </ul>
                </form>
                <div id="grafico-ejecutivo"></div>
            </div>
            <form action="/escritorio/exportar_excel/" method="post">
                <input type="hidden" name="grafico" value="2" />
                <input type="hidden" name="estado" value="" />
                <input type="hidden" name="desde" value="" />
                <input type="hidden" name="hasta" value="" />
                <ul class="list-group">
                    <li class="list-group-item  text-center"><a class="btn btn-success exportar_grafico" href="#"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Excel</a></li>
                </ul>
            </form>
        </div>
    </div>

    <div class="col-sm-6" style="width:33%">
        <div class="panel panel-default">
            <div class="panel-heading text-center"> <strong>Cotizaciones</strong></div>
            <div class="panel-body text-center">
                <form action="#" method="post" class="form-grafico">
                    <ul class="list-inline">
                        <li style="width:250px; margin-bottom:5px;">
                            <div class="input-group input-daterange" data-provide="datepicker">
                                <input type="text" name="desde" class="form-control" value="<?php echo date('01/m/Y'); ?>" data-date-format="dd/mm/yyyy" />
                                <div class="input-group-addon"> <span class="fa fa-calendar" style="margin:0 4px;"></span> </div>
                                <input type="text" name="hasta" class="form-control" value="<?php echo date('d/m/Y', mktime(0,0,0, date('m'), date("d", mktime(0,0,0, date('m')+1, 0, date('Y'))), date('Y'))); ?>" data-date-format="dd/mm/yyyy" />
                            </div>
                        </li>
                        <li style="width:250px; height:32px;"></li>
                        <li style="margin-top: 15px;" class="text-center">
                            <a class="btn btn-success" id="filtrar_grafico_cotizaciones" href="#">Filtrar</a>
                        </li>
                    </ul>
                </form>
                <div id="grafico-cotizaciones"></div>
            </div>
            <form action="/escritorio/exportar_excel/" method="post">
                <input type="hidden" name="grafico" value="3" />
                <input type="hidden" name="desde" value="" />
                <input type="hidden" name="hasta" value="" />
                <ul class="list-group">
                    <li class="list-group-item  text-center"><a class="btn btn-success exportar_grafico" href="#"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Excel</a></li>
                </ul>
            </form>
        </div>
    </div>


</div>
