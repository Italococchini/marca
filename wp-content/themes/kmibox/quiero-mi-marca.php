 <?php
/* 
 *
 * Template Name: Quiero mi Marca 
 *
 */

	get_header(); 

	$data_planes = $wpdb->get_results("SELECT * FROM planes ORDER BY id ASC");
	$PLANES = "";
	foreach ($data_planes as $plan) {
		$PLANES .= '
			<article id="plan-'.$plan->plan.'" data-value="'.$plan->id.'" class="select_plan">
				<img class="img-responsive" src="'.TEMA().'/imgs/planes/'.$plan->plan.'.svg">
				<span class="precio_plan"></span>
				<div>
					'.$plan->descripcion.'
				</div>
			</article>
		';
	}

	$HTML = '
		<link rel="stylesheet" href="'.TEMA().'/css/proceso_compra.css">
		<link rel="stylesheet" href="'.TEMA().'/css/responsive/proceso_compra.css">

		<a class="controles_generales" id="vlz_atras" href="#">
			<i class="fa fa-chevron-left" aria-hidden="true"></i> ATR&Aacute;S	
		</a>

		<div class="controles_generales" id="vlz_titulo">
			Elije el tamaño de tu mascota
		</div>

		<div class="controles_generales" id="vlz_controles_fases">
			<span id="fase_indicador_1" class="fase_activa"></span>
			<span id="fase_indicador_2" ></span>
			<span id="fase_indicador_3" ></span>
			<span id="fase_indicador_4" ></span>
		</div>


		<div class="comprar_container">

			<section id="fase_1">
				<div class="carrousel-items">
					<article data-value="Mediano">
						<div>
							<img
								src="'.get_home_url().'/img/edad/p_mediano.png" 
								class="img-responsive img-circle" 
								id="Mediano"
							/>
							<p class="col-md-12">Mediano</p>
						</div>
					</article>
					<article data-value="Pequeño">
						<div>
							<img
								src="'.get_home_url().'/img/edad/p_pequeno.png" 
								class="img-responsive img-circle" 
								id="Grande"
							/>
							<p class="col-md-12">Pequeño</p>
						</div>
					</article>
					<article data-value="Grande">
						<div>
							<img
								src="'.get_home_url().'/img/edad/p_adulto.png" 
								class="img-responsive img-circle" 
								id="Grande"
							/>
							<p class="col-md-12">Grande</p>
						</div>
					</article>
				</div>
				<div class="selector_edad_container">
					<label>Selecciona la Edad</label>
					<div class="selector_edad_box" id="edad">
						<span id="edad_Cachorro" data-value="Cachorro">Cachorro</span>
						<span id="edad_Adulto" data-value="Adulto" >Adulto</span>
						<span id="edad_Senior" data-value="Senior" >Senior</span>
					</div>
				</div>
			</section>

			<section id="fase_2" class="hidden">
				<div class="carrusel_container">
					<i id="anterior" class="fa fa-chevron-left izq"></i>
					<div class="carrusel_2">
						<span></span>
					</div>
					<i id="siguiente" class="fa fa-chevron-right der"></i>
				</div>
				<div class="selector_producto_container">
					<div class="selector_producto_container_interno">
						<div class="selector_presentaciones">
							<span id="pres_900g" >P</span>
							<span id="pres_2000g" >M</span>
							<span id="pres_4000g" >G</span>
							<span id="pres_6000g" >XL</span>
						</div>
						<label>Selecci&oacute;n:</label>
						<div class="selector_producto_box" id="producto">
							<div id="nombre_producto" data-value="">ROYAL CANIN</div>
							<div id="descripcion_producto" data-value="" ><span><span></div>
						</div>

					</div>

					<div id="siguiente_pantalla" class="btn-disable">Siguiente</div>

					<div class="selector_producto_footer">
						Si no aparece tu marca, <a href="javascript:;" data-target="show-list">haz click aqui</a>
					</div>
  
				</div>
			</section>
 
			<section id="product-list" class="hidden">

				<article class="container">
					<div class="row">
						<span>20 RESULTADOS</span>
						<div class="pull-right text-right">
							<input type="text" class="form-control" placeholder="Filtrar por"></input>
						</div>
					</div>
					<div id="otras-marcas" class="row listado-productos">

						<article class="col-xs-6 col-md-3 text-center" data-text="Tier Holistic">
							<div class="col-xs-12">
								<img src="'.get_home_url().'/img/productos/Tier-holistic.png" width="70%" class="img-responsive" id=""/>
								<div  class="col-md-12"><strong>Tier Holistic</strong></div>
								<div  class="col-md-12">Small Bites Adulto</div>
							</div>
						</article>
						
					</div>
				</article>

				<article class="section-seleccion">
					<div class="container">
						<h1 class="producto_name" data-target="producto_name">ROYAL CANIN</h1>
						<h2 class="producto_descripcion">Raza mediana adulto <span>13.7 KG</span></h2>
						<div>
							<span>Presentaci&oacute;n: </span>
							<div class="selector_presentaciones2">
								<span id="pres_900g" >P</span>
								<span id="pres_2000g" >M</span>
								<span id="pres_4000g" >G</span>
								<span id="pres_6000g" >XL</span>
							</div>
							<span>Cantidad:</span>
							<select><option>1</option></select>
							<button class="btn btn-marca pull-right"><i class="fa fa-shopping-cart "></i> AGREGAR AL CARRITO</button>
						</div>					
					</div>					
				</article>

				<div class="clear"></div>
			</section>

			<section id="fase_3" class="hidden">
				<div class="comprar_box" id="plan">
					<div id="planes">
						<div class="select_plan_box">
							'.$PLANES.'
						</div>
					</div>
				</div>
			</section>

			<section id="fase_4" class="hidden">
				<div class="factura">
					<div class="cintillo_factura">
						<img id="cen" src="'.TEMA().'/imgs/marca/Elemento-1.png" />
					</div>
					<div class="alerta" id="cart-content-alerta">
						<span id="cart-alerta"></span>
					</div>
					<table id="desglose" cellspacing=5 cellpadding=5>	
						<thead>
							<th class="hidden-xs"width="40">&nbsp;</th>
							<th> <span> Producto </span> </th>
							<th> <span> Descripci&oacute;n </span> </th>
							<th class="solo_pc"> <span> Periodicidad </span> </th>
							<th class="solo_pc"> <span> Precio </span> </th>
							<th> <span> Cantidad </span> </th>
							<th class="solo_pc"> <span> Subtotal </span> </th>
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
					<span class="btn_pagar" href="#" data-toggle="modal" data-target="#suscription">PAGAR</span>
				</article>		
			</section>	

		</div>

		<div id="suscription" class="modal fade img-responsive" tabindex="-1"  role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog">
				<div class="Modal content text-center" >			     
					<div style=" background-color:#ffffff; border-color:#fffff1; border-style: solid; border-width: 14px;">
						<img src="'.TEMA().'/imgs/opciones_pago/fondo.jpg" class="fondo_opciones" />
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="btn_cerrar">X</button>
						<div class="opciones_pago" >
							<div style="float:left; width:50%;">								
								<a href="#" id="pagar"><img src="'.TEMA().'/imgs/opciones_pago/Card.svg" style="width: 80%;" /><br><label style="caviar_dreamsregular">Tarjeta d&eacute;bito / cr&eacute;dito</label></a>
							</div>
							<div style="float:left; width:50%;" > 
								<a href="#" id="tienda"><img src="'.TEMA().'/imgs/opciones_pago/Cash.svg" style="width: 80%;" /><br><label style="caviar_dreamsregular">Efectivo</label></a>
							</div>		
						</div>
					</div>
				</div>
			</div>
		</div>	
	';

	echo comprimir($HTML);

	get_footer();

	echo comprimir('<script type="text/javascript" src="'.TEMA().'/js/functions_new.js"></script>');
?>

