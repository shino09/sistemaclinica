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
  <h3>Bienvenido</h3>
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
     </form>
  
 <form role="form" id="form-recuperar">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title" id="myModalLabel">Recuperar contraseña</h3>
                </div>
          
                <div class="modal-body">
                    <input type="email" placeholder="Indica tu email" name="email" class="form-control validate[required,custom[email]]" />
                </div>
          
                <div class="modal-footer" style="text-align:center;">
                    <button type="submit" class="btn btn-success">Enviar</button>
                </div>
            </form>
    


<div class="recuperar-contrasena" style="display: none;">
  <div class="content">
    <h3>Recuperar Contraseña</h3>
    <div><i class="fa fa-user"></i>
      <input type="text" placeholder="Ingrese su correo electrónico" />
    </div>
    <button class="btn-ingresar">Enviar contraseña nueva</button>
    <i class="fa fa-close close"></i> </div>
</div>
 <script src = "js / jquery.validationEngine.min.js" type = "text / javascript" charset = "utf-8"> </ script> 
