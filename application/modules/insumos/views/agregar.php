<div class="navegacion">
  <div class="center">
    <?=$this->layout->getNav();?>
  </div>
</div>
<div class="center">
  <h2>Agregar nuevo insumo</h2>
  <form>
    <div class="block-inputs" style="border-bottom: 0;">
      <div>
        <label>Nombre:</label>
        <input type="text" />
      </div>
      <div>
        <label>Tipo:</label>
        <select>
          <option>Circuito</option>
          <option>Filtro</option>
        </select>
      </div>
      <div>
        <label>Stock alerta:</label>
        <input type="text" />
      </div>
      <div>
        <label>Descripción</label>
        <textarea rows="5" style="resize: none;"></textarea>
      </div>
      <div>
        <label>Precio:</label>
        <input type="text" />
      </div>
      <div> <span>Estado:</span>
        <label class="switch">
          <input type="checkbox" checked>
          <span class="slider round"></span> </label>
      </div>
    </div>
    <div class="agregar-stock" style="position: relative;">
      <h3>Stock de insumos</h3>
      <p class="cantidad-insumos">Stock actual: <strong>30</strong></p>
      <div>
        <label>Fecha: </label>
        <input type="text" id="datepicker" />
        <i class="fa fa-calendar"></i> </div>
      <div>
        <label>Cantidad: </label>
        <input type="text" />
      </div>
      <button>Agregar</button>
    </div>
    <div class="contenedor-tabla">
      <table>
        <thead>
          <tr>
            <th scope="col">Fecha</th>
            <th scope="col">Cantidad</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td data-label="Fecha">Fecha</td>
            <td data-label="Cantidad">Cantidad</td>
            <td><a href="#"><i class="fa fa-trash rojo"></i></a></td>
          </tr>
          <tr>
            <td data-label="Fecha">Fecha</td>
            <td data-label="Cantidad">Cantidad</td>
            <td><a href="#"><i class="fa fa-trash rojo"></i></a></td>
          </tr>
          <tr>
            <td data-label="Fecha">Fecha</td>
            <td data-label="Cantidad">Cantidad</td>
            <td><a href="#"><i class="fa fa-trash rojo"></i></a></td>
          </tr>
          <tr>
            <td data-label="Fecha">Fecha</td>
            <td data-label="Cantidad">Cantidad</td>
            <td><a href="#"><i class="fa fa-trash rojo"></i></a></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="fondo-botones">
      <div class="btn-group">
        <button>Crear</button>
      </div>
    </div>
    
  </form>
</div>
