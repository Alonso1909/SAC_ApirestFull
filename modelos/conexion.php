<?php

class Conexion{

	static public function conectar(){

		$link = new PDO("mysql:host=localhost;dbname=sac","root","");
		#$link = new PDO("mysql:host=85.187.158.121;dbname=sac","sistema_sac","6t2zsqOPOV58Sfd2");

		$link->exec("set names utf8");
		return $link;
	}
}