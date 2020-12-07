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
        <label>Tipo:</label>
        <input type="text" />
      </div>
      <div> <span>Estado:</span>
        <label class="switch">
          <input type="checkbox" checked>
          <span class="slider round"></span>
          <span class="activo">Activo</span>
           </label>
      </div>
    </div>
    <div class="fondo-botones">
      <div class="btn-group">
        <button>Crear</button>
      </div>
    </div>
  </form>
</div>
