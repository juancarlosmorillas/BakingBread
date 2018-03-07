<?php

class DataBase{
    private $conexion;
    private $sentencia;
    
    function __construct($clase = 'Constants'){ //Le pasamos la clase para que de esta forma sea mas accesible a los cambios que necesite
        try{
            $this->conexion = new PDO(
                'mysql:host=' . $clase::SERVER . ';dbname=' . $clase::DATABASE,
                $clase::USER,
                $clase::PASSWORD,
                array(
                    PDO::ATTR_PERSISTENT => true, // Atributo de persistencia, crea un pool(conjunto) de conexiones 
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'set names utf8'
                )
            ); 
        }catch(PDOException $e){
            $this->conexion = null; // Cerramos la conexion
        }
    }
    
    function execute($sql, array $parametros = array()){
        $this->sentencia = $this->conexion->prepare($sql);
        // Con este bucle sustituimos automaticamente los parámetros que pasamos
        foreach($parametros as $nombreParametro => $valorParametro){
            $this->sentencia->bindValue($nombreParametro, $valorParametro);
        }
        $r = $this->sentencia->execute(); //True o false
        //Estas líneas se descomentan cuando algo falla, de esta forma sabremos que falla, ojo con los headers en la otra pagina que haran que no se vean los errores
        /*
        echo $sql . '<br>';
        echo Util::varDump($parametros);
        echo Util::varDump($this->sentencia->errorInfo());
        //*/
        return $r;
    }
    
    function isConnected(){ //
        return $this->conexion !== null;
    }
    
    function closeConnection(){ //Cierra la conexion igualando a null la variable conexion
        $this->conexion = null;
    }
    
    function getRowNumber(){ //Devuelve el numero de filas afectadas por la sentencia ejecutada
        return $this->sentencia->rowCount();
    }
    
    function getLastId(){
        return $this->conexion->lastInsertId();
    }
    
    function getId(){
        return $this->conexion->lastInsertId();
    }
    
    function getStatement(){
        return $this->sentencia;
    }
}