<div class="navegacion">
  <div class="center">
    <?=$this->layout->getNav();?>
  </div>
</div>
<div class="center">
  <h2>Pacientes</h2>
  <div class="filtros1"> <span style="margin-right: 20px;">Filtrar por:</span>
    <div>
      <select>
        <option>Centros Médicos</option>
      </select>
    </div>
    <div>
      <select>
        <option>Unidad</option>
      </select>
    </div>
    <div>
      <select>
        <option>Equipos</option>
      </select>
    </div>
    <div>
      <select>
        <option>Estado</option>
      </select>
    </div>
    <div>
      <button>Filtrar</button>
    </div>
  </div>
  <div class="filtros2">
    <div> <i class="fa fa-calendar"></i>
      <input type="text" value="Desde" id="datepicker"/>
    </div>
    <div> <i class="fa fa-calendar"></i>
      <input type="text" value="Hasta" id="datepicker_2"/>
    </div>
    <div>
      <button>Filtrar</button>
    </div>
  </div>
  <span class="clear"></span>
  <div class="contenedor-tabla">
    <button class="btn-exportar-tabla">Exportar a excel</button>
    <table>
      <thead>
        <tr>
          <th scope="col">Centro médico</th>
          <th scope="col">Unidad</th>
          <th scope="col">Nº Cámara</th>
          <th scope="col">Nombre Completo</th>
          <th scope="col">Rut</th>
          <th scope="col">Edad</th>
          <th scope="col">Fecha de ingreso</th>
          <th scope="col">Diagnostico</th>
          <th scope="col">Equipos</th>
          <th scope="col">Insumo</th>
          <th scope="col">Modo ventilatorio</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td data-label="Centro Médico">Centro médico</td>
          <td data-label="Unidad">Unidad</td>
          <td data-label="Nº Cámara">12</td>
          <td data-label="Nombre Completo">Ricardo Antonio Uriarte Péndola</td>
          <td data-label="Rut">17.987.234-9</td>
          <td data-label="Edad">32</td>
          <td data-label="Fecha de Ingreso">12-05-17</td>
          <td data-label="Diagnostico">Diagnostico</td>
          <td data-label="Equipos">Equipos</td>
          <td data-label="Insumo">Insumo</td>
          <td data-label="Modo Ventilatorio">Modo ventilatorio</td>
        </tr>
        <tr>
          <td data-label="Centro Médico">Centro médico</td>
          <td data-label="Unidad">Unidad</td>
          <td data-label="Nº Cámara">12</td>
          <td data-label="Nombre Completo">Ricardo Antonio Uriarte Péndola</td>
          <td data-label="Rut">17.987.234-9</td>
          <td data-label="Edad">32</td>
          <td data-label="Fecha de Ingreso">12-05-17</td>
          <td data-label="Diagnostico">Diagnostico</td>
          <td data-label="Equipos">Equipos</td>
          <td data-label="Insumo">Insumo</td>
          <td data-label="Modo Ventilatorio">Modo ventilatorio</td>
        </tr>
        <tr>
          <td data-label="Centro Médico">Centro médico</td>
          <td data-label="Unidad">Unidad</td>
          <td data-label="Nº Cámara">12</td>
          <td data-label="Nombre Completo">Ricardo Antonio Uriarte Péndola</td>
          <td data-label="Rut">17.987.234-9</td>
          <td data-label="Edad">32</td>
          <td data-label="Fecha de Ingreso">12-05-17</td>
          <td data-label="Diagnostico">Diagnostico</td>
          <td data-label="Equipos">Equipos</td>
          <td data-label="Insumo">Insumo</td>
          <td data-label="Modo Ventilatorio">Modo ventilatorio</td>
        </tr>
        <tr>
          <td data-label="Centro Médico">Centro médico</td>
          <td data-label="Unidad">Unidad</td>
          <td data-label="Nº Cámara">12</td>
          <td data-label="Nombre Completo">Ricardo Antonio Uriarte Péndola</td>
          <td data-label="Rut">17.987.234-9</td>
          <td data-label="Edad">32</td>
          <td data-label="Fecha de Ingreso">12-05-17</td>
          <td data-label="Diagnostico">Diagnostico</td>
          <td data-label="Equipos">Equipos</td>
          <td data-label="Insumo">Insumo</td>
          <td data-label="Modo Ventilatorio">Modo ventilatorio</td>
        </tr>
        <tr>
          <td data-label="Centro Médico">Centro médico</td>
          <td data-label="Unidad">Unidad</td>
          <td data-label="Nº Cámara">12</td>
          <td data-label="Nombre Completo">Ricardo Antonio Uriarte Péndola</td>
          <td data-label="Rut">17.987.234-9</td>
          <td data-label="Edad">32</td>
          <td data-label="Fecha de Ingreso">12-05-17</td>
          <td data-label="Diagnostico">Diagnostico</td>
          <td data-label="Equipos">Equipos</td>
          <td data-label="Insumo">Insumo</td>
          <td data-label="Modo Ventilatorio">Modo ventilatorio</td>
        </tr>
      </tbody>
    </table>
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
</div>
