<div class="clear"></div>
<aside class="col-md-6 col-xs-12 hidden col-md-offset-3 alert alert-danger" id="login-mensaje"></aside>
<article id="inicio-sesion" 
		class="col-md-6 col-xs-12 col-md-offset-4" 
		style=" background-color: #94d400; height: 600px; ">

	
		<div class="col-md-10 col-md-offset-1 form-horizontal">

			<aside class="col-md-12 text-center" style="margin-bottom:40px;">
				
				<h4 style="color: #ffffff; font-family: caviar_dreamsregular">Inicia Sesión para continuar</h4>
				<h1 style="color: #ffffff; font-family: PoetsenOne_Regular; font-weight: bold;">Marca</h1>
			</aside>

			<form id='form-login' class="form-horizontal">
				<div class="clearfix"></div>
				<div class="form-group input-icon">
					<i class="fa fa-user inter-input"></i>
					<input type="text" name="usuario" class="form-control" id="inputEmail3" placeholder="Email" maxlength="40">
				</div>
					
				

				<div class="form-group input-icon">
					<i class="fa fa-lock inter-input"></i>
					<input type="password" name="clave" class="form-control" id="inputPassword3" placeholder="Clave" maxlength="40">
				</div>

				<div class="form-group text-center">
					<label style="color: #ffffff; ">
						<input type="checkbox" name="rememberme"> Recuerdame 	
					</label>
				</div>

				<div class="form-group col-xs-10 text-center caviar" style="margin-bottom: 0px; color: #ffffff">
					<a style="color: #ffffff; margin-left: 24%"  href="<?php echo get_home_url(); ?>/recuperar-clave">¿Olvidaste tu contraseña?</a>
				</div>

				<div class="form-group">
					<div class="text-center">
						<button id="btn-login" type="submit" class="btn btn-sm-kmibox caviar">Iniciar sesion</button>
						<br>
						<br>
						<label style="color: #ffffff" class="caviar">¿Aún no tienes perfil Marca? </label>
						<a href="<?php echo get_home_url().'/'; ?>registro" id='link-registro' data-target="inicio-sesion" >
							<span style="color: #000000; font-weight: 900;" class="caviar">Regístrate aquí</span>
						</a>
					</div>
				</div>

			</form>
		</div>
	
</article>
<div class="clear"></div>