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
        $(".recuperar-contrasena").fadeOut();
    });
    $(".open").click(function(){
        $(".recuperar-contrasena").fadeIn();
    });
});
</script>
 

<div class="login"> <img src="/imagenes/template/logo.jpg" />
  <h3>Bienvenido</h3>
   <h5>Email: test13@gmail.com</h5>
  <h5>Pass:  1234</h5>  
<form class="form-horizontal form-signin" role="form" id="form-login">
    <div> <i class="fa fa-user"></i>
                <input type="email" class="form-control usuario validate[required,custom[email]]" id="email-login" name="email" autofocus placeholder="Email" />
    </div>
    <div> <i class="fa fa-lock"></i>
                <input type="password" class="form-control password validate[required]" id="contrasena-login" name="contrasena" placeholder="Contraseña"/>
    </div>
    <div class="text-center">
                <button type="submit" class="btn-ingresar" > <i class="icon-key"></i> INGRESAR</button>
  </div>

    <span><a href="#" class="open">Recuperar Contraseña</a></span>
     </form>
</div>
<div class="recuperar-contrasena" class="recuperar-contrasena"style="display: none;">
  <div class="content">
    <h3>Recuperar Contraseña</h3>
    <div><i class="fa fa-user"></i>
      <input type="text" placeholder="Ingrese su correo electrónico" />
    </div>
    <button class="btn-ingresar">Enviar contraseña nueva</button>
    <i class="fa fa-close close"></i> </div>
</div>

 <script src = "js / jquery.validationEngine.min.js" type = "text / javascript" charset = "utf-8"> </ script> 
