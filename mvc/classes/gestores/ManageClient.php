<?php

class ManageClient {

    private $db;

    function __construct(DataBase $db) {
        $this->db = $db;
    }

    public function add(Client $objeto) {
        $sql = 'insert into client (name, surname, tin, address, location, postalcode, province, email) values (:name, :surname, :tin, :address, :location, :postalcode, :province, :email)';
        $params = array(
            'name' => $objeto->getName(),
            'surname' => $objeto->getSurname(),
            'tin' => $objeto->getTin(),
            'address' => $objeto->getAddress(),
            'location' => $objeto->getLocation(),
            'postalcode' => $objeto->getPostalCode(),
            'province'=> $objeto->getProvince(),
            'email' => $objeto->getEmail()
        );
        $resultado = $this->db->execute($sql, $params);
        if($resultado) {
            $id = $this->db->getLastId();
        } else {
            $id = 0;
        }
        return $id;
    }

    public function edit(Client $objeto) {
        $sql = 'UPDATE client SET name = :name, surname = :surname, tin = :tin, address = :address,
        location = :location, postalcode = :postalcode, province = :province, email = :email WHERE id = :id';
        $params = array(
            'name' => $objeto->getName(),
            'surname' => $objeto->getSurname(),
            'tin' => $objeto->getTin(),
            'address' => $objeto->getAddress(),
            'location' => $objeto->getLocation(),
            'postalcode' => $objeto->getPostalCode(),
            'province'=> $objeto->getProvince(),
            'email' => $objeto->getEmail(),
            'id'     => $objeto->getId()
        );
        /*echo Util::varDump($params);
        exit;*/
        $resultado = $this->db->execute($sql, $params);//true o false
        if($resultado) {
            $filasAfectadas = $this->db->getRowNumber();//0, 1
        } else {
            $filasAfectadas = -1;
        }
        return $filasAfectadas;
    }

    public function get($id) {
        $sql = 'SELECT * FROM client WHERE id = :id';
        $params = array(
            'id'     => $id
        );
        $resultado = $this->db->execute($sql, $params);//true o false
        $sentencia = $this->db->getStatement();
        $client = new Client();
        if($resultado && $fila = $sentencia->fetch()) {
            $client->set($fila);
        } else {
            $client = null;//si la consulta falla o no encuentra el contacto
        }
        return $client;
    }
     public function getByName($name) {
        $sql = 'SELECT * FROM client WHERE name = :name';
        $params = array(
            'name'     => $name
        );
        $resultado = $this->db->execute($sql, $params);//true o false
        $sentencia = $this->db->getStatement();
        $client = new Client();
        if($resultado && $fila = $sentencia->fetch()) {
            $client->set($fila);
        } else {
            $client = null;//si la consulta falla o no encuentra el contacto
        }
        return $client;
    }


    public function getAll() {
        $sql = 'SELECT * FROM client order by name';
        $resultado = $this->db->execute($sql);
        $clients = array();
        if($resultado){
            $sentencia = $this->db->getStatement();
            while($fila = $sentencia->fetch()) {
                $client = new Client();
                $client->set($fila);
                $clients[] = $client;
            }
        }
        return $clients;
    }
    
    function getClientLimit($a , $b){
        $sql = 'select * from client limit ' . $a . ',' . $b . ';';
        $params = array(
            'a' => $a,
            'b' => $b
        );
        $res = $this->db->execute($sql, $params);
        $clients = array();
        if($res){
            $sentencia = $this->db->getStatement();
            while($fila = $sentencia->fetch()){
                $client = new Client();
                $client->set($fila);
                $clients[] = $client;
            }
        }
        return $clients;
    }
    
    function getAllCount(){
        $sql = 'select count(*) from client';
        $res = $this->db->execute($sql);
        if($res){
            $sentencia = $sentencia = $this->db->getStatement();
            $fila = $sentencia->fetch();
            return $fila[0];       
        }
        return $res;
    }

    public function remove($id) {
        $sql = 'DELETE FROM client WHERE id = :id';
        $params = array(
            'id'     => $id
        );
        $resultado = $this->db->execute($sql, $params);//true o false
        if($resultado) {
            $filasAfectadas = $this->db->getRowNumber();//0, 1
        } else {
            $filasAfectadas = -1;
        }
        return $filasAfectadas;
    }
    
    public function checkClientByTin($tin){
        $sql = 'select * from client where tin = :tin';
        $parametros = array(
            'tin' => $tin
        );
        $resultado = $this->db->execute($sql, $parametros);
        $clients = array();
        if($resultado){
            $sentencia = $this->db->getStatement();
            while($fila = $sentencia->fetch()) {
                $client = new Client();
                $client->set($fila);
                $clients[] = $client;
            }
        }
        return count($clients);
    }
    
    public function checkClientByName($name){
        $sql = 'select * from client where name = :name';
        $parametros = array(
            'name' => $name
        );
        $resultado = $this->db->execute($sql, $parametros);
        $clients = array();
        if($resultado){
            $sentencia = $this->db->getStatement();
            while($fila = $sentencia->fetch()) {
                $client = new Client();
                $client->set($fila);
                $clients[] = $client;
            }
        }
        return count($clients);
    }
    
     public function getAllByTin($tin) {
        $sql = 'SELECT * FROM client where tin = :tin';
         $parametros = array(
            'tin' => $tin
        );
        $resultado = $this->db->execute($sql, $parametros);
        $clients = array();
        if($resultado){
            $sentencia = $this->db->getStatement();
            while($fila = $sentencia->fetch()) {
                $client = new Client();
                $client->set($fila);
                $clients[] = $client;
            }
        }
        return $clients;
    }



}