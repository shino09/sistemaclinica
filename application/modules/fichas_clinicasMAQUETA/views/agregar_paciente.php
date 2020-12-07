<div class="navegacion">
  <div class="center">
    <?=$this->layout->getNav();?>
  </div>
</div>
<div class="center">
  <h2>Agregar nuevo paciente</h2>
  <form>
    <div class="inline-input">
      <div>
        <label>Centro médico:</label>
        <select>
          <option>Centro médico</option>
        </select>
      </div>
      <div>
        <label>Fecha:</label>
        <input type="text" id="datepicker" />
        <i class="fa fa-calendar"></i> </div>
      <div>
        <label>Hora:</label>
        <input type="text" />
        <i class="fa fa-clock-o"></i> </div>
      <div>
        <label>Unidad:</label>
        <select>
          <option>Unidad</option>
        </select>
      </div>
    </div>
    <div class="block-inputs">
      <div>
        <label>Nombre:</label>
        <input type="text" />
      </div>
      <div>
        <label>Rut:</label>
        <input type="text" />
      </div>
      <div>
        <label>Edad:</label>
        <input type="text" />
      </div>
      <div>
        <label>Diagnostico:</label>
        <input type="text" />
      </div>
      <div>
        <label>Nro. Ficha:</label>
        <input type="text" />
      </div>
      <div>
        <label>Peso:</label>
        <input type="text" />
      </div>
      <div>
        <label>Talla:</label>
        <input type="text" />
      </div>
    </div>
    <div class="fondo-botones">
    <div class="btn-group">
      <button>Crear ficha clínica</button>
      <a href="/fichas-clinicas/agregar_control_operativo"><button>Crear ficha clínica y agregar control</button></a>
    </div>
    </div>
  </form>
</div>
