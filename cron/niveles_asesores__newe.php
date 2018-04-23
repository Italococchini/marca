<?php

// Librerias
include_once("../wp-load.php");


/* ******************************************* *
 * Ejecutar proceso
 * ******************************************* */
$r = new niveles();
$ar = $r->init();


/* ******************************************* *
 * Depurar proceso
 * ******************************************* */
	// ==================
	echo '<pre style="width:30%; height:100%; right: 0px; border:1px solid #ccc; position:fixed; top: 0px; padding: 40px 0px 0px 0px">';
	print_r( $r->niveles );
	echo '</pre>';
	// ==================
	
	// ==================
	echo '<pre>';
	// print_r( $r->asesor_nivel );
	echo '<br><hr><hr><br>';
	print_r( $r->arbol );
	echo '</pre>';
	// ==================

class niveles{

	public $niveles;	
	public $asesor_nivel = [];
	public $arbol = [];
	protected $asesores;

	/* ******************************************* *
	 * Iniciar el proceso
	 * ******************************************* */
	public function init(){
		global $wpdb;

		// Cargar Niveles segun su Orden
		$_niveles = $wpdb->get_results( "SELECT id, nivel as nombre, orden FROM asesores_niveles ORDER BY orden ASC" );
		if( empty($_niveles) ){
			$err = [ "err" => 404, 'descripcion' => 'No existen niveles para asignar.' ];
			print_r($err);
			return $err;
		}

		$counter=0;
		foreach ($_niveles as $key => $nivel) {
			if( $nivel->orden > 0 ){
				$counter++;
				//$this->niveles[ $nivel->orden ] = $nivel->nombre;
				$this->niveles[$counter] = [ 'id'=>$nivel->id, 'name'=>$nivel->nombre ];
			}
		}

		// Cargar Todos los asesores
		$this->asesores = $wpdb->get_results( "SELECT id, codigo_asesor, parent FROM asesores" );

		// Crear Arbol [ Asesores principales ] 
		$this->arbol = $this->get_children( 0, $this->asesores );			

	}	

	/* ******************************************* *
	 * - Buscar Asesores "Hijos"
	 * - Actualizar Niveles de Asesores
	 * ******************************************* */
	protected function get_children( $parent, $data=[], $nivel=0, $parents=[] ){
		global $wpdb;

		// Nivel del asesor en la estructura del arbol
		$nivel++;

		// Buscar todos los hijos del padre " $parent "
		foreach( $data as $key => $item ){
			if( $item->parent == $parent ){

				// Nivel del Padre
				$parents[ $nivel-1 ] = $parent;

				// Buscar Suscripciones activas
				$cant_susc = $this->get_count_suscription( $item->id );
				//$cant_susc = 2; // forzar las suscripciones solo para depurar

				// Validar si posee el nivel de "Asesor"
				$nuevo_nivel = ( $cant_susc >= 2 )? 1 : 0; 

				// Asignar Primer Nivel al asesor
				$status = $this->niveles[ $nuevo_nivel ]['id'];

				// Buscar Hijos
				$datos = $this->get_children( $item->codigo_asesor, $data, $nivel, $parents );

				// Contar los Hijos
				$cantHijos = count($datos);

				// Agrupar los Niveles de los Hijos
				$hijos_identicos = [];
				$paso = 'NO'; // solo para depurar
				if( $cant_susc >= 2 && $cantHijos >= 2 ){
					$paso = 'SI'; // solo para depurar
					
					// Buscar el nivel de cada Hijo
					foreach ($datos as $key => $boy) {
						$hijos_identicos[ $boy['nivelID'] ]++;
					}

					// Validar nuevo nivel del asesor
					$nuevo_nivel = $this->validar_niveles( $hijos_identicos[ $_id ] );

					// Asignar Nivel 
					$status = $this->niveles[ $nuevo_nivel ]['id'];

				}

				// Actualizar nivel en DB
				$wpdb->query( "UPDATE asesores SET nivel = '{$status}' WHERE codigo_asesor = '{$item->codigo_asesor}'" );

				// Cargar Parametros para recursividad
				$result[ $item->codigo_asesor ] = [ 
					"dev" => [
						"BuscarNivel" => $paso,
						"GrupoNivel" => $hijos_identicos,
						"alto" => $nuevo_nivel,
						"bajo" => $nivel_bajo,
					],
					"ID" => $item->id, 
					"suscripcion" => $cant_susc,
					"hijoCant" => $cantHijos,
					"estructura" => $nivel-1, 
					"nivel" => $status,
					"nivelID" => $nuevo_nivel,
					"parents" => $parents,
					"hijo" => $datos,
				];

				// Solo para depurar [ listado de asesores con sus atributos ]
				$this->asesor_nivel[ $item->codigo_asesor ] = [
					"ID" => $item->id, 
					'nivel' => $status,
					"suscripcion" => $cant_susc,
					"hijoCant" => $cantHijos,
					'padre' => $parent,
				];

			}
		}
		return $result;
	}

	protected function validation_level( $children ){

		// verificar si todos tienen la misma cantidad de repeticiones
		/*$menor = 0;
		$mayor = 0;
		$valor = 0;
		foreach ($childre as $key => $value) {
			if(  )
		}*/

			// si es >= a 2 buscar el valor mas alto
			// si es < 	a 2 buscar el valor mas bajo

		// buscar el que posea mas repeticiones

		// verificar si es el ultimo nivel

	}

	/* ******************************************* *
	 * Total de suscripciones Activas por Asesor
	 * ******************************************* */
	protected function get_count_suscription($asesor_id){
		global $wpdb;
		$count = 0;
		if( $asesor_id > 0 ){
			$count = $wpdb->get_var( "SELECT count(id) FROM ordenes WHERE status = 'activa' and asesor = {$asesor_id}" );
		}
		return $count;
	}
}
