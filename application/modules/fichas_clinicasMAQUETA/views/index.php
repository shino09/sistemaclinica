<div class="navegacion">
  <div class="center">
    <?=$this->layout->getNav();?>
  </div>
</div>
<div class="center">
  <h2>Fichas Clínicas</h2>
    <a href="/fichas-clinicas/agregar-nuevo-paciente"><button class="btn-agregar">Agregar nueva ficha clínica</button></a>
    <div class="clear"></div>
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
          <th scope="col">Unidad</th>
          <th scope="col">Fecha de Ingreso</th>
          <th scope="col">Hora</th>
          <th scope="col">Nombre Completo</th>
          <th scope="col">Rut</th>
          <th scope="col">Estado</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td data-label="Centro Médico">Centro médico</td>
          <td data-label="Unidad">Unidad</td>
          <td data-label="Fecha de Ingreso">21-01-2017</td>
          <td data-label="Hora">21:15hrs</td>
          <td data-label="Nombre Completo">Ricardo Antonio Uriarte Péndola </td>
          <td data-label="Estado">Activo</td>
          <td><i class="fa fa-plus verde"></i> <i class="fa fa-eye gris"></i> <i class="fa fa-edit celeste"></i> <i class="fa fa-trash rojo"></i></td>
        </tr>
        <tr>
          <td data-label="Centro Médico">Centro médico</td>
          <td data-label="Unidad">Unidad</td>
          <td data-label="Fecha de Ingreso">21-01-2017</td>
          <td data-label="Hora">21:15hrs</td>
          <td data-label="Nombre Completo">Ricardo Antonio Uriarte Péndola </td>
          <td data-label="Estado">Activo</td>
          <td><i class="fa fa-plus verde"></i> <i class="fa fa-eye gris"></i> <i class="fa fa-edit celeste"></i> <i class="fa fa-trash rojo"></i></td>
        </tr>
        <tr>
          <td data-label="Centro Médico">Centro médico</td>
          <td data-label="Unidad">Unidad</td>
          <td data-label="Fecha de Ingreso">21-01-2017</td>
          <td data-label="Hora">21:15hrs</td>
          <td data-label="Nombre Completo">Ricardo Antonio Uriarte Péndola </td>
          <td data-label="Estado">Activo</td>
          <td><i class="fa fa-plus verde"></i> <i class="fa fa-eye gris"></i> <i class="fa fa-edit celeste"></i> <i class="fa fa-trash rojo"></i></td>
        </tr>
        <tr>
          <td data-label="Centro Médico">Centro médico</td>
          <td data-label="Unidad">Unidad</td>
          <td data-label="Fecha de Ingreso">21-01-2017</td>
          <td data-label="Hora">21:15hrs</td>
          <td data-label="Nombre Completo">Ricardo Antonio Uriarte Péndola </td>
          <td data-label="Estado">Activo</td>
          <td><i class="fa fa-plus verde"></i> <i class="fa fa-eye gris"></i> <i class="fa fa-edit celeste"></i> <i class="fa fa-trash rojo"></i></td>
        </tr>
        <tr>
          <td data-label="Centro Médico">Centro médico</td>
          <td data-label="Unidad">Unidad</td>
          <td data-label="Fecha de Ingreso">21-01-2017</td>
          <td data-label="Hora">21:15hrs</td>
          <td data-label="Nombre Completo">Ricardo Antonio Uriarte Péndola </td>
          <td data-label="Estado">Activo</td>
          <td><i class="fa fa-plus verde"></i> <i class="fa fa-eye gris"></i> <i class="fa fa-edit celeste"></i> <i class="fa fa-trash rojo"></i></td>
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
