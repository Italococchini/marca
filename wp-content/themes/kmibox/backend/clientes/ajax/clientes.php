<?php

    date_default_timezone_set('America/Mexico_City');

    $raiz = dirname(dirname(dirname(dirname(dirname(dirname(__DIR__))))));
    include( $raiz."/wp-load.php" );

	global $wpdb;

	$clientes = $wpdb->get_results("SELECT * FROM wp_users ORDER BY ID DESC");

	$data["data"] = array();
	$excel = array();

	foreach ($clientes as $cliente) {

		$_metadata = get_user_meta($cliente->ID);
		$metadata = array();
		foreach ($_metadata as $key => $value) {
			$metadata[ $key ] = $value[0];
		}

		$donde = $metadata[ "dondo_conociste" ];
		if( !isset($metadata[ "dondo_conociste" ]) ){
			$donde = "otros";
		}

		if( !isset($metadata["is_user_kmimos"]) ){
			$metadata["is_user_kmimos"] = "NO";
		}

		$_es_asesor =  $wpdb->get_row("SELECT * FROM asesores WHERE email = '{$cliente->user_email}' ");
		$es_asesor = "";
		$es_asesor_excel = "";
		if( $_es_asesor != null ){
			$es_asesor = $_es_asesor->codigo_asesor;
			$es_asesor_excel = $_es_asesor->codigo_asesor;
		}else{
			$es_asesor = "<span 
	        		onclick='abrir_link( jQuery( this ) )' 
	        		data-id='".$cliente->ID."' 
	        		data-titulo='Convertir en Asesor' 
	        		data-modulo='clientes' 
	        		data-modal='asignar_asesor' 
	        		class='enlace' style='text-align: center;'
	        	>NO</span>";
			$es_asesor_excel = "NO";
		}

		$data["data"][] = array(
	        $cliente->ID,
	        date("d/m/Y", strtotime($cliente->user_registered)),
	        "<a href='".get_home_url()."/?i=".md5($cliente->ID)."' target='_blank'>".$metadata[ "first_name" ]." ".$metadata[ "last_name" ]."</a>",
	        $cliente->user_email,
	        $metadata[ "telef_movil" ],
	        strtoupper( $donde ),
	        $metadata["is_user_kmimos"],
	        $es_asesor
	    );

		$excel[] = array(
	        $cliente->ID,
	        date("d/m/Y", strtotime($cliente->user_registered)),
	        $metadata[ "first_name" ]." ".$metadata[ "last_name" ],
	        array(
	        	"valor" => $cliente->user_email,
	        	"tipo" => "link",
	        	"link" => get_home_url()."/?i=".md5($cliente->ID)
	        ),
	        $metadata[ "telef_movil" ],
	        strtoupper( $donde ),
	        $metadata["is_user_kmimos"],
	        $es_asesor
	    );
	}

	if( isset($_GET["excel"]) ){
    	crearEXCEL(array(
			"nombre" => "Reporte de Clientes",
			"file_name" => "clientes",
			"titulos" => array(
				"ID",
                "Fecha Registro",
                "Nombre y Apellido",
                "Email",
                "Teléfono",
                "Donde nos conocio?",
                "Usuario Kmimos",
                "Asesor"
			),
			"data" => $excel
		));
    }else{
    	echo json_encode($data);
    }

?>