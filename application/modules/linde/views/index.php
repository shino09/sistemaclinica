<div class="navegacion">
  <div class="center">
    <?=$this->layout->getNav();?>
  </div>
</div>
<div class="center">
  <h2>Pacientes con Oxido Nitrico</h2>
  <div class="filtros1"> <span style="margin-right: 20px;">Filtrar por:</span>
    <div>
      <select>
        <option>Centros Médicos</option>
      </select>
    </div>
   <div>
       <select>
        <option>Estado</option>
      </select>
   </div>
    <div> <i class="fa fa-calendar"></i>
      <input type="text" id="datepicker" placeholder="Desde" />
    </div>
    <div> <i class="fa fa-calendar"></i>
      <input type="text" id="datepicker_2" placeholder="Hasta" />
    </div>
    <div>
      <input type="text"  placeholder="Nombre y/o apellido"/>
    </div>
    <div>
      <button>Filtrar</button>
    </div>
  </div>
  <div class="contenedor-tabla">
    <button class="btn-exportar-tabla">Exportar a excel</button>
    <table>
      <thead>
        <tr>
          <th scope="col">Centro médico</th>
          <th scope="col">Servicio</th>
          <th scope="col">Nombre Completo</th>
          <th scope="col">Rut</th>
          <th scope="col">Fecha y Hora de Conexión</th>
          <th scope="col">Fecha y Hora de Desconexión</th>
          <th scope="col">Total de Horas</th>
          <th scope="col">Llamados Extras</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td data-label="Centro Médico">Centro médico</td>
          <td data-label="Servicio">Servicio</td>
          <td data-label="Nombre Completo">Nombre Completo</td>
          <td data-label="Rut">Rut</td>
          <td data-label="Fecha y Hora de Conexión">Fecha y Hora de Conexión</td>
          <td data-label="Fecha y Hora de Desconexión">Fecha y Hora de Desconexión</td>
          <td data-label="Total de Horas">Total de Horas</td>
          <td data-label="Llamados extras"><a href="#">Ver detalle</a></td>
          <td><i class="fa fa-print" style="font-size: 17px;"></i></td>
        </tr>
        <tr>
          <td data-label="Centro Médico">Centro médico</td>
          <td data-label="Servicio">Servicio</td>
          <td data-label="Nombre Completo">Nombre Completo</td>
          <td data-label="Rut">Rut</td>
          <td data-label="Fecha y Hora de Conexión">Fecha y Hora de Conexión</td>
          <td data-label="Fecha y Hora de Desconexión">Fecha y Hora de Desconexión</td>
          <td data-label="Total de Horas">Total de Horas</td>
          <td data-label="Llamados extras"><a href="#">Ver detalle</a></td>
          <td><i class="fa fa-print" style="font-size: 17px;"></i></td>
        </tr>
        <tr>
          <td data-label="Centro Médico">Centro médico</td>
          <td data-label="Servicio">Servicio</td>
          <td data-label="Nombre Completo">Nombre Completo</td>
          <td data-label="Rut">Rut</td>
          <td data-label="Fecha y Hora de Conexión">Fecha y Hora de Conexión</td>
          <td data-label="Fecha y Hora de Desconexión">Fecha y Hora de Desconexión</td>
          <td data-label="Total de Horas">Total de Horas</td>
          <td data-label="Llamados extras"><a href="#">Ver detalle</a></td>
          <td><i class="fa fa-print" style="font-size: 17px;"></i></td>
        </tr>
        <tr>
          <td data-label="Centro Médico">Centro médico</td>
          <td data-label="Servicio">Servicio</td>
          <td data-label="Nombre Completo">Nombre Completo</td>
          <td data-label="Rut">Rut</td>
          <td data-label="Fecha y Hora de Conexión">Fecha y Hora de Conexión</td>
          <td data-label="Fecha y Hora de Desconexión">Fecha y Hora de Desconexión</td>
          <td data-label="Total de Horas">Total de Horas</td>
          <td data-label="Llamados extras"><a href="#">Ver detalle</a></td>
          <td><i class="fa fa-print" style="font-size: 17px;"></i></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="paginacion">
    <ul>
      <li><a href="#"><<</a></li>
      <li><a href="#">1</a></li>
      <li><a href="#">2</a></li>
      <li><a href="#">3</a></li>
      <li><a href="#">>></a></li>
    </ul>
  </div>
</div>
<style type="text/css">
	.filtros1 div{
		width: 13%;
	}
@media screen and (max-width: 1070px){
	.filtros1 div{
    width: 19%;
	}
	.filtros1 div button{
    margin-top: 20px;
	}
}
@media screen and (max-width: 950px){
	.filtros1 div button{
    margin-top: 0px;
	}
}
@media screen and (max-width: 950px){
	.filtros1 div {
    width: 100%;
	}
}

</style>
