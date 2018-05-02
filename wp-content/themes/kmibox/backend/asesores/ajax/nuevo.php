<?php
    extract($_POST);
    $raiz = dirname(dirname(dirname(dirname(dirname(dirname(__DIR__))))));
    include( $raiz."/wp-load.php" );
	global $wpdb;

	$exite = $wpdb->get_row("SELECT * FROM asesores WHERE email = '{$email}' or codigo_asesor = '{$codigo}' ");
	if( !isset($exite->id) ){

		$wpdb->query("
			INSERT INTO asesores (
				codigo_asesor,
				nombre,
				email,
				telefono
				) VALUES (
				'$codigo',
				'$nombre',
				'$email',
				'$telefono'
			)
		");
		
		// ************************
		// BEGIN Agregar a bitrix
		// ************************
		include_once($raiz.'/wp-content/themes/kmibox/lib/bitrix/bitrix.php');
		$bitrix->department($email);
		// ************************
		// END bitrix
		// ************************

		echo json_encode(array(
			"code" => 1
		));
	}else if( isset($exite->id) && $user_id == $exite->id  ){

			$wpdb->query("
			UPDATE asesores SET 
				codigo_asesor = '$codigo',
				nombre = '$nombre',
				telefono = '$telefono'
			WHERE id = $user_id
		");
 
		echo json_encode(array(
			"code" => 1
		));

	}else{
		echo json_encode(array(
			"code" => 0,
			"msg" => "Este código ya se encuentra registrado"
		));
	}
?>	