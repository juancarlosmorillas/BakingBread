<?php 

class Member {
    
    private $id, $login, $password;
    
    function __construct($id = null, $login = null, $password = null){
        
        $this->id = $id;
        $this->login = $login;
        $this->password = $password;
    }
    
     function getId() {
        return $this->id;
    }
    
     function getLogin() {
        return $this->login;
    }
    
     function getPassword() {
        return $this->password;
    }
    
    function setId($id) {
        $this->id = $id;
    }
    
    function setLogin($login) {
        $this->login = $login;
    }
    
    function setPassword($password) {
        $this->password = $password;
    }
    
      /****************** común a todas las clases *******************/
      
      function getAttributesValues(){
        $valoresCompletos = [];
        foreach($this as $atributo => $valor){
            $valoresCompletos[$atributo] = $valor;
        }
        return $valoresCompletos;
    }
    
    function read(){
        foreach($this as $atributo => $valor){
            $this->$atributo = Request::read($atributo);
        }
    }
    
    function set(array $array, $pos = 0){
        foreach ($this as $campo => $valor) {
            if (isset($array[$pos]) ) {
                $this->$campo = $array[$pos];
            }
            $pos++;
        }
    }
    
    function setFromAssociative(array $array){
        foreach($this as $indice => $valor){
            if(isset($array[$indice])){
                $this->$indice = $array[$indice];
            }
        }
    }
    
    public function __toString() {
        $cadena = get_class() . ': ';
        foreach($this as $atributo => $valor){
            $cadena .= $atributo . ': ' . $valor . ', ';
        }
        return substr($cadena, 0, -2);
    }
}