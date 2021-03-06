<?php
	$raiz = (dirname(dirname(dirname(dirname(dirname(dirname(__DIR__)))))));
	include($raiz."/wp-load.php");

	extract($_POST);

	global $wpdb;

	$_status = $wpdb->get_var("SELECT status FROM despachos WHERE id = {$ID}");

	$status = array(
		"Pendiente",
		"Armada",
		"Enviada",
		"Recibida"
	);

	$opciones = "";
	foreach ($status as $value) {
		$opciones .= "
			<option ".selected( $_status, $value, false).">{$value}</option>
		";
	}

	$HTML = '
		<form id="status_despacho">
			<input type="hidden" id="ID" name="ID" value="'.$ID.'">
			<div class="celdas_1">
				<div class="input_box">
					<label>Status del despacho:</label>
					<select id="status" name="status" style="width: 100%;"> '.$opciones.' </select>
				</div>
			</div>
			<div class="botonera_container">
				<input type="button" value="Actualizar" name="update" onClick="actualizarStatus()" class="button button-primary button-large" />
			</div>
		</div>
	';


	echo $HTML;
?>