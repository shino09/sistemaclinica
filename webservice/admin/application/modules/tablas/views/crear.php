<style>
.readonly{
	background-color:white!important;
}
</style>

<div class="page-header">
	<h1>Crear Tabla</h1>
</div>

<ul class="nav nav-tabs">
	<li class="active"><a href="#generales" data-toggle="tab">Tabla</a></li>
	<li class="disabled"><a href="#">Campos</a></li>
</ul>


<div class="tab-content">
	<div class="tab-pane active" id="generales">
        <form action="#" method="post" id="form-agregar-tabla" class="form-horizontal">
    		<fieldset>
                <h3>Información tabla</h3>
    			<div class="form-group">
    				<label for="nombre" class="col-sm-2 control-label">Nombre</label>
    				<div class="col-sm-4">
    					<input type="text" id="nombre" name="nombre" class="form-control validate[required]" />
    				</div>
    			</div>
                
                <div class="form-group">
    				<label for="prefijo" class="col-sm-2 control-label">Prefijo</label>
    				<div class="col-sm-2">
    					<input type="text" id="prefijo" name="prefijo" class="form-control validate[required]" />
    				</div>
                    <div class="col-sm-1">
    					<input style="width:auto;height:auto;margin-top:10px;float:left;" type="checkbox" title="Generar prefijo" id="prefijo_aleatorio" class="form-control" />
    				    <label style="float:left;" for="generar-prefijo" class="col-sm-2 control-label">Generar</label>
                    </div>
    			</div>
                
                <div class="form-group">
    				<label for="comentario" class="col-sm-2 control-label">Comentario</label>
    				<div class="col-sm-4">
    					<textarea id="comentario" name="comentario" class="form-control" rows="5"></textarea>
                    </div>
    			</div>
                
    			<div class="text-center">
    				<button type="submit" class="btn btn-primary btn-lg">Guardar</button>
    			</div>
    		</fieldset>
        </form>
	</div>
</div>
