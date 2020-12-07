<div class="navegacion">
  <div class="center">
    <?=$this->layout->getNav();?>
  </div>
</div>
<div class="center" style="position:relative;">
  <h2>Agregar nuevo modo ventilatorio</h2>
  <form>
    <div class="block-inputs">
      <div>
        <label>Nombre:</label>
        <input type="text" />
      </div>
      <div>
        <label>Tipo:</label>
        <select>
          <option>Seleccione</option>
        </select>
      </div>
      <div> <span>Estado:</span>
        <label class="switch">
          <input type="checkbox" checked>
          <span class="slider round"></span> <span class="activo">Activo</span> </label>
      </div>
    </div>
    <div class="block-inputs checks" style="padding-top: 30px;">
      <div>
        <input type="checkbox" />
        PEEP</div>
      <div>
        <input type="checkbox" />
        Pmedia</div>
      <div>
        <input type="checkbox" />
        Psoporte</div>
      <div>
        <input type="checkbox" />
        Alarma de pasión</div>
      <div>
        <input type="checkbox" />
        VC Ins</div>
      <div>
        <input type="checkbox" />
        VC Esp</div>
      <div>
        <input type="checkbox" />
        V Min</div>
      <div>
        <input type="checkbox" />
        Alarma de volumen</div>
      <div>
        <input type="checkbox" />
        FR VM</div>
      <div>
        <input type="checkbox" />
        Tiempo Inspiratorio</div>
      <div>
        <input type="checkbox" />
        Humidificación</div>
      <div>
        <input type="checkbox" />
        Temperatura</div>
      <div>
        <input type="checkbox" />
        Cambio de matriz/Llenado de cámara humificadora </div>
      <div>
        <input type="checkbox" />
        Gases arteriales</div>
      <div>
        <input type="checkbox" />
        Función Pulmonar</div>
      <div>
        <input type="checkbox" />
        VAFO</div>
      <div>
        <input type="checkbox" />
        Respaldo</div>
      <div>
        <input type="checkbox" />
        Cambio circuito</div>
      <div>
        <input type="checkbox" />
        Aseo diario</div>
      <div>
        <input type="checkbox" />
        Kinesiologo responsable</div>
      <div>
        <input type="checkbox" />
        iNO</div>
      <div>
        <input type="checkbox" />
        ECMO</div>
    </div>
    <div class="fondo-botones">
      <div class="btn-group">
        <button>Crear</button>
      </div>
    </div>
  </form>
</div>
