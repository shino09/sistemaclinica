<div class="navegacion">
  <div class="center">
    <?=$this->layout->getNav();?>
  </div>
</div>
<div class="center">
  <h2>Modos ventilatorios</h2>
  <a href="/modos-ventilatorios/agregar-modo-ventilatorio">
  <button class="btn-agregar">Agregar modo ventilatorio</button>
  </a>
  <div class="clear"></div>
  <div class="filtros1 filtros-centro"> <span style="margin-right: 20px;">Filtrar por:</span>
    <div>
      <select>
        <option>Estado</option>
        <option>Activo</option>
        <option>Inactivo</option>
      </select>
    </div>
    <div>
      <input type="text"  placeholder="Nombre"/>
    </div>
    <div>
      <button>Filtrar</button>
    </div>
  </div>
  <div class="contenedor-tabla"> 
    <!--<button class="btn-exportar-tabla">Exportar a excel</button>-->
    <table>
      <thead>
        <tr>
          <th scope="col">Nombre</th>
          <th scope="col">Tipo</th>
          <th scope="col">Estado</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td data-label="Nombre">Nombre</td>
          <td data-label="Estado">Estado</td>
          <td data-label="Tipo" scope="col">Tipo</th>
          <td data-label="Opciones"></i><i class="fa fa-edit celeste"></i><i class="fa fa-trash rojo"></i></td>
        </tr>
        <tr>
          <td data-label="Nombre">Nombre</td>
          <td data-label="Estado">Estado</td>
          <td data-label="Tipo" scope="col">Tipo</th>
          <td data-label="Opciones"></i><i class="fa fa-edit celeste"></i><i class="fa fa-trash rojo"></i></td>
        </tr>
        <tr>
          <td data-label="Nombre">Nombre</td>
          <td data-label="Estado">Estado</td>
          <td data-label="Tipo" scope="col">Tipo</th>
          <td data-label="Opciones"></i><i class="fa fa-edit celeste"></i><i class="fa fa-trash rojo"></i></td>
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


