<?php

class ModeloClient extends Modelo{
    
    function addclient(Client $client){
        $manager = new ManageClient($this->getDataBase());
        $r = $manager->add($client);
        return $r;
    }
    
    function getAllClients(){
        $manager = new ManageClient($this->getDataBase());
        $r = $manager->getAll();
        return $r;
    }
    
    function getAllClientsByTin($tin){
        $manager = new ManageClient($this->getDataBase());
        $r = $manager->getAllByTin($tin);
        return $r;
    }
    
    
    function getClientById($id){
        $manager = new ManageClient($this->getDataBase());
        $r = $manager->get($id);
        return $r;
    }
    
    function getClientByName($name){
        $manager = new ManageClient($this->getDataBase());
        $r = $manager->getByName($name);
        return $r;
    }
    
    function editClient(Client $client){
        $manager = new ManageClient($this->getDataBase());
        $r = $manager->edit($client);
        return $r;
    }
    
    function removeClient($id){
        $manager = new ManageClient($this->getDataBase());
        return $manager->remove($id);
    }
    
    /*Cogemos los clientes con limites, es decir en un rango determinado*/
    function getPaginateClients($a, $b){
        $manager = new ManageClient($this->getDataBase());
        return $manager->getClientLimit($a, $b);
    }
    
    /*Contamos los clientes que hay*/
    function getCount(){
        $manager = new ManageClient($this->getDataBase());
        return $manager->getAllCount();
    }
    
    function checkClientByTin(Client $client){
        $manager = new ManageClient($this->getDataBase());
        $num = $manager->checkClientByTin($client->getTin());
        return $num;
    }
    
    function checkClientByName(Client $client){
        $manager = new ManageClient($this->getDataBase());
        $num = $manager->checkClientByName($client->getName());
        return $num;
    }
    
    
    
    
    
    
}