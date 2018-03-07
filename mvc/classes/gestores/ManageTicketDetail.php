<?php

class ManageTicketDetail {

    private $db;

    function __construct(DataBase $db) {
        $this->db = $db;
    }
    
    public function add(TicketDetail $objeto) {
        $sql = 'insert into ticketdetail (idticket, idproduct, quantity, price) 
        values (:idticket, :idproduct, :quantity, :price)';
        $params = array(
            'idticket' => $objeto->getIdticket(),
            'idproduct' => $objeto->getIdproduct(),
            'quantity' => $objeto->getQuantity(),
            'price' => $objeto->getPrice()
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

    public function edit(TicketDetail $objeto) {
        $sql = 'UPDATE ticketdetail SET idticket = :idticket, idproduct = :idproduct, quantity = :quantity, price = :price  WHERE id = :id';
        $params = array(
            'idticket' => $objeto->getIdticket(),
            'idproduct' => $objeto->getIdproduct(),
            'quantity' => $objeto->getQuantity(),
            'price' => $objeto->getPrice(),
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
        $sql = 'SELECT * FROM ticketdetail WHERE id = :id';
        $params = array(
            'id'     => $id
        );
        $resultado = $this->db->execute($sql, $params);//true o false
        $sentencia = $this->db->getStatement();
        $ticketdetail = new TicketDetail();
        if($resultado && $fila = $sentencia->fetch()) {
            $ticketdetail->set($fila);
        } else {
            $ticketdetail = null;//si la consulta falla o no encuentra el contacto
        }
        return $ticketdetail;
    }

    public function getAll() {
        $sql = 'SELECT * FROM ticketdetail order by nombre';
        $resultado = $this->db->execute($sql);
        $ticketdetails = array();
        if($resultado){
            $sentencia = $this->db->getStatement();
            while($fila = $sentencia->fetch()) {
                $ticketdetail = new TicketDetail();
                $ticketdetail->set($fila);
                $ticketdetails[] = $ticketdetail;
            }
        }
        return $ticketdetails;
    }

    public function remove($id) {
        $sql = 'DELETE FROM ticketdetail WHERE id = :id';
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
    
    /************ CONSULTA PARA OBTENER LOS TICKETS Y SUS DETALLES POR FECHA ************/
    
    public function getByDate($dateTime){
        $sql = 'SELECT * FROM ticketDetail join ticket on idticket = ticket.id where dateTime = :dateTime order by nombre';
         $params = array(
            'dateTime' => $dateTime
        );
        $resultado = $this->db->execute($sql,$params);
        $ticketdetails = array();
        if($resultado){
            $sentencia = $this->db->getStatement();
            while($fila = $sentencia->fetch()) {
                $ticketdetail = new TicketDetail();
                $ticketdetail->set($fila);
                $ticketdetails[] = $ticketdetail;
            }
        }
        return $ticketdetails;
    }


}

