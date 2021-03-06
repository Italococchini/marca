<?php 
	$raiz = (dirname(dirname(dirname(dirname(dirname(dirname(__DIR__)))))));
	include($raiz."/wp-load.php");

	global $wpdb;

	extract($_POST);

	$_tamanos = array(
		"Pequeño" => 0,
		"Mediano" => 0,
		"Grande" => 0
	);

	$_edades = array(
		"Cachorro" => 0,
		"Adulto" => 0,
		"Maduro" => 0
	);

	$_presentaciones = array(
		"900g" => 0,
		"2000g" => 0,
		"4000g" => 0
	);

	$data_planes = $wpdb->get_results("SELECT * FROM planes ORDER BY id ASC");
	$_planes = array();
	foreach ($data_planes as $plan) {
		$_planes[ $plan->id ] = 0;
	}

	foreach ($tamanos as $key => $value) { $_tamanos[$value] = 1; }
	foreach ($edades as $key => $value) { $_edades[$value] = 1; }
	foreach ($_presentaciones as $key => $value) { 
		$_presentaciones[$key] = $_POST[$key]; 
	}
	foreach ($planes as $key => $value) { $_planes[$value] = 1; }

	$img = guardarImg(
		dirname(dirname(dirname(__DIR__)))."/productos/imgs/", 
		$img_producto
	);

	$dataextra = array(
		"img" => $img
	);

	$SQL = "
		INSERT INTO productos VALUES (
			NULL,
			'$nombre',
			'".serialize($_tamanos)."',
			'".serialize($_edades)."',
			'".serialize($_presentaciones)."',
			'".serialize($_planes)."',
			'".serialize($dataextra)."',
			'Activo'
		);
	";

	$wpdb->query( $SQL );
?>