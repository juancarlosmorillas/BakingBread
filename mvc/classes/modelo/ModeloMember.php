<?php

class ModeloMember extends Modelo{
    
    function getMemberByLogin($member){
        $manager = new ManageMember($this->getDataBase());
        $memberdb = new Member();
        $memberdb = $manager->getMemberByLogin($member->getLogin());
        return $memberdb;
    }
    
    function checkMemberByLogin($member){
        $manager = new ManageMember($this->getDataBase());
        $num = $manager->checkMemberByLogin($member->getLogin());
        return $num;
    }
    
    function register($member){
        $manager = new ManageMember($this->getDataBase());
        $result = $manager->add($member);
        return $result;
    }
    
    function login($member){
        $manager = new ManageMember($this->getDataBase());
        $member = new Member();
        $member = $manager->getMemberByLogin($member->getLogin());
        return $member;
    }
     function getMemberById($id) {
        $manager = new ManageMember($this->getDataBase());
        return $manager->get($id);
    }
    
    function getAllMembers() {
        $manager = new ManageMember($this->getDataBase());
        return $manager->getAll();
    }
    
    function editMember(Member $member){
        $manager = new ManageMember($this->getDataBase());
        return $manager->edit($member);
    }
    function removeMember($id){
        $manager = new ManageMember($this->getDataBase());
        return $manager->remove($id);
    }
    
    /*Cogemos los miembros con limites, es decir en un rango determinado*/
    function getPaginateMembers($a, $b){
        $manager = new ManageMember($this->getDataBase());
        return $manager->getMemberLimit($a, $b);
    }
    
    /*Contamos los miembros que hay*/
    function getCount(){
        $manager = new ManageMember($this->getDataBase());
        return $manager->getAllCount();
    }
    
    
}