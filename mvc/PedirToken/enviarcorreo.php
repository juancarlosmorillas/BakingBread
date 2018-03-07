<?php
require '../classes/Autoload.php';
require_once 'vendor/autoload.php';
        session_start();
        $origen = Constants::CLIENTEMAIL;
        $alias = Constants::ALIAS;
        $destino = "mvalfer92@gmail.com";
        $asunto = "Polichia de wenos aires";
        $mensaje = "Emos resivido informaçao de que esta amenasando a su kerida besina Paquita del 4ºC, cuidese señor mio y arregle las goteras.";
        $cliente = new Google_Client();
        $cliente->setApplicationName(Constants::APPNAME);
        $cliente->setClientId(Constants::CLIENTID);
        $cliente->setClientSecret(Constants::CLIENTSECRET);
        $cliente->setAccessToken(file_get_contents(Constants::TOKEN));
        
        if ($cliente->getAccessToken()) {
            $service = new Google_Service_Gmail($cliente);
            try {
                $mail = new PHPMailer\PHPMailer\PHPMailer();
                $mail->CharSet = "UTF-8";
                $mail->From = $origen;
                $mail->FromName = $alias;
                $mail->AddAddress($destino);
                $mail->AddReplyTo($origen, $alias);
                $mail->Subject = $asunto;
                $mail->Body = $mensaje;
                $mail->preSend();
                $mime = $mail->getSentMIMEMessage();
                $mime = rtrim(strtr(base64_encode($mime), '+/', '-_'), '=');
                $mensaje = new Google_Service_Gmail_Message();
                $mensaje->setRaw($mime);
                $service->users_messages->send('me', $mensaje);
                echo "Correo enviado correctamente";
            } catch (Exception $e) {
                echo ("Error en el envío del correo: " . $e->getMessage());
            }
        } else {
            echo "No conectado con gmail";
        }