<?php
//Para sacar los errores
error_reporting(E_ALL);
ini_set("display_errors", 1);

//Este index es el único punto de entrada a mi web
header('Content-Type: text/html; charset=utf-8');
require 'classes/AutoLoader.php';

$ruta = Request::read("ruta");//antes rutas, ahora controlador
$accion = Request::read("accion");//antes archivos, ahora métodos

$controladorFrontal = new ControladorFrontal($ruta);

$controladorFrontal->doAccion($accion);
echo $controladorFrontal->output($accion);