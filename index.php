<?php

require_once "controladores/rutas.controlador.php";
require_once "controladores/organigramas.controlador.php";

require_once "modelos/organigramas.modelo.php";

$rutas = new controladorRutas();
$rutas -> index();