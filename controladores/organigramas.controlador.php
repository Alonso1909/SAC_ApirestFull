<?php

class ControladorOrganigramas{

	/*============================================
	Mostrar todos los registros
	============================================*/

	public function index($page){


		if ($page != null) {
			
			/*============================================
			Mostrar organigramas con paginación
			============================================*/

			$cantidad = 10;
			$desde = ($page-1)*$cantidad;

			$organigramas = ModeloOrganigramas::index("organigrama", $cantidad, $desde);

		}else{

			/*============================================
			Mostrar todos los organigramas
			============================================*/

			$organigramas = ModeloOrganigramas::index("organigrama", null, null);

		}

		
		if (!empty($organigramas)) {
			

			$json = array(
				"status"=>200,
				"total_registros"=>count($organigramas),
				"detalle"=> $organigramas
			);

			echo json_encode($json, true);
			return;
		}else{

			$json = array(
				"status"=>200,
				"total_registros"=>0,
				"detalle"=> "No hay ningún organigrama registrado"
			);

			echo json_encode($json, true);
			return;

		}

	}
	/*============================================
	Crear un organigrama
	============================================*/

	public function create($datos){
		
		/*============================================
		Validar datos
		============================================*/

		foreach ($datos as $key => $valueDatos) {
	
			if (isset($ValueDatos) && !preg_match('/^[(\\)\\=\\&\\$\\;\\-\\_\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $ValueDatos)) {

				$json = array(
					"status"=>404,
					"detalle"=>"Error en el campo nombre".$key
				);

				echo json_encode($json, true);
				return;
			}
		}

		/*============================================
		Validar que el Area o la descripcion no estén repetidos
		============================================*/

		$organigramas = ModeloOrganigramas::index("organigrama", null, null);
		foreach ($organigramas as $key => $value) {
			
			if ($value->AREA == $datos["AREA"]) {

				$json = array(
					"status"=>404,
					"detalle"=>"El Area ya existe en la base de datos"
				);

				echo json_encode($json, true);
				return;
			}
			if ($value->DESCRIPCION == $datos["DESCRIPCION"]) {

				$json = array(
					"status"=>404,
					"detalle"=>"La descripción ya existe en la base de datos"
				);

				echo json_encode($json, true);
				return;
			}
		}

		/*============================================
		Llevar datos al modelo
		============================================*/

		$datos = array( "AREA"=>$datos["AREA"],
						"DESCRIPCION"=>$datos["DESCRIPCION"],
						"AREA_DEPENDE"=>$datos["AREA_DEPENDE"],
						"NIVEL"=>$datos["NIVEL"],
						"TIPO_AREA"=>$datos["TIPO_AREA"],
						"TITULAR"=>$datos["TITULAR"]);


		$create = ModeloOrganigramas::create("organigrama", $datos);
		/*============================================
		Respuesta del modelo
		============================================*/

		if ($create == "ok") {

			$json = array(
				"status"=>200,
				"detalle"=>"Registro exitoso, su organigrama ha sido guardado"
			);

			echo json_encode($json, true);
			return;
		}
	}#######
	/*============================================
	Mostrando un solo organigrama
	============================================*/

	public function show($id){
			
		/*============================================
		Mostrar todos los organigramas
		============================================*/

		$organigrama = ModeloOrganigramas::show("organigrama", $id);

		if (!empty($organigrama)) {
			

			$json = array(
				"status"=>200,
				"detalle"=> $organigrama
			);

			echo json_encode($json, true);
			return;
		}else{

			$json = array(
				"status"=>200,
				"total_registros"=>0,
				"detalle"=> "No hay ningún organigrama registrado aaaa"
			);

			echo json_encode($json, true);
			return;

		}

	}
	/*============================================
	Editar un organigrama
	============================================*/

	public function update($id, $datos){

		/*============================================
		Validar datos
		============================================*/

		foreach ($datos as $key => $valueDatos) {
	
			if (isset($ValueDatos) && !preg_match('/^[(\\)\\=\\&\\$\\;\\-\\_\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $ValueDatos)) {

				$json = array(
					"status"=>404,
					"detalle"=>"Error en el campo nombre".$key
				);

				echo json_encode($json, true);
				return;
			}

			/*============================================
			Llevar datos al modelo
			============================================*/

			$datos = array( "ID_ORGANIGRAMA"=>$id,
							"AREA"=>$datos["AREA"],
							"DESCRIPCION"=>$datos["DESCRIPCION"],
							"AREA_DEPENDE"=>$datos["AREA_DEPENDE"],
							"NIVEL"=>$datos["NIVEL"],
							"TIPO_AREA"=>$datos["TIPO_AREA"],
							"TITULAR"=>$datos["TITULAR"]);

			$update = ModeloOrganigramas::update("organigrama", $datos);
			/*============================================
			Respuesta del modelo
			============================================*/

			if ($update == "ok") {

				$json = array(
					"status"=>200,
					"detalle"=>"Registro exitoso, su organigrama ha sido actualizado"
				);

				echo json_encode($json, true);
				return;
			}
		}
	}
	/*============================================
	Borrar organigrama
	============================================*/

	public function delete($id){

		/*============================================
		Llevar datos al modelo
		============================================*/

		$delete = ModeloOrganigramas::delete("organigrama", $id);
		/*============================================
		Respuesta del modelo
		============================================*/

		if ($delete == "ok") {

			$json = array(
				"status"=>200,
				"detalle"=>"Se ha borrado su organigrama con éxito"
			);

			echo json_encode($json, true);
			return;
		}
	}
}