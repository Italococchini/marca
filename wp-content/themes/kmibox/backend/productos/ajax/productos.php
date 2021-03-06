<?php

    date_default_timezone_set('America/Mexico_City');

    $raiz = dirname(dirname(dirname(dirname(dirname(dirname(__DIR__))))));
    include( $raiz."/wp-load.php" );

	global $wpdb;

	$productos = $wpdb->get_results("SELECT * FROM productos ORDER BY id DESC");
	$data_planes = $wpdb->get_results("SELECT * FROM planes ORDER BY id ASC");
	$_planes = array();
	foreach ($data_planes as $plan) {
		$_planes[ $plan->id ] = $plan->plan;
	}

	foreach ($productos as $producto) {

		$dataextra = unserialize( $producto->dataextra );
		$img = TEMA()."/productos/imgs/".$dataextra["img"];

		$tamanos = array();
		foreach (unserialize($producto->tamanos) as $key => $value) {
			if( $value == 1 ){ $tamanos[] = $key; }
		}

		$edades = array();
		foreach (unserialize($producto->edades) as $key => $value) {
			if( $value == 1 ){ $edades[] = $key; }
		}

		$presentaciones = array();
		foreach (unserialize($producto->presentaciones) as $key => $value) {
			if( $value > 0 ){ 
				$presentaciones[] = "$ ".number_format( $value, 2, ',', '.')." (".$key.")"; 
			}
		}

		$planes = array();
		foreach (unserialize($producto->planes) as $key => $value) {
			if( $value > 0 ){ 
				$planes[] = $_planes[ $key ]; 
			}
		}

		$data["data"][] = array(
	        "<img class='img_reporte' src='".$img."' />",
	        $producto->id,
	        $producto->nombre,
	        implode("<br>", $tamanos ),
	        implode("<br>", $edades ),
	        implode("<br>", $presentaciones ),
	        implode("<br>", $planes ),
	        "<div style='text-align: center;'>".$producto->status."</div>",
	        "
	        	<span 
	        		onclick='abrir_link( jQuery( this ) )' 
	        		data-id='".$producto->id."' 
	        		data-titulo='Editar Producto' 
	        		data-modulo='productos' 
	        		data-modal='nuevo' 
	        		class='enlace'
	        	>Editar</span><br>
	        	<span onclick='eliminar_producto( jQuery( this ) )' data-id='".$producto->id."' class='enlace'>Eliminar</span><br>
	        "
	    );
	}

    echo json_encode($data);

?>