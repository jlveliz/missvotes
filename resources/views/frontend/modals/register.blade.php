<div  class="modal fade" id="register-modal" tabindex="0" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="registermodal-container">
		   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  <h1>Registro</h1><br>
		  <form role="form" id="register-form-content" action="#">
		    <div class="form-group">
		        <input type="text" class="form-control" name="email" id="register-email" placeholder="Correo" autofocus>
		        <span class="help-block"><strong></strong></span>
		    </div>

		    <div class="form-group">
		        <input type="text" class="form-control" name="name" id="register-name" placeholder="Nombre">
		        <span class="help-block"><strong></strong></span>
		    </div>

		    <div class="form-group">
		        <input type="text" class="form-control" name="address" id="register-address" placeholder="Dirección">
		        <span class="help-block"><strong></strong></span>
		    </div>
		    
		    <div class="form-group">
		        <input type="password" class="form-control" name="password" id="register-password" placeholder="Contraseña">
		    </div> 

		    <div class="form-group">
		        <input type="password" class="form-control" name="password_confirmation" id="register-password-confirmation" placeholder="Confirme Contraseña">
		    </div>

		    <input type="submit" name="register" id="register" class="register btn btn-primary btn-block registermodal-submit" value="Ingresar">
		  </form>
		  
		  <div class="register-help">
		    <a id="go-login" href="#">Iniciar Sesión</a>
		  </div>
		</div>
	</div>
</div>