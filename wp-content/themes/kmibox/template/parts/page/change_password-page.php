<div class="clear"></div>
<aside class="col-md-6 col-xs-12 hidden col-md-offset-3 alert alert-danger" id="login-mensaje"></aside>
<article id="reset_password" 
		class="col-md-6 col-xs-12 col-md-offset-3 resertpassword" 
		style="border-radius:10px; padding:20px 50px 20px 50px;   border:1px solid #ccc; margin-bottom: 2%;">

	<div class="row">
		<div class="col-md-10 col-md-offset-1 form-horizontal">
			<aside class="text-center" style="margin-bottom:40px;">
				<h1 class="caviar">Recuperar contraseña</h1>
			</aside>

			<form id='form-change-password' class="form-horizontal" method="post">
				
				<input type="hidden" name="email" value="<?php echo $_GET['e']; ?>">
				<div class="form-group inter-input-icon">
					<i class="fa fa-lock"></i>
					<input type="password" name="clave" maxlength="25" class="form-control" id="inputEmail3" placeholder="Ingrese su nueva contraseña" style="font-size: 11px;
">
				</div>

				<div class="form-group inter-input-icon">
					<i class="fa fa-lock "></i>
					<input type="password" name="confirm_clave" maxlength="25" class="form-control" id="inputEmail3" placeholder="Ingrese su nueva contraseña" style="font-size: 11px;
">
				</div>
					
				<div class="form-group">
					<div class="col-sm-12 text-center">
						<button id="btn-change-pass" type="submit" class="btn btn-sm-kmibox1 caviar" >
							Restablecer contraseña
						</button>
					</div>
				</div>

			</form>
		</div>
	</div>

</article>
<div class="clear"></div>