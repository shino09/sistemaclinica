<div class="navegacion">
  <div class="center">
    <?=$this->layout->getNav();?>
  </div>
</div>
<div class="center">
  <h2>Detalle pago</h2>
  </a>
  <div class="clear"></div>
  <div class="filtros1"> <span style="margin-right: 20px;">Filtrar por:</span>
    <div>
      <input type="text" id="datepicker" placeholder="Desde"/>
      <i class="fa fa-calendar"></i> </div>
    <div>
      <input type="text" id="datepicker_2" placeholder="Hasta"/>
      <i class="fa fa-calendar"></i> </div>
    <div>
      <button>Filtrar</button>
    </div>
  </div>
  <div class="contenedor-tabla"> 
    <button class="btn-exportar-tabla">Exportar a excel</button>
    <table>
      <thead>
        <tr>
          <th scope="col">Kinesiologo</th>
          <th scope="col">Horas en turno</th>
          <th scope="col">Horas Extra</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td data-label="Kinesiologo">Nombre</td>
          <td data-label="Horas en turno">Horas en turno</td>
          <td data-label="Horas Extra">Horas extras</td>
          <td data-label="Opciones"></i><i class="fa fa-print celeste"></i></td>
        </tr>
        <tr>
          <td data-label="Kinesiologo">Nombre</td>
          <td data-label="Horas en turno">Horas en turno</td>
          <td data-label="Horas Extra">Horas extras</td>
          <td data-label="Opciones"></i><i class="fa fa-print celeste"></i></td>
        </tr>
        <tr>
          <td data-label="Kinesiologo">Nombre</td>
          <td data-label="Horas en turno">Horas en turno</td>
          <td data-label="Horas Extra">Horas extras</td>
          <td data-label="Opciones"></i><i class="fa fa-print celeste"></i></td>
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
