<?php

class Modelo{
    
    private $data;
    private $dataBase;
    
    function __construct(){
        $this->data = array();
        $this->dataBase = new DataBase();
    }
    
    function _destruct(){
        $this->dataBase->closeConnection();
    }
    
    function getDataBase(){
        return $this->dataBase;
    }
    
    function getData($name){
        if(isset($this->data[$name])){
            return $this->data[$name];
        }
        return null;
    }
    
    function getDatos(){
        return $this->data;
    }
    
    function setData($name, $data){
        $this->data[$name] = $data;
    }
}