<style type="text/css">
header, #top {
	display: none;
}
footer {
	position: absolute;
	width: 100%;
	bottom: 0;
}
</style>
<script>
$(document).ready(function(){
    $(".close").click(function(){
        $(".recuperar-contrasena").fadeOut()
    });
    $(".open").click(function(){
        $(".recuperar-contrasena").fadeIn();
    });
});
</script>
<div class="login"> <img src="/imagenes/template/logo.jpg" />
  <h3>Bienvenido sdsdfsdf</h3>
  <form>
    <div> <i class="fa fa-user"></i>
      <input type="text" placeholder="Usuario" />
    </div>
    <div> <i class="fa fa-lock"></i>
      <input type="text" placeholder="Contraseña" />
    </div>
    <a href="pacientes"><button class="btn-ingresar">Ingresar</button></a>
    <span><a href="#" class="open">Recuperar Contraseña</a></span>
  </form>
</div>
<div class="recuperar-contrasena" style="display: none;">
  <div class="content">
    <h3>Recuperar Contraseña</h3>
    <div><i class="fa fa-user"></i>
      <input type="text" placeholder="Ingrese su correo electrónico" />
    </div>
    <button class="btn-ingresar">Enviar contraseña nueva</button>
    <i class="fa fa-close close"></i> </div>
</div>
