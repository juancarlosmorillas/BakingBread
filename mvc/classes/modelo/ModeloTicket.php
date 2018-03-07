<?php
class ModeloTicket extends Modelo{
    
    function addTicket(Ticket $ticket){
        $manager = new ManageTicket($this->getDataBase());
        $r = $manager->add($ticket);
        //echo Util::varDump($r);
        return $r;
    }
    
    function addTicketDetail(TicketDetail $ticketdetail){
        $manager = new ManageTicketDetail($this->getDataBase());
        $r = $manager->add($ticketdetail);
        return $r;
    }

}