<div class="navegacion">
  <div class="center">
    <?=$this->layout->getNav();?>
  </div>
</div>
<div class="center" style="position:relative;">
  <h2>Agregar nuevo usuario</h2>
  <form>
    <div class="block-inputs">
      <div>
        <label>Nombre:</label>
        <input type="text" />
      </div>
      <div>
        <label>Apellidos:</label>
        <input type="text" />
      </div>
      <div>
        <label>Email:</label>
        <input type="text" />
      </div>
      <div>
        <label>Contraseña:</label>
        <input type="text" />
      </div>
      <div>
        <label>Repetir contraseña:</label>
        <input type="text" />
      </div>
      <div>
        <label>Perfil:</label>
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
        <div class="subir-imagen">
        <p>Agregar fotografía</p>
      <label class="fileContainer"> <i class="fa fa-upload subir-img"></i>
      Subir imagen
        <input type="file"/>
      </label>
    </div>

    <div class="fondo-botones">
      <div class="btn-group">
        <button>Crear</button>
      </div>
    </div>
  </form>
</div>
