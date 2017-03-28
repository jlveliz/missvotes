<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="loginmodal-container">
       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h1>Ingreso</h1><br>
      <form role="form" id="login-form-content" action="#">
        <div class="form-group">
            <input type="text" class="form-control" name="email" id="login-email" placeholder="Correo" autofocus required>
            <span class="help-block"><strong></strong></span>
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" id="login-password" placeholder="Contraseña" required>
        </div>

        <div class="form-group">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}> @lang('auth.remember_me')
                </label>
            </div>
        </div>

        <input type="submit" name="login" id="login" class="login btn btn-primary btn-block loginmodal-submit" value="Ingresar">
      </form>
      
      <div class="login-help">
        <a href="#" id="go-register">Registro</a> - <a href="#" id="go-email">Olvidó su contraseña</a>
      </div>
    </div>
  </div>
</div>