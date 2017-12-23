 <?php
/* 
 *
 * Template Name: Quiero mi Marca 
 *
 */

	get_header(); 

	$HTML = '


		<link rel="stylesheet" href="'.get_home_url().'/css/quiero.css">

		<div class="vlz_header">
			<a class="btn btn-sm btn-kmibox-white pull-left" id="btn-atras" href="#" data-value="0">
				<i class="fa fa-chevron-left" aria-hidden="true"></i> Atras
			</a>
			<label class="header_titulo" id="header">Prueba</label>
		</div>

		<div class="comprar_container">

			<section id="fase_1">
				<div class="comprar_box">
					<div id="vlz_carrousel" class="vlz_carrousel hidden-xs carro">
						<img src="'.get_home_url().'/img/edad/Cachorro.png"  class="img-responsive" width="400px" id="Pequeño" />
						<img src="'.get_home_url().'/img/edad/Mediano.png"  class="img-responsive" width="400px" id="Mediano" />	
						<img src="'.get_home_url().'/img/edad/Adulto.png"  class="img-responsive"  width="400px" id="Grande" />
					</div>
					<div id="carrousel_responsive" class="vlz_carrousel hidden-md hidden-sm hidden-lg" style="margin-top:12%"> 
						<img src="'.get_home_url().'/img/edad/Cachorro-resp.png"  class="img-responsive" width="250px" id="Pequeño" />
						<img src="'.get_home_url().'/img/edad/Mediano-resp.png"  class="img-responsive" width="250px" id="Mediano" />	
						<img src="'.get_home_url().'/img/edad/Adulto-resp.png"  class="img-responsive"  width="250px" id="Grande" />
					</div>
				</div>
				<div id="edad" class="comprar_footer hidden-xs">
					<div class="col-xs-6">
						<p>Selecciona la edad</p>
					</div>
					<div class="col-xs-6">
						<div class="col-xs-4">
							<button data-value="Cachorro" id="edad-btn">
								<b>Cachorro</b>
							</button>
						</div>	
						<div class="col-xs-4">
							<button data-value="Adulto" id="edad-btn">
								<b>Adulto</b>
							</button>
						</div>	
						<div class="col-xs-4">
							<button data-value="Maduro" id="edad-btn">
								<b>Maduro</b>
							</button>
						</div>	
					</div>
				</div>
				<div id="edad" class="comprar_footer hidden-md hidden-lg">
					<div class="col-xs-6">
						<p>Selecciona la edad</p>
					</div>
					<div class="col-xs-6">
						<div class="col-xs-4">
							<button data-value="Cachorro" id="edad-btn" style="margin-right: 20%;">
								<b>Cachorro</b>
							</button>
						</div>	
						<div class="col-xs-4">
							<button data-value="Adulto" id="edad-btn" style="margin-right: -165%;">
								<b>Adulto</b>
							</button>
						</div>	
						<div class="col-xs-4">
							<button data-value="Maduro" id="edad-btn" style="margin-right: -305%;">
								<b>Maduro</b>
							</button>
						</div>	
					</div>
				</div>

			</section>

			<section id="fase_2" class="hidden">

				<div class="comprar_box">					

				<div class="comprar_box">

						<div id="vlz_carrousel_2" class="vlz_carrousel hidden-xs hidden-sm"></div>
						<div id="carrousel_2" class="vlz_carrousel hidden-lg hidden-md"></div>
				</div>

				
				
				<div id="descripciones" class="comprar_descripcion" data-value=""></div>
				<div id="presentaciones" class="comprar_footer" data-value="">

					<span id="nombre_producto"></span>


					<div id="presentacion-900g" class="button_presentacion" style="margin-left:-4%">
						<button data-value="900g">
							<b>P (900g)</b>
						</button>
						<span class="separador_presentacion">|</span>
					</div>

					<div id="presentacion-2000g" class="button_presentacion">
						<button data-value="2000g">
							<b>M (2000g)</b>
						</button>
						<span class="separador_presentacion">|</span>
					</div>

					<div id="presentacion-4000g" class="button_presentacion">
						<button data-value="4000g">
							<b>G (4000g)</b>
						</button>
					</div>

					<span id="no_aparece" class="caviar">Si no aparece tu marca haz <a href="#">click aqui</a></span>
				</div>

			</section>

			<section id="fase_3" class="hidden">
				<div class="comprar_box" id="plan">
					<div id="planes">
						<article id="plan-Quincenal" class="text-center col-sm-3 separation-top col-xs-6">
							<img class="img-responsive" src="'.get_home_url().'/img/Quincenal.png" width="300px" height="370px">
							<button class="btn btn-sm-marca btn-sm-kmibox-price postone" data-value="Quincenal" style="border: solid 2px rgb(144, 14, 156); background: #ffffff; color: #777;">Mensual<span id="precio"></span></button>
						</article>

						<article id="plan-Mensual" class="text-center col-sm-3 separation-top col-xs-6">
							<img class="img-responsive" src="'.get_home_url().'/img/Mensual.png" width="300px" height="370px" style="margin-top: -3%;">
							<button class="btn btn-sm-marca btn-sm-kmibox-price postone"  id="precio1" data-value="Mensual" style="border: solid 2px rgb(144, 14, 156); background: #ffffff; color: #777;">Bimestral</button>
						</article>

						<article id="plan-Trimestral" class="text-center col-sm-3 separation-top col-xs-6" style="display: inline-block !important;">
							<img class="img-responsive" src="'.get_home_url().'/img/Bimestral-1.png" width="300px" height="370px" ">
							<button class="btn btn-sm-marca btn-sm-kmibox-price postone"   data-value="Trimestral" style="border: solid 2px rgb(144, 14, 156); background: #ffffff; color: #777;">Trimestral</button>
						</article>

						<!-- <article id="plan-Bimestral" class="text-center col-sm-3 separation-top col-xs-offset-3 col-xs-6 arriba"> -->

						<article id="plan-Bimestral" class="text-center col-sm-3 separation-top col-xs-6 hidden-sm hidden-xs" style="display: inline-block;/*margin-left: 26%; margin-top: 7%;*/">
							<img class="img-responsive" src="'.get_home_url().'/img/Bimestral.png" width="300px" height="370px">
							<button class="btn btn-sm-marca btn-sm-kmibox-price postone"  id="precio2" data-value="Bimestral" style="border: solid 2px rgb(144, 14, 156); background: #ffffff; color: #777; margin-top: 0px">Semestral</button>
						</article>

						<article id="plan-Bimestral" class="text-center col-sm-3 separation-top col-xs-6 hidden-xs hidden-lg hidden-md visible-sm" style="display: inline-block;margin-top: 7%;">
							<img class="img-responsive" src="'.get_home_url().'/img/Bimestral.png" width="300px" height="370px">
							<button class="btn btn-sm-marca btn-sm-kmibox-price postone"  id="precio2" data-value="Bimestral" style="border: solid 2px rgb(144, 14, 156); background: #ffffff; color: #777;">Semestral</button>
						</article>

						<article id="plan-Bimestral" class="text-center col-sm-3 separation-top col-xs-6 hidden-sm hidden-lg hidden-md visible-xs" style="display: inline-block;">	<img class="img-responsive" src="'.get_home_url().'/img/Bimestral.png" width="300px" height="370px">
							<button class="btn btn-sm-marca btn-sm-kmibox-price postone" data-value="Bimestral" style="border: solid 2px rgb(144, 14, 156); background: #ffffff; color: #777;">Semestral</button>
						</article>

					</div>
				</div>
				<div class="comprar_footer">
					<span class="text-center fontspan caviar">Descuento en comparación con el precio unitario mensual*</span>
				</div>
			</section>

			<section id="fase_4" class="hidden">
				<div class="factura">

					<div class="cintillo_factura">
						<img id="izq" src="'.get_home_url().'/img/marca/store.png" />
						<img id="cen" src="'.get_home_url().'/img/marca/Line---escritorio.png" />
						<img id="der" src="'.get_home_url().'/img/marca/box.png" />
					</div>

					<div class="alerta" id="cart-content-alerta">
						<span id="cart-alerta"></span>
					</div>
					
					<table id="desglose" cellspacing=0 cellpadding=0>	
						<thead>
							<th class="hidden-xs"width="40">&nbsp;</th>
							<th>Producto</th>
							<th>Descripci&oacute;n</th>
							<th>Frecuencia</th>
							<th>Precio</th>
							<th>Cantidad</th>
							<th>Subtotal</th>
						</thead>
						<tbody id="cart-items"></tbody>
					</table>

					

					<div id="totales">
					
						<table cellspacing=0 cellpadding=0>	
							<tr>
								<th> Productos en esta compra </th>
								<td id="cant-item"> </td>
							</tr>
							<tr>
								<th> Total sin IVA </th>
								<td id="subtotal"> </td>
							</tr>
							<tr>
								<th> IVA </th>
								<td id="iva"> </td>
							</tr>
							<tr>
								<th class="style_total" > Total </th>
								<td class="style_total" id="total"> </td>
							</tr>
						</table>

					</div>

				</div>
				
				<article class="col-md-12 text-center">
					<span id="agregar_plan" >Agregar otro plan</span>
					<a href="#" data-toggle="modal" data-target="#suscription"><img src="'.get_home_url().'/img/Boton-2.png" width="220" height="50"/></a>
				</article>		
			</section>	

		</div>

		<div id="suscription" class="modal fade img-responsive" tabindex="-1"  role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" id="suscription">
				<div class="Modal content text-center" id="suscription" >			     
					<div  class="btn btn-sm-marca"  style=" background-color:#ffffff; border-color:#fffff1; border-style: solid; border-width: 14px; /*display: inline-block; */">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="btn_cerrar">X</button>
						<div class="row" >
							<div  style="clear:both;"></div>
							<div style="float:left;width:50%;">								
								<a href="#"  id="pagar" role="button"  data-target="suscription"><img src="'.get_home_url().'/img/tarjeta.png"   alt="Cinque Terre"  width="240" height="180"/><br><label style="caviar_dreamsregular">Pago con tarjeta</label></a>
							</div>
							<div style="float:left;width:50%;" >    
								
								<a href="#" type="button" id="tienda" data-target="suscription"><img src="'.get_home_url().'/img/efectivo.png" alt="Cinque Terre" width="240" height="180"/><br><label style="caviar_dreamsregular">Pago en efectivo</label></a>
							</div>		
						</div>
					</div>
				</div>
			</div>
		</div>	
	';

	echo comprimir($HTML);

	get_footer();

	echo comprimir('<script type="text/javascript" src="'.get_home_url().'/js/functions.js"></script>');
?>

