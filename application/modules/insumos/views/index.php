<div class="navegacion">
  <div class="center">
    <?=$this->layout->getNav();?>
  </div>
</div>
<div class="center">
  <h2>Insumos</h2>
  <a href="/insumos/agregar-insumo">
  <button class="btn-agregar">Agregar nuevo insumo</button>
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
    <input type="checkbox" /> Con alerta stock
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
          <th scope="col">Descripción</th>
          <th scope="col">Stock Actual</th>
          <th scope="col">Precio</th>
          <th scope="col">Estado</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td data-label="Nombre">Nombre</td>
          <td data-label="Tipo"></td>
          <td data-label="Descripción"></td>
          <td data-label="Stock Actual"></td>
          <td data-label="Precio"></td>
          <td data-label="Estado"></td>
          <td><i class="fa fa-plus verde"></i><i class="fa fa-edit celeste"></i><i class="fa fa-eye gris"></i> <i class="fa fa-trash rojo"></i></td>
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
