<?php

require_once "conexion.php";

class ModeloOrganigramas{

	/*============================================
	Mostrar todos los organigramas
	============================================*/

	static public function index($tabla, $cantidad, $desde){

		//$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
		if ($cantidad != null) {
			
			$stmt = Conexion::conectar()->prepare("SELECT $tabla.ID_ORGANIGRAMA, $tabla.AREA, $tabla.DESCRIPCION, $tabla.AREA_DEPENDE, $tabla.NIVEL, $tabla.TIPO_AREA, $tabla.TITULAR FROM $tabla LIMIT $desde, $cantidad");

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT $tabla.ID_ORGANIGRAMA, $tabla.AREA, $tabla.DESCRIPCION, $tabla.AREA_DEPENDE, $tabla.NIVEL, $tabla.TIPO_AREA, $tabla.TITULAR FROM $tabla");

		}

		$stmt -> execute();
		return $stmt -> fetchAll(PDO::FETCH_CLASS);
		$stmt -> close();
		$stmt = null;
	}

	/*============================================
	Creacion de un organigrama
	============================================*/

	static public function create($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(AREA, DESCRIPCION, AREA_DEPENDE, NIVEL, TIPO_AREA, TITULAR) VALUES (:AREA, :DESCRIPCION, :AREA_DEPENDE, :NIVEL, :TIPO_AREA, :TITULAR)");

		$stmt -> bindParam(":AREA", $datos["AREA"], PDO::PARAM_STR);
		$stmt -> bindParam(":DESCRIPCION", $datos["DESCRIPCION"], PDO::PARAM_STR);
		$stmt -> bindParam(":AREA_DEPENDE", $datos["AREA_DEPENDE"], PDO::PARAM_STR);
		$stmt -> bindParam(":NIVEL", $datos["NIVEL"], PDO::PARAM_STR);
		$stmt -> bindParam(":TIPO_AREA", $datos["TIPO_AREA"], PDO::PARAM_STR);
		$stmt -> bindParam(":TITULAR", $datos["TITULAR"], PDO::PARAM_STR);
		
		if ($stmt -> execute()) {
			
			return "ok";

		}else{

			print_r(Conexion::conectar()->errorInfo());

		}

		$stmt-> close();
		$stmt= null;

	}
	/*============================================
	Mostrar un solo organigrama
	============================================*/

	static public function show($tabla, $id){

		//$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id=:id");
		$stmt = Conexion::conectar()->prepare("SELECT $tabla.ID_ORGANIGRAMA, $tabla.AREA, $tabla.DESCRIPCION, $tabla.AREA_DEPENDE, $tabla.NIVEL, $tabla.TIPO_AREA FROM $tabla WHERE $tabla.ID_ORGANIGRAMA =:ID_ORGANIGRAMA");
		

		$stmt -> bindParam(":ID_ORGANIGRAMA", $id, PDO::PARAM_INT);

		$stmt -> execute();
		return $stmt -> fetchAll(PDO::FETCH_CLASS);
		$stmt -> close();
		$stmt = null;
	}

	/*============================================
	Actualizacion de un organigrama
	============================================*/

	static public function update($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET AREA=:AREA,DESCRIPCION=:DESCRIPCION,AREA_DEPENDE=:AREA_DEPENDE,NIVEL=:NIVEL,TIPO_AREA=:TIPO_AREA, TITULAR=:TITULAR WHERE ID_ORGANIGRAMA = :ID_ORGANIGRAMA");

		$stmt -> bindParam(":ID_ORGANIGRAMA", $datos["ID_ORGANIGRAMA"], PDO::PARAM_INT);
		$stmt -> bindParam(":AREA", $datos["AREA"], PDO::PARAM_STR);
		$stmt -> bindParam(":DESCRIPCION", $datos["DESCRIPCION"], PDO::PARAM_STR);
		$stmt -> bindParam(":AREA_DEPENDE", $datos["AREA_DEPENDE"], PDO::PARAM_INT);
		$stmt -> bindParam(":NIVEL", $datos["NIVEL"], PDO::PARAM_INT);
		$stmt -> bindParam(":TIPO_AREA", $datos["TIPO_AREA"], PDO::PARAM_INT);
		$stmt -> bindParam(":TITULAR", $datos["TITULAR"], PDO::PARAM_STR);

		if ($stmt -> execute()) {
			
			return "ok";

		}else{

			print_r(Conexion::conectar()->errorInfo());

		}

		$stmt-> close();
		$stmt= null;

	}
	/*============================================
	Borrar organigrama
	============================================*/

	static public function delete($tabla, $id){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE ID_ORGANIGRAMA = :ID_ORGANIGRAMA");

		$stmt -> bindParam(":ID_ORGANIGRAMA", $id, PDO::PARAM_INT);

		if ($stmt -> execute()) {
			
			return "ok";

		}else{

			print_r(Conexion::conectar()->errorInfo());

		}

		$stmt-> close();
		$stmt= null;

	}
}