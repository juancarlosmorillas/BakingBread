<?php

class Util{
    
    static function varDump($valor){ //método para hacer un var_dump de forma más bonita
        return '<pre>' . var_export($valor, true) . '</pre>';
    }
    
    /*Metodo que te saca un select en html a partir de un array bidimensional (primero un id y después el texto que lo acompaña)*/
    static function selectWriterContact($object){
        $r = '<select name="idcontact" class="form-control">'; 
        
        for($i = 0; $i < count($object); $i++){
            $r .= '<option value="' . $object[$i][0] . '">' . $object[$i][1] . '</option>';
        }
        
        $r .= '</select><br>';
        return $r;
    }
    
    static function selectWriterUser($object){
        $r = '<select name="iduser" >'; 
        
        for($i = 0; $i < count($object); $i++){
            $r .= '<option value="' . $object[$i][0] . '">' . $object[$i][1] . '</option>';
        }
        
        $r .= '</select>';
        return $r;
    }
    
    //Encripta la clave y devuelve la clave encriptada
    static function encryptPassword($key){
        $opciones = array(
            'cost' => 10 //nivel de seguridad, cuanto mayor sea mayor sera la seguridad, pero sera mas lento
        );
        $keyEncripted = password_hash($key, PASSWORD_DEFAULT, $opciones);
        return $keyEncripted;
    }
    
    //verificamos que una contraseña coincide con otra encriptada con hash
    static function verifyPassword($password, $hash){
        return password_verify($password, $hash);
    }
    
    //envio de correos de verificación
    static function enviarCorreo($destino, $asunto, $mensaje){
        require_once 'classes/vendor/autoload.php';
        session_start();
        $origen = Constants::CLIENTEMAIL;
        $alias = Constants::ALIAS;
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
                $mail->isHtml();
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
    }
    
    static function renderText($text, array $data = array()) {
        foreach ($data as $indice => $dato) {
            $text = str_replace('{{' . $indice . '}}', $dato, $text);
        }
        //quitar los {{...}} restantes
        $text = preg_replace('/{{[^\s]+}}/', '', $text);
        return $text;
    }
    
    static function renderTemplate($template, array $data = array()) {
        if (!file_exists($template)) {
            return '';
        }
        $content = file_get_contents($template);
        return self::renderText($content, $data);
    }
}