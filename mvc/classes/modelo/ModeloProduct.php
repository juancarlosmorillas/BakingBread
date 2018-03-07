<?php

class ModeloProduct extends Modelo{
    
    function addproduct(Product $product){
        $manager = new ManageProduct($this->getDataBase());
        $r = $manager->add($product);
        return $r;
    }
    
    function editProduct(Product $product){
        $manager = new ManageProduct($this->getDataBase());
        return $manager->edit($product);
    }
    
    function getAllLimitTPV(){
        $manager = new ManageProduct($this->getDataBase());
        $r = $manager->getAllLimitTPV();
        return $r;
    }
    
    function getAllLimitTPVPan(){
        $manager = new ManageProduct($this->getDataBase());
        $r = $manager->getAllLimitTPVPan();
        return $r;
    }
    
    function getAllLimitTPVCroissants(){
        $manager = new ManageProduct($this->getDataBase());
        $r = $manager->getAllLimitTPVCroissants();
        return $r;
    }
    
    function getAllLimitTPVNavidad(){
        $manager = new ManageProduct($this->getDataBase());
        $r = $manager->getAllLimitTPVNavidad();
        //echo var_dump($r);
        return $r;
    }
    
    function getAllLimitTPVOtros(){
        $manager = new ManageProduct($this->getDataBase());
        $r = $manager->getAllLimitTPVOtros();
        return $r;
    }
    
    function getAllProduct(){
        $manager = new ManageProduct($this->getDataBase());
        $r = $manager->getAll();
        return $r;
    }
    
    function getAllproductFamily(){
        $manager = new ManageProduct($this->getDataBase());
        $r = $manager->getAllProductFamily();
        return $r;
    }
    
    function getFamilyByNames($family){
        $manager = new ManageProduct($this->getDataBase());
        $r = $manager->getFamilyByName($family);
        return $r;
    }
    
    
    function getProductById($id){
       $manager = new ManageProduct($this->getDataBase());
       if($id !== null){
       $r = $manager->get($id);
       }
       return $r;
    }
    
    function removeProduct($id){
        $manager = new ManageProduct($this->getDataBase());
        return $manager->remove($id);
    }
    
    function getPaginateProducts($a, $b){
        $manager = new ManageProduct($this->getDataBase());
        return $manager->getProductLimit($a, $b);
    }
    
    
     function getCount(){
        $manager = new ManageProduct($this->getDataBase());
        return $manager->getAllCount();
    }
    function checkProductByProduct(Product $product){
        $manager = new ManageProduct($this->getDataBase());
        $num = $manager->checkProductByProduct($product->getProduct());
        return $num;
    }
    
    
    
}