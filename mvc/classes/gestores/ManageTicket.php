<?php

class ManageTicket {

    private $db;

    function __construct(DataBase $db) {
        $this->db = $db;
    }
    
    public function add(Ticket $objeto) {
        $sql = 'insert into ticket (date, idmember, idclient) 
        values (:date,:idmember, :idclient)';
        $params = array(
            'date' => $objeto->getDatetime(),
            'idmember' => $objeto->getIdmember(),
            'idclient' => $objeto->getIdclient()
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

    public function edit(Ticket $objeto) {
        $sql = 'UPDATE ticket SET dateTime = :dateTime, idmember = :idmember, idclient = :idclient  WHERE id = :id';
        $params = array(
            'dateTime' => $objeto->getDateTime(),
            'idmember' => $objeto->getIdmember(),
            'idclient' => $objeto->getIdclient(),
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
        $sql = 'SELECT * FROM ticket WHERE id = :id';
        $params = array(
            'id'     => $id
        );
        $resultado = $this->db->execute($sql, $params);//true o false
        $sentencia = $this->db->getStatement();
        $ticket = new Ticket();
        if($resultado && $fila = $sentencia->fetch()) {
            $ticket->set($fila);
        } else {
            $ticket = null;//si la consulta falla o no encuentra el contacto
        }
        return $ticket;
    }

    public function getAll() {
        $sql = 'SELECT * FROM ticket order by nombre';
        $resultado = $this->db->execute($sql);
        $tickets = array();
        if($resultado){
            $sentencia = $this->db->getStatement();
            while($fila = $sentencia->fetch()) {
                $ticket = new Ticket();
                $ticket->set($fila);
                $tickets[] = $ticket;
            }
        }
        return $tickets;
    }

    public function remove($id) {
        $sql = 'DELETE FROM ticket WHERE id = :id';
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
    /******* DICHO POR CARMELO TODOS LOS TICKETS DE UN DIA *****/
    public function getByDate($dateTime){
        $sql = 'SELECT * FROM ticket where dateTime = :dateTime order by nombre';
         $params = array(
            'dateTime' => $dateTime
        );
        $resultado = $this->db->execute($sql,$params);
        $tickets = array();
        if($resultado){
            $sentencia = $this->db->getStatement();
            while($fila = $sentencia->fetch()) {
                $ticket = new Ticket();
                $ticket->set($fila);
                $tickets[] = $ticket;
            }
        }
        return $tickets;
        
        
    }

}

