<?php

	global $CARRITO;
	global $wpdb;

	$_productos = $wpdb->get_results("SELECT * FROM productos");
	$productos = array();
	foreach ($_productos as $key => $value) {
		$productos[ $value->id ] = $value;
	}

	$suscripciones = "";
	foreach ($CARRITO["productos"] as $key => $value) {
		if( isset($value->edad) ){
			$suscripciones .= "
				<div style='font-weight: normal;'>
					<strong>Producto: </strong> ".$productos[ $value->producto ]->nombre." ( ".$value->presentacion." )
				</div>
				<div style='font-weight: normal;'>
					<strong>Plan: </strong> ".$value->plan."
				</div>
				<div style='font-weight: normal;'>
					<strong>Mascota: </strong> ".$value->edad." (".$value->tamano.")
				</div>
			";
		}
	}

?>
<!-- Fase #6 Pagos -->
<section data-fase="6" class="container">

	<!-- Mensaje de Error -->
	<?php if ($result['msg'] != ''){ ?>
		<aside class="col-md-10 col-md-offset-1 alert alert-danger"> <?php echo $result['msg']; ?> </aside>
	<?php } ?>

	<!-- Mensaje Success -->
	<article id="pago_exitoso" class="col-md-10 col-xs-12 col-md-offset-1 text-center hidden"  style="border-radius:30px;padding:20px;border:1px solid #ccc; overflow: hidden;">
		<aside class="col-md-12 text-center">
			<h1 style="font-size: 60px; font-weight: bold; color: #94d400;" class="caviar">¡Felicidades!</h1>
			<h4 style="color:#ccc;" class="caviar">Tu suscripción a Marca ha sido un éxito</h4>
		</aside>
		<aside class="col-md-8 col-md-offset-2 text-left">
			<div class="row">
				<div class="col-xs-4 col-md-6 desc_name caviar">Tu suscripción:</div>
				<div class="col-xs-6 col-md-6 desc_value caviar">
					<?php echo $suscripciones; ?>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-4 col-md-6 desc_name caviar">Total Suscripci&oacute;n:</div>
				<div class="col-xs-6 col-md-6 desc_value caviar">
					<?php 
						echo "$".number_format($CARRITO["total"], 2, ',', '.');
					?>
				</div>
			</div>
		</aside>
		<aside class="col-md-12">
	      	<a href="<?php echo get_home_url(); ?>/perfil-usuario" class="btn btn-sm-kmibox caviar">Ir a mi perfil</a>
		</aside>
	</article>


	<!-- Plantilla de Pago -->

	<article id="pagar" class="col-md-10 col-xs-12 col-md-offset-1 text-center" style="border-radius:30px;padding:20px; margin-top:7%;border:1px solid #ccc; margin-left: -2%;">

		<div class="col-md-8 col-md-offset-2">
			<form class="form-horizontal" method="post" action="#" id="form-pago" >
				<input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
				<input type="hidden" name="redirect" value="<?php echo get_home_url(); ?>/pagar-mi-kmibox">

			  <div class="form-group">
			    <label for="inputEmail3" class="col-sm-4 control-label caviar" >Titular</label>
			    <div class="col-sm-8">
			      <input type="text" name="holder_name" 
			      	class="form-control  <?php echo $disabled; ?> " 
			      	<?php echo $disabled; ?> 
			      	id="inputEmail3" 
			      	placeholder="Titular de la tarjeta" 
			      	maxlength="25"
			      	value=""
			      	data-charset="xlf">
			    </div>
			  </div>

			  <div class="form-group">
			    <label for="inputPassword3" class="col-sm-4 control-label caviar">Numero de Tarjeta</label>
			    <div class="col-sm-8">
			      <input type="text" name="num_cart" class="form-control  <?php echo $disabled; ?> " <?php echo $disabled; ?> id="inputPassword3" placeholder="# de tarjeta" maxlength="16" data-charset="num" value="4111111111111111">
			    </div>
			  </div>

			  <div class="form-group">
			    <label for="inputPassword3" class="col-sm-4 control-label caviar" >Fecha vencimiento</label>
			    <div class="col-sm-4">
			    	<select name="exp_month" class="form-control  <?php echo $disabled; ?> " <?php echo $disabled; ?> >
			    		<option>Mes</option>
			    		<?php for ($i=1; $i <= 12; $i++) { ?>
				    		<option><?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?></option>
			    		<?php } ?>
			    	</select>
			      <!-- input type="text" name="exp_month" class="form-control  <?php echo $disabled; ?> " <?php echo $disabled; ?> id="inputPassword3" placeholder="Mes" -->
			    </div>
			    <div class="col-sm-4">
			      <!-- input type="text" name="exp_year" class="form-control  <?php echo $disabled; ?> " <?php echo $disabled; ?> id="inputPassword3" placeholder="Año" -->
			    	<select name="exp_year" class="form-control  <?php echo $disabled; ?> " <?php echo $disabled; ?>  >
			    		<option>Año</option>
			    		<?php for ($i=date('y'); $i < date('y') + 15; $i++) { ?>
				    		<option><?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?></option>
			    		<?php } ?>
			    	</select>
			    </div>
			  </div>

			  <div class="form-group">
			    <label for="inputPassword3" class="col-sm-4 control-label caviar" >CVV</label>
			    <div class="col-sm-8">
			      <input type="text" name="cvv" class="form-control  <?php echo $disabled; ?> " <?php echo $disabled; ?>  id="inputPassword3" placeholder="CVV" maxlength="3" data-charset="num" >
			    </div>
			  </div>

			  <div class="form-group">
			    <label for="inputPassword3" class="col-sm-4 control-label caviar" >Total a pagar</label>
			    <div class="col-sm-8">
			      <input type="text" readonly class="form-control disabled" id="inputPassword3" value="$<?php echo number_format($CARRITO["total"], 2, ',', '.'); ?>">
			    </div>
			  </div>

			  <div class="form-group">
			    <div class="col-sm-offset-4	col-sm-4">

			      <a href="<?php echo get_home_url(); ?>/quiero-mi-kmibox" class="btn  <?php echo (isset($hidden))? '' : 'hidden' ; ?>  btn-sm-kmibox" id="btn_pagar_2 caviar" >Realizar Pago</a>

			      <button id="btn_pagar_1" type="submit" class="btn caviar <?php echo (isset(
			      	$hidden))? 'hidden' : '' ; ?> btn-sm-kmibox" style="padding: 10px 30px 10px 30px;"">Realizar Pago</button>
			    </div>
				<div class="col-sm-3">
			      <a href="<?php echo get_home_url(); ?>/" class="btn btn-sm-kmibox caviar" >Cancelar</a>
			    </div>
			  </div>


			</form>
		</div>
	</article>

</section>

