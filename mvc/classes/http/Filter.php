<?php

class Filter {

    static function isCondincionInventada($value) {
        //esto validará la expresion pasada con una expresion regular determinada
        return preg_match('/^[A-Za-z][A-Za-z0-9]{5,9}$/', $value);
    }
    
    static function isBoolean($value) {
        if($value == true || $value == false){
            return true;
        }
        return false;
    }

    static function isDate($value) {
        return preg_match('^[0-9]{4}-[0-1][0-9]-[0-3][0-9]$',$value);
    }

    static function isEmail($value) {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }
    
    static function isTin($dni){
        $letra = substr($dni, -1);
    	$numeros = substr($dni, 0, -1);
    	if ( substr("TRWAGMYFPDXBNJZSQVHLCKE", $numeros%23, 1) == $letra && strlen($letra) == 1 && strlen ($numeros) == 8 ){
    		return true;
    	}else{
    		return false;
    	}
    }

    static function isFloat($value) {
        return is_float($value); //También puede ser usado FILTER_VALIDATE_FLOAT
    }

    static function isInteger($value) {
        return is_integer($value); //También puede ser usado FILTER_VALIDATE_INT
    }

    static function isIP($value) {
        return filter_var($value, FILTER_VALIDATE_IP);
    }

    static function isLogin($value) {
        //empieza por una letra y tiene mínimo 5 caracteres, sin espacios iniciales ni finales
        return preg_match('/^[A-Za-z][A-Za-z0-9]{4,}$/', $value);
    }

    static function isMaxLength($value, $length) {
        $number = strlen($value);
        if($number <= $length){
            return true;
        }
        return false;
    }

    static function isMinLength($value, $length) {
        $number = strlen($value);
        if($number > $length){
            return true;
        }
        return false;
    }

    static function isNumber($value) {
        return preg_match('/^[9|6|7|8][0-9]{8}$/', $value);
    }

    static function isTime($value) {
        return preg_match('(2[0-3][01][0-9]):([0-5][0-9])', $value);
    }

    static function isURL($value) {
        return filter_var($value, FILTER_VALIDATE_URL);
    }

}