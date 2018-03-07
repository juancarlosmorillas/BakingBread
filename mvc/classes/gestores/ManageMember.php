<?php

class ManageMember {

    private $db;

    function __construct(DataBase $db) {
        $this->db = $db;
    }

    public function add(Member $objeto) {
        $sql = 'insert into member (login, password) values (:login, :password)';
        $params = array(
            'login' => $objeto->getLogin(),
            'password' => $objeto->getPassword()
        );
        $resultado = $this->db->execute($sql, $params);
        if($resultado) {
            $id = $this->db->getLastId();
            $objeto->setId($id);
        } else {
            $id = 0;
        }
        return $id;
    }
    
     public function checkMemberByLogin($login){
        $sql = 'select * from member where login = :login';
        $parametros = array(
            'login' => $login
        );
        $resultado = $this->db->execute($sql, $parametros);
        $members = array();
        if($resultado){
            $sentencia = $this->db->getStatement();
            while($fila = $sentencia->fetch()) {
                $member = new Member();
                $member->set($fila);
                $members[] = $member;
            }
        }
        return count($members);
    }
    
    function count(){
        $sql = 'SELECT count(*) from member';
        $res = $this->db->execute($sql);
        $cuenta = 0;
        if($res){
            $sentencia = $this->db->getStatement();
            if($fila = $sentencia->fetch()){
                $cuenta = $fila[0];
            }
        }
        return $cuenta;
        
    }

    public function edit(Member $objeto) {
        $sql = 'UPDATE member SET login = :login, password = :password WHERE id = :id';
        $params = array(
            'login' => $objeto->getLogin(),
            'password' => $objeto->getPassword(),
            'id'     => $objeto->getId()
        );
        $resultado = $this->db->execute($sql, $params);//true o false
        if($resultado) {
            $filasAfectadas = $this->db->getRowNumber();//0, 1
        } else {
            $filasAfectadas = -1;
        }
        return $filasAfectadas;
    }

    public function get($id) {
        $sql = 'SELECT * FROM member WHERE id = :id';
        $params = array(
            'id'     => $id
        );
        $resultado = $this->db->execute($sql, $params);//true o false
        $sentencia = $this->db->getStatement();
        $member = new Member();
        if($resultado && $fila = $sentencia->fetch()) {
            $member->set($fila);
        } else {
            $member = null;//si la consulta falla o no encuentra el contacto
        }
        return $member;
    }

    public function getAll() {
        $sql = 'SELECT * FROM member order by login';
        $resultado = $this->db->execute($sql);
        $members = array();
        if($resultado){
            $sentencia = $this->db->getStatement();
            while($fila = $sentencia->fetch()) {
                $member = new Member();
                $member->set($fila);
                $members[] = $member;
            }
        }
        return $members;
    }
    
    public function getAllLimit($offset, $rpp){
        $sql = 'select * from member order by 1 limit '. $offset . ', ' . $rpp;
        $resultado = $this->db->execute($sql);
        $objetos = array();
        if($resultado){
            $sentencia = $this->db->getStatement();
            while($fila = $sentencia->fetch()) {
                $objeto = new Member();
                $objeto->set($fila);
                $objetos[] = $objeto;
            }
        }
        return $objetos;
    }
    
    function getMemberLimit($a , $b){
        $sql = 'select * from member limit ' . $a . ',' . $b . ';';
        $params = array(
            'a' => $a,
            'b' => $b
        );
        $res = $this->db->execute($sql, $params);
        $members = array();
        if($res){
            $sentencia = $this->db->getStatement();
            while($fila = $sentencia->fetch()){
                $member = new Member();
                $member->set($fila);
                $members[] = $member;
            }
        }
        return $members;
    }
    
    function getAllCount(){
        $sql = 'select count(*) from member';
        $res = $this->db->execute($sql);
        if($res){
            $sentencia = $sentencia = $this->db->getStatement();
            $fila = $sentencia->fetch();
            return $fila[0];       
        }
        return $res;
    }
    
    public function getMemberByLogin($login){
        $sql = 'select * from member where login = :login';
        $parametros = array(
            'login' => $login
        );
        $resultado = $this->db->execute($sql, $parametros);
        $sentencia = $this->db->getStatement();
        $member = new Member();
        if($resultado && $fila = $sentencia->fetch()){
            $member->set($fila);
        }else{
            $member = null;
        }
        return $member;
    }
    

    public function remove($id) {
        $sql = 'DELETE FROM member WHERE id = :id';
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

}