<?php

$arrayRutas = explode("/", $_SERVER['REQUEST_URI']);

if (isset($_GET["page"]) && is_numeric($_GET["page"])) {
	
	$organigramas = new ControladorOrganigramas();
	$organigramas -> index($_GET["page"]);

}else{

	if (count(array_filter($arrayRutas)) == 0) {

		/*============================================
		Cuando no se hace ninguna petición a la API
		============================================*/

		$json = array(
			"detalle" => "no encontrado 1" 
		);

		echo json_encode($json, true);
		return;
	}else{
		/*============================================
		Cuando pasamos solo un índice en el array $arrayRutas
		============================================*/

		if (count(array_filter($arrayRutas)) == 1) {

			/*============================================
			Cuando se hace peticiones desde organigrama
			============================================*/

			if (array_filter($arrayRutas)[1] == "organigrama") {
				
				/*============================================
				Peticiones GET
				============================================*/

				if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "GET") {
					
					$organigramas = new ControladorOrganigramas();
					$organigramas -> index(null);
				}
				/*============================================
				Peticiones POST
				============================================*/

				else if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST") {

					/*============================================
					Capturar datos
					============================================*/

					$datos = array( "AREA"=>$_POST["AREA"],
									"DESCRIPCION"=>$_POST["DESCRIPCION"],
									"AREA_DEPENDE"=>$_POST["AREA_DEPENDE"],
									"NIVEL"=>$_POST["NIVEL"],
									"TIPO_AREA"=>$_POST["TIPO_AREA"],
									"TITULAR"=>$_POST["TITULAR"]);

					$crearOrganigrama = new ControladorOrganigramas();
					$crearOrganigrama -> create($datos);

				}else{
					$json = array(
						"detalle" => "no encontrado 2" 
					);

					echo json_encode($json, true);
					return;
				}
			}else{
				$json = array(
					"detalle" => "no encontrado 3" 
				);

				echo json_encode($json, true);
				return;
			}	
		}else{#

			/*============================================
			Cuando se hace peticiones desde un solo organigrama
			============================================*/

			if (array_filter($arrayRutas)[1] == "organigrama" && is_numeric(array_filter($arrayRutas)[2])) {

				/*============================================
				Peticiones GET
				============================================*/

				if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "GET") {
					
					$organigrama = new ControladorOrganigramas();
					$organigrama -> show(array_filter($arrayRutas)[2]);
				}
				/*============================================
				Peticiones PUT
				============================================*/

				else if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "PUT") {

					/*============================================
					Capturar datos
					============================================*/

					$datos = array();
					
					parse_str(file_get_contents('php://input'), $datos);

					$editarOrganigrama = new ControladorOrganigramas();
					$editarOrganigrama -> update(array_filter($arrayRutas)[2], $datos);
				}
				/*============================================
				Peticiones DELETE
				============================================*/

				else if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "DELETE") {
					
					$borrarOrganigrama = new ControladorOrganigramas();
					$borrarOrganigrama -> delete(array_filter($arrayRutas)[2]);
				}else{
					$json = array(
						"detalle" => "no encontrado 4" 
					);

					echo json_encode($json, true);
					return;
				}
			}else{
				$json = array(
					"detalle" => "no encontrado 5" 
				);

				echo json_encode($json, true);
				return;
			}
		}
	}
}