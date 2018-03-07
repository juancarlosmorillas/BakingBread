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

if (!$cliente->getAccessToken()) {
    $auth = $cliente->createAuthUrl();
    header("Location: $auth");
}