<?php
	include '../wp-load.php';
	include( "../wp-content/themes/kmibox/lib/payu/PayU.php" );
	include( "../wp-content/themes/kmibox/lib/payu/validarTDC.php" );

	global $wpdb;

	$payu = new PayU();

	$data = [];
	$time = strtotime("+1 day");
	$hoy = date("Y-m-d", $time );
	$cobros = $wpdb->get_results("SELECT * FROM cobros WHERE fecha_cobro = '{$hoy}' AND status = 'Pendiente' ");

	foreach ($cobros as $cobro) {
		$suscripcion = $wpdb->get_row("SELECT * FROM items_ordenes WHERE id = {$cobro->item_orden}");
		$orden = $wpdb->get_row("SELECT * FROM ordenes WHERE id = {$suscripcion->id_orden}");
		$cliente = $wpdb->get_row("SELECT * FROM wp_users WHERE ID = {$orden->cliente}");
		
		// Primera suscripcion
		$primeraSuscripcion = getPrimeraSuscripcion( $suscripcion->id_orden );
 
		// Metadata Cobro y Cupones 
		$total = $suscripcion->total;
	
		if( $primeraSuscripcion == $cobro->item_orden ){
			$data = unserialize($orden->metadata);
			$cupones = $data["cupones"];
			$descuento = 0;
			if( !empty($cupones) ){			
				foreach ($cupones as $cupon) {
					if( $cupon[3] == 1 ){
						$descuento += $cupon[1];
					}
				}
				if( $total < $descuento ){
					$descuento -= $descuento;
				}else{
					$total = 0;
				}
			}
		}

		// Nuevo registro cobro
		if( $total == 0 ){
			crearNewCobro($cobro->item_orden, $time);
			exit();
		}

		$data = unserialize( $orden->metadata );

		$error = "";

		try {

			// Openpay - Data del Cliente			
			 	
				// $openpay = Openpay::getInstance($dataOpenpay["MERCHANT_ID"], $dataOpenpay["OPENPAY_KEY_SECRET"]);
				// Openpay::setProductionMode( $dataOpenpay["OPENPAY_PRUEBAS"] != 1 );
				// try {
				//	 $customer = $openpay->customers->get($openpay_cliente_id);
				// } catch (Exception $e) { 
				//	 $error = $e->getErrorCode()." - ".$e->getDescription();
				//	 $data = array( "error" => $error );
				//	 $data = serialize($data);
				//	 $wpdb->query("UPDATE cobros SET data = '{$data}' WHERE id = {$cobro->id};");
				// }
 
			if( $data["tipo_pago"] == "Tarjeta" && $error == "" ){
			
				$PayuP = unserialize($data['payu_metadata']);
				$charge = $payu->cobroTokenTDC( $PayuP );
	            $state = $charge->transactionResponse->state;

				$respuesta["state"] = $state;
				$respuesta["charge"] = $charge;

            	if( $state == 'APPROVED' ){
					$respuesta["transaccion"] = $charge->transactionResponse->transactionId;
					$respuesta["tarjeta"] = $card_id;
					$respuesta["activo"] = 1;

					$wpdb->query("UPDATE cobros SET openpay_transaccion_id = '".$respuesta['transaccion']."', status = 'Pagado' WHERE id = {$cobro->id};");
					crearNewCobro($cobro->item_orden, $time);					
	            }else{            	
					// $state == 'PENDING_TRANSACTION_REVIEW' || 
					// $state == 'PENDING_TRANSACTION_CONFIRMATION' ||
					// $state == 'PENDING_TRANSACTION_TRANSMISSION' ||
	            } 
			}

			if( $data["tipo_pago"] == "Tienda" && $error == "" ){

				$plan = $wpdb->get_var("SELECT plan FROM planes WHERE id = ".$suscripcion->plan);
				$due_date = date( 'Y-m-d\TH:i:s', strtotime('+ 48 hours', $time) );

				$chargeRequest = array(
				    'method' => 'store',
				    'amount' => (float) $suscripcion->total,
				    'description' => "Cobro de: ".$suscripcion->cantidad." - ".$producto->nombre." ( ".$producto->descripcion." )",
				    'order_id' => $suscripcion->id_orden."_CobroSuscripcion_".$time,
				    'due_date' => $due_date
				);

				include_once( "../wp-content/themes/kmibox/procesos/compra/pasarelas/payu/tienda.php" );
				if($_POST["error"]==""){

					if(isset($CARRITO["PDF"]) && !empty($CARRITO["PDF"])){
						$PDF = $CARRITO["PDF"];
						$HTML = generarEmail(
					    	"notificacion/cobro_tienda", 
					    	array(
					    		"USUARIO" => $nombre,
					    		"PLAN" => $plan,
					    		"INSTRUCCIONES" => $PDF,
					    		"TOTAL" => number_format( $total, 2, ',', '.')
					    	)
					    );

					    //wp_mail( $email, "Cobro en Tienda - NutriHeroes", $HTML );

					    $data = array(
					    	"error" => "",
					    	"pago_id" => $charge->id,
					    	"pdf" => $PDF,
					    	"vence" => $due_date
					    );
					    $data = serialize($data);

					    $wpdb->query("UPDATE cobros SET data = '{$data}' WHERE id = {$cobro->id};");						
					}

				}else{
				    $data = [ 'error' => $_POST['error'] ];
				    $data = serialize($data);
		        	$wpdb->query("UPDATE cobros SET data = '{$data}' WHERE id = {$cobro->id};");					
				}
			}
			
		} catch (Exception $e) {
        	$error = $e->getErrorCode()." - ".$e->getDescription();
		    $data = array(
		    	"error" => $error
		    );
		    $data = serialize($data);
        	$wpdb->query("UPDATE cobros SET data = '{$data}' WHERE id = {$cobro->id};");
	    }
		
	}

?>