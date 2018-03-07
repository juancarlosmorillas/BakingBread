<?php
session_start();
require_once 'vendor/autoload.php';
$cliente = new Google_Client();
$cliente->setApplicationName('Bakingbread');
$cliente->setClientId('1039406309587-85iedqbpju526nstqjq7k2qc3pjapv22.apps.googleusercontent.com');
$cliente->setClientSecret('qON4MgHtMUYo2JTRP3XV55CF');
$cliente->setRedirectUri('https://proyecto-panaderia-juankamorillas.c9users.io/mvc/PedirToken/guardartoken.php');
$cliente->setScopes('https://www.googleapis.com/auth/gmail.compose');
$cliente->setAccessType('offline');

if (isset($_GET['code'])) {
    $cliente->authenticate($_GET['code']);
    $_SESSION['token'] = $cliente->getAccessToken();
    $archivo = "token.conf";
    $fh = fopen($archivo, 'w') or die("error");
    fwrite($fh, json_encode($cliente->getAccessToken()));
    fclose($fh);
    header("Location: terminar.php?code=" . $_GET['code']);
}