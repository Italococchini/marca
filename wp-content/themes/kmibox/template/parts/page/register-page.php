<article class="row">
	<aside class="col-md-6 col-xs-12 hidden col-md-offset-3 alert alert-danger" id="login-mensaje"></aside>

	<aside class="col-md-12 text-center" style="margin-bottom:40px;">
		
	</aside>
	<div id="register" 
		class="col-md-8 col-xs-12 col-md-offset-2"  
		style="border-radius:10px;   border:1px solid #ccc;">
		<div class="row">
			<form class="form-horizontal" id="form-registro" method="post">
				<div class="row">					
					<h2 class="col-sm-6">Información del usuario</h2>
				</div>
				<div class="row row-special campos-obligatorios">
					<span class="fa fa-asterisk" aria-hidden="true"></span>
					<small> Campos obligatorios</small>
				</div>

				<div class="row row-special">					
					<div class="col-md-6 form-group">
						<i class="fa fa-asterisk fa-especial" aria-hidden="true"></i>
						<input type="text" name="nombre" class="form-control col-md-6" id="inputEmail3" placeholder="Nombre"
						data-charset="xlf" maxlength="50">
					</div>
					<div class="col-md-6 form-group">
						<i class="fa fa-asterisk fa-especial" aria-hidden="true"></i>
						<input data-charset="xlf" type="text" name="apellido" class="form-control col-md-6" id="inputEmail3" placeholder="Apellido"  maxlength="50">
					</div>
				</div>
				<div class="row row-special">					
					<div class="col-md-6">
						<i class="fa fa-asterisk fa-especial" aria-hidden="true"></i>
						<div class="col-md-6 label-group form-group">
							<label>Sexo: </label>
							<label>
								<input type="radio" name="sexo" value="m"> M
							</label>
							<label>
								<input type="radio" name="sexo" value="f"> F
							</label>
						</div>
						<div class="col-md-6 form-group">
							<i class="fa fa-asterisk fa-especial fa-especial" aria-hidden="true"></i>
							<select class="form-control" name="edad">
								<option>Edad</option>
								<?php for ($i=18; $i < 100; $i++) { ?> 
									<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="col-md-6 form-group">
						<input type="text" name="mascota" data-charset="alf" class="form-control col-md-6" id="inputEmail3" placeholder="Nombre de la Mascota"  maxlength="50">
					</div>
				</div>
				<div class="row row-special">					
					<div class="col-md-6 form-group">
						<i class="fa fa-asterisk fa-especial" aria-hidden="true"></i>
						<input type="text" name="telef_movil" data-charset="num" class="form-control col-md-6" id="inputEmail3" placeholder="Teléfono móvil" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"  maxlength="13">
					</div>
					<div class="col-md-6 form-group">
						<input type="text" name="telef_fijo" data-charset="num" class="form-control col-md-6" id="inputEmail3" placeholder="Teléfono fijo"  onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" maxlength="13">
					</div>
				</div>
				<div class="row row-special">					
					<div class="col-md-12 form-group">
						<i class="fa fa-asterisk fa-especial" aria-hidden="true"></i>
						<select class="form-control col-md-6" name="dondo_conociste">
							<option value="">Cuéntanos, dónde nos conociste</option>
							<option value="redes sociales">Redes Sociales</option>
							<option value="google">Google</option>
							<option value="amigos/familiares">Amigos/Familiares</option>
							<option value="otros">Otros</option>
						</select>
					</div>
				</div>
					
				<div class="row">					
					<h2 class="col-sm-6">Información de la cuenta</h2>
				</div>

				<div class="row row-special">					
					<div class="col-md-6 form-group">
						<i class="fa fa-asterisk fa-especial" aria-hidden="true"></i>
						<input type="email" name="r_usuario" data-charset="xlfnumesp" class="form-control col-md-6" id="inputEmail3" placeholder="Email"  maxlength="40">
					</div>
					<div class="col-md-6 form-group">
						<i class="fa fa-asterisk fa-especial" aria-hidden="true"></i>
						<input type="email" name="r_usuario_c" data-charset="xlfnumesp" class="form-control col-md-6" id="inputEmail3" placeholder="Confirmar email"  maxlength="40">
					</div>
				</div>
				<div class="row row-special">					
					<div class="col-md-6 form-group">
						<i class="fa fa-asterisk fa-especial" aria-hidden="true"></i>
						<input type="password" name="r_clave" data-charset="xlfnumesp" class="form-control col-md-6" id="inputPassword3" placeholder="Clave"  maxlength="20">
					</div>
					<div class="col-md-6 form-group">
						<i class="fa fa-asterisk fa-especial" aria-hidden="true"></i>
						<input type="password" name="r_clave_c" data-charset="xlfnumesp" class="form-control col-md-6" id="inputPassword3" placeholder="Confirmar clave" maxlength="20">
					</div>
				</div>

				<div class="row">					
					<h2 class="col-sm-6">Dirección</h2>
				</div>
		 
				<div class="row row-special">					
					<div class="col-md-6 form-group">
						<i class="fa fa-asterisk fa-especial" aria-hidden="true"></i>
						<input type="text" name="dir_calle" class="form-control col-md-6" data-charset="xlfnumesp" id="inputEmail3" placeholder="Calle" maxlength="50">
					</div>
					<div class="col-md-6 form-group">
						<div class="row hidden-sm">
							<div class="col-md-6">
								<i class="fa fa-asterisk fa-especial" aria-hidden="true"></i>
								<input type="text" name="dir_numext" data-charset="num" class="form-control col-md-6" id="inputEmail3" placeholder="Número exterior"  minlength="1" maxlength="20">
							</div>
							<div class="col-md-6">
								<input type="text" name="dir_numint" data-charset="num" class="form-control col-md-6" id="inputEmail3" placeholder="Número interior"  minlength="1" maxlength="20">
							</div>
						</div>
						<div class="row hidden-xs hidden-md hidden-lg visible-sm">
							<div class="col-md-6" style="margin-left: -2%;width: 105%;">
								<i class="fa fa-asterisk fa-especial" aria-hidden="true"></i>
								<input type="text" name="dir_numext" data-charset="num" class="form-control col-md-6" id="inputEmail3" placeholder="Número exterior"  minlength="1" maxlength="20">
							</div>
							<div class="col-md-6" style="margin-left: -2%;width: 105%;">
								<input type="text" name="dir_numint" data-charset="num" class="form-control col-md-6" id="inputEmail3" placeholder="Número interior"  minlength="1" maxlength="20">
							</div>
						</div>
					</div>
				</div>
				<div class="row row-special">					

					<div class="col-md-6 form-group">
						<i class="fa fa-asterisk fa-especial" aria-hidden="true"></i>					
						<select class="form-control col-md-6" name="dir_estado">
							<option>Estado</option>
							<?php
								$estados = get_estados();
								if( count($estados) > 0 ){ 
									foreach ($estados as $estado) { ?>
										<option value="<?php echo utf8_decode($estado->id);?>">
											<?php echo utf8_decode($estado->name);?>
										</option>	
								<?php } ?>
							<?php } ?>
						</select>
					</div>
					<div class="col-md-6 form-group">
						<i class="fa fa-asterisk fa-especial" aria-hidden="true"></i>
						<select class="form-control col-md-6" id="dir_ciudad" name="dir_ciudad">
							<option>Delegación</option>
						</select>
					</div>
				</div>
				<div class="row row-special">					
					<div class="col-md-6 form-group">
						<i class="fa fa-asterisk fa-especial" aria-hidden="true"></i>
						<input type="text" name="dir_colonia" data-charset="xlfnumesp" class="form-control col-md-6" id="inputEmail3" placeholder="Colonia"  maxlength="50">
					</div>
					<div class="col-md-6 form-group">
						<i class="fa fa-asterisk fa-especial" aria-hidden="true"></i>
						<input type="text" name="dir_codigo_postal" data-charset="numalf" class="form-control col-md-6" id="inputEmail3" placeholder="Código postal" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" maxlength="15">
					</div>
				</div>

				<div class="row">
					<div class="col-sm-offset-1	col-sm-11 text-center">
						<button id="btn-register_" class="btn btn-sm-kmibox">Registrarme</button>
						<br>
						<br>
<!--
 						<label>¿Ya tienes un perfil Kmibox? </label>
						<a href="<?php echo get_home_url(); ?>/iniciar-sesion" id='link-login' data-target="register" >
							Iniciar Sesion
						</a>
 -->
 					</div>
 					<aside class="col-md-6 col-xs-12 hidden col-md-offset-3 alert alert-danger" id="login-mensaje"></aside>
				</div>
			</form>
		</div>
	</div>

</article>

