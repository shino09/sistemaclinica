<div class="navegacion">
  <div class="center">
    <?=$this->layout->getNav();?>
  </div>
</div>
<div class="center">
  <h2>Agregar datos tipo de control</h2>
  <form>
    <div class="block-inputs">
      <div>
        <label>Nombre:</label>
        <input type="text" />
      </div>
      <div>
        <label>Descripción</label>
        <textarea rows="5" style="resize: none;"></textarea>
      </div>
      <div> <span>Estado:</span>
        <label class="switch">
          <input type="checkbox" checked>
          <span class="slider round"></span> </label>
      </div>
    </div>
    <div class="block-inputs" style="padding: 30px 0;">
      <div>
        <input type="checkbox" />
        Habilitar precio </div>
      <div>
        <label>Mañana</label>
        <input type="text" />
      </div>
      <div>
        <label>Tarde</label>
        <input type="text" />
      </div>
      <div>
        <label>Noche</label>
        <input type="text" />
      </div>
    </div>
    <div class="agregar-stock" style="position: relative;">
    <h3>Agregar insumo tipo de control</h3>
    <div>
    <label>Insumo:</label>
    <select>
      <option> Seleccione</option>
    </select>
    </div>
      <button>Agregar</button>
    </div>
    <div class="contenedor-tabla">
      <table>
          <tr>
            <td class="display" style="text-align: left;">Nombre de Archivo</td>
            <td style="text-align: right;" data-label="Nombre de Archivo"><a href="#"><i class="fa fa-trash rojo"></i></a></td>
          </tr>
          <tr>
            <td class="display"style="text-align: left;">Nombre de Archivo</td>
            <td style="text-align: right;" data-label="Nombre de Archivo"><a href="#"><i class="fa fa-trash rojo"></i></a></td>
          </tr>
          <tr>
            <td class="display" style="text-align: left;">Nombre de Archivo</td>
            <td style="text-align: right;" data-label="Nombre de Archivo"><a href="#"><i class="fa fa-trash rojo"></i></a></td>
          </tr>
      </table>
    </div>
    <div class="fondo-botones">
      <div class="btn-group">
        <button>Crear</button>
      </div>
    </div>
  </form>
</div>
