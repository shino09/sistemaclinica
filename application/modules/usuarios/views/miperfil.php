<div class="navegacion">
  <div class="center">
    <?=$this->layout->getNav();?>
  </div>
</div>
<div class="center" style="position:relative;">
  <h2>Mi Perfil</h2>
  <form>
    <div class="block-inputs">
      <div><strong>Nombre: </strong> Ricardo Antonio </div>
      <div> <strong>Apellidos</strong> Uriarte Pendola </div>
      <div> <strong>Fecha Nacimiento:</strong> 21/01/91 </div>
      <div> <strong>Perfil:</strong> Linde </div>
      <div>
        <label>Celular:</label>
        <input type="text" />
      </div>
      <div>
        <label>Email:</label>
        <input type="text" />
        <a href="#" style="margin: 20px 0; display: block;">Cambiar contraseña</a>
      </div>
    </div>
    <div class="subir-imagen">
      <p>Agregar fotografía</p>
      <label class="fileContainer"> <i class="fa fa-upload subir-img"></i> Subir imagen
        <input type="file"/>
      </label>
    </div>
    <div class="fondo-botones">
      <div class="btn-group">
        <button>Guardar Cambios</button>
      </div>
    </div>
  </form>
</div>
