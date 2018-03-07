<?php

class ManageFamily {

    private $db;

    function __construct(DataBase $db) {
        $this->db = $db;
    }

    public function add(Family $objeto) {
        $sql = 'insert into family (family) 
        values (:family)';
        $params = array(
            'family' => $objeto->getFamily()
        );
        $resultado = $this->db->execute($sql, $params);
        if($resultado) {
            $id = $this->db->getId();
            $objeto->setId($id);
        } else {
            $id = 0;
        }
        return $id;
    }

    public function edit(Family $objeto) {
        $sql = 'UPDATE family SET family = :family WHERE id = :id';
        $params = array(
            'family' => $objeto->getFamily(),
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
        $sql = 'SELECT * FROM family WHERE id = :id';
        $params = array(
            'id'     => $id
        );
        $resultado = $this->db->execute($sql, $params);//true o false
        $sentencia = $this->db->getStatement();
        $family = new Family();
        if($resultado && $fila = $sentencia->fetch()) {
            $family->set($fila);
        } else {
            $family = null;//si la consulta falla o no encuentra el contacto
        }
        return $family;
    }

    public function getAll() {
        $sql = 'SELECT * FROM family order by nombre';
        $resultado = $this->db->execute($sql);
        $families = array();
        if($resultado){
            $sentencia = $this->db->getStatement();
            while($fila = $sentencia->fetch()) {
                $family = new Family();
                $family->set($fila);
                $families[] = $family;
            }
        }
        return $families;
    }

    public function remove($id) {
        $sql = 'DELETE FROM family WHERE id = :id';
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