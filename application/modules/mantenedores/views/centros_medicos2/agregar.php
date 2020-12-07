<div class="navegacion">
  <div class="center">
    <?=$this->layout->getNav();?>
  </div>
</div>
<div class="center">
  <h2>Agregar nuevo centro médico</h2>
  <form>
    <div class="block-inputs" style="border-bottom: 0;">
      <h3>Datos</h3>
      <div>
        <label>Nombre:</label>
        <input type="text" />
      </div>
      <div>
        <label>Dirección:</label>
        <input type="text" />
      </div>
      <div>
        <label>Teléfono:</label>
        <input type="text" />
      </div>
      <div> <span>Estado:</span>
        <label class="switch">
          <input type="checkbox" checked>
          <span class="slider round"></span> </label>
      </div>
    </div>
    <div class="agregar-unidades">
      <h3>Agregar Unidades</h3>
      <div>
        <label>Nombre: </label>
        <input type="text" />
      </div>
      <div>
        <label>Nº Camas: </label>
        <input type="text" />
      </div>
      <button>Agregar</button>
    </div>
          <div class="contenedor-tabla">
        <table>
          <thead>
            <tr>
              <th scope="col">Nombre</th>
              <th scope="col">Nº Camas</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td data-label="Nombre">Nombre</td>
              <td data-label="Nº Camas">Nº Camas</td>
              <td><a href="#"><i class="fa fa-trash"></i> Eliminar</a></td>
            </tr>
            <tr>
              <td data-label="Nombre">Nombre</td>
              <td data-label="Nº Camas">Nº Camas</td>
              <td><a href="#"><i class="fa fa-trash"></i> Eliminar</a></td>
            </tr>
            <tr>
              <td data-label="Nombre">Nombre</td>
              <td data-label="Nº Camas">Nº Camas</td>
              <td><a href="#"><i class="fa fa-trash"></i> Eliminar</a></td>
            </tr>
            <tr>
              <td data-label="Nombre">Nombre</td>
              <td data-label="Nº Camas">Nº Camas</td>
              <td><a href="#"><i class="fa fa-trash"></i> Eliminar</a></td>
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
