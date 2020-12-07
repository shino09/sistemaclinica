<!-- contenido -->

<div id="login"> <img src="/imagenes/template/logo.png" width="158" height="128" alt="Intranet" />
    <form class="form-horizontal form-signin" role="form" id="form-login">
        <fieldset>
            <div class="form-group">
                <label for="email-login">Email</label>
                <input type="email" class="form-control usuario validate[required,custom[email]]" id="email-login" name="email" autofocus placeholder="Email" />
            </div>
      
            <div class="form-group">
                <label for="contrasena-login">Password</label>
                <input type="password" class="form-control password validate[required]" id="contrasena-login" name="contrasena" placeholder="Contraseña"/>
            </div>
      
            <div class="text-center">
                <button type="submit" class="btn btn-success col-md-6 col-md-offset-3" > <i class="icon-key"></i> INGRESAR</button>
                <br /><br />
                <button type="button" class="btn btn-link " data-toggle="modal" data-target="#myModal">Recuperar contraseña</button>
            </div>
        </fieldset>
    </form>
</div>

<!-- Modal recuperar contraseña -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
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
        </div>
    </div>
</div>