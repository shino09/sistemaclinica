<div class="navegacion">
  <div class="center">
    <?=$this->layout->getNav();?>
  </div>
</div>
<div class="center agregar-control">
  <h2>Resumen de estadía</h2>
  <form>
    <div class="cont">
      <div class="sub-contenedor">
        <label>Centro médico</label>
        <select>
          <option></option>
        </select>
      </div>
      <div class="sub-contenedor">
        <label>Unidad</label>
        <input type="text"  id="datepicker"/>
        <i class="fa fa-calendar"></i> </div>
      <div class="sub-contenedor">
        <label>Hora</label>
        <input type="text" />
        <i class="fa fa-clock-o"></i> </div>
      <div class="sub-contenedor"></div>
      <div class="sub-contenedor">
        <label>Nombre</label>
        <input type="text" />
      </div>
      <div class="sub-contenedor">
        <label>Rut</label>
        <input type="text" />
      </div>
    </div>
    <div class="cont" style="border-bottom: 0;">
      <div class="sub-contenedor">
        <label>Fecha ingreso clínica:</label>
        <input type="text" id="datepicker_2" />
        <i class="fa fa-calendar"></i> </div>
      <div class="sub-contenedor">
        <label>Día de evolución:</label>
        <input type="text" />
        <i class="fa fa-clock-o"></i> </div>
      <div class="sub-contenedor"></div>
      <div class="sub-contenedor"></div>
      <div class="sub-contenedor">
        <label>Fecha ingreso UCI:</label>
        <input type="text" id="datepicker_3" />
        <i class="fa fa-calendar"></i> </div>
      <div class="sub-contenedor">
        <label>Días ventilación mecánica:</label>
        <input type="text" id="datepicker_4" />
        <i class="fa fa-calendar"></i> </div>
    </div>
    <div class="fondo-botones" style="margin-top: 0;">
      <div class="btn-group" style="margin-left: 20px;">
        <button>Exportar a excel</button>
      </div>
    </div>
  </form>
  <div class="tabla2">
    <table>
      <thead>
        <tr>
          <td scope="col">Item</td>
          <td scope="col"> Día 1</td>
          <td scope="col">Día 2</td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Tipo de Soporte</td>
          <td><a href="#">Ver más</a></td>
          <td><a href="#">Ver más</a></td>
        </tr>
        <tr>
          <td>Equipos en uso</td>
          <td><a href="#">Ver más</a></td>
          <td><a href="#">Ver más</a></td>
        </tr>
        <tr>
          <td>Insumos</td>
          <td><a href="#">Ver más</a></td>
          <td><a href="#">Ver más</a></td>
        </tr>
        <tr>
          <td>Vía aerea</td>
          <td><a href="#">Ver más</a></td>
          <td><a href="#">Ver más</a></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
