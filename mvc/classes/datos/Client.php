<?php 

class Client {
    
    private $id, $name, $surname, $tin, $address, $location, $postalcode, $province, $email;
    
    function __construct($id = null, $name= null, $surname = null,
    $tin = null, $address = null, $location = null, $postalcode = null,
    $province = null, $email = null ){
        
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->tin = $tin;
        $this->address = $address;
        $this->location = $location;
        $this->postalcode = $postalcode;
        $this->province = $province;
        $this->email = $email;
        
    }

   function getId() {
        return $this->id;
    }
      
    function getName() {
        return $this->name;
    }
    
    function getSurname() {
        return $this->surname;
    }
    
    function getTin() {
        return $this->tin;
    }
    
    function getAddress() {
        return $this->address;
    }
    
    function getLocation() {
        return $this->location;
    }
    
    function getPostalCode() {
        return $this->postalcode;
    }
    
    function getProvince() {
        return $this->province;
    }
    
    function getEmail() {
        return $this->email;
    }
    
    function setId($id) {
        $this->id = $id;
    }
    
    function setName($name) {
        $this->name = $name;
    }
    
    function setSurname($surname) {
        $this->surname = $surname;
    }
    
    function setTin($tin){
        $this->tin = $tin; 
    }
    
    function setAddress($address) {
        $this->address = $address;
    }
    
    function setLocation($location) {
        $this->location = $location;
    }
    
    function setPostalCode($id) {
        $this->postalcode = $postalcode;
    }
    
    function setProvince($id) {
        $this->province = $province;
    }
    
    function setEmail($email) {
        $this->email = $email;
    }
    
    function getAttributes(){
        $attributes =[];
        
        foreach($this as $attributes => $attribute){
            $attributes[] = $attribute;
        }
        
        return $attributes; 
    }
    
    /*Da un array con los valores de los atributos de un objeto, pero no el nombre del atributo*/
    function getValues(){
        $values = [];
        
        foreach($this as $valor){
            $values[] = $valor;
        }
        
        return $values;
    }
    
    /*Devuelve un array asociativo, en el que los indices son los nombres de los atributos y en el que los valores son los valores de los atributos*/
    function getValuesAttributes(){
        $complete = [];
        
        foreach($this as $attribute => $valor){
            $complete[$attribute] = $valor;
        }
        
        return $complete;
    }
    
    /*Lee un objeto utilizando la clase Request*/
    function read(){
        foreach($this as $attribute => $valor){
            $this->$attribute = Request::read($attribute);
        } 
    }
    
    /*Este set convierte un array numerico en objeto, $this es el objeto al que le vamos a asignar los valores del array*/
    function set(array $array, $pos = 0){
        foreach($this as $field => $valor){
            if(isset($array[$pos])){
                $this->$field = $array[$pos];
            }
            $pos++;
        }
    }
    
    /*En este array se hace lo mismo que antes pero con un array asociativo, en este caso cogemos el array y sus indices y valores para recorrerlo en lugar del objeto, 
    después vemos si esta seteado el indice en el array, y si lo esta lo asociamos al atributo que le corresponda del objeto con $this->$indice 
    (donde $indice corresponde a titular, dni, fecha de nacimiento, etc del objeto) y le asociamos el campo del array con el mismo 
    nombre del atributo del objeto ($indice corresponde a $array[$indice] -> ambos serian titular, dni, fecha de nacimiento, etc )*/
    function setAsociative(array $array){
        foreach($this as $index => $valor){
            if(isset($array[$index])){
                $this->$index = $array[$index];
            }
        }
    }
}