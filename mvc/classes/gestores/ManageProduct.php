<?php

class ManageProduct {

    private $db;

    function __construct(DataBase $db) {
        $this->db = $db;
    }

    public function add(Product $objeto) {
        $sql = 'insert into product (id, idfamily, product, price, description) 
        values (null, :idfamily, :product, :price, :description)';
        $params = array(
            'idfamily' => $objeto->getIdfamily(),
            'product' => $objeto->getProduct(),
            'price' => $objeto->getPrice(),
            'description' => $objeto->getDescription()
        );
        /*echo Util::varDump($params);
        exit;*/
        $resultado = $this->db->execute($sql, $params);
        if($resultado) {
            $id = $this->db->getLastId();
        } else {
            $id = 0;
        }
        return $id;
    
    }

    public function edit(Product $objeto) {
        $sql = 'UPDATE product SET idfamily = :idfamily, product = :product, price = :price , description = :description WHERE id = :id';
        $params = array(
            'idfamily' => $objeto->getIdfamily(),
            'product' => $objeto->getProduct(),
            'price' => $objeto->getPrice(),
            'description' => $objeto->getDescription(),
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
        $sql = 'SELECT * FROM product WHERE id = :id';
        $params = array(
            'id'     => $id
        );
        $resultado = $this->db->execute($sql, $params);//true o false
        $sentencia = $this->db->getStatement();
        $product = new Product();
        if($resultado && $fila = $sentencia->fetch()) {
            $product->set($fila);
        } else {
            $product = null;//si la consulta falla o no encuentra el contacto
        }
        return $product;
    }

    public function getAll() {
        $sql = 'SELECT * FROM product order by product';
        $resultado = $this->db->execute($sql);
        $products = array();
        if($resultado){
            $sentencia = $this->db->getStatement();
            while($fila = $sentencia->fetch()) {
                $product = new Product();
                $product->set($fila);
                $products[] = $product;
            }
        }
        return $products;
    }
    
    public function getAllLimitTPV(){
        $sql = 'select * from product order by 1 limit 0, 9';
        $resultado = $this->db->execute($sql);
        $objetos = array();
        if($resultado){
            $sentencia = $this->db->getStatement();
            while($fila = $sentencia->fetch()) {
                $objeto = new Product();
                $objeto->set($fila);
                $objetos[] = $objeto;
            }
        }
        return $objetos;
    }
    
    public function getAllLimitTPVPan(){
        $sql = 'select * from product where idfamily = 1 order by 1 limit 0, 9';
        $resultado = $this->db->execute($sql);
        $objetos = array();
        if($resultado){
            $sentencia = $this->db->getStatement();
            while($fila = $sentencia->fetch()) {
                $objeto = new Product();
                $objeto->set($fila);
                $objetos[] = $objeto;
            }
        }
        return $objetos;
    }
    
    public function getAllTPVFamily($family){
        $sql = 'select * from product where idfamily = :family order by 1';
        $resultado = $this->db->execute($sql, array('family' => $family));
        $objetos = array();
        if($resultado){
            $sentencia = $this->db->getStatement();
            while($fila = $sentencia->fetch()) {
                $objeto = new Product();
                $objeto->set($fila);
                $objetos[] = $objeto;
            }
        }
        return $objetos;
    }
    
    public function getAllLimitTPVCroissants(){
        return $this->getAllTPVFamily(2);
    }
    
    public function getAllLimitTPVNavidad(){
        $sql = 'select * from product where idfamily = 3 order by 1';
        $resultado = $this->db->execute($sql);
        $objetos = array();
        if($resultado){
            $sentencia = $this->db->getStatement();
            while($fila = $sentencia->fetch()) {
                $objeto = new Product();
                $objeto->set($fila);
                $objetos[] = $objeto;
            }
        }
        return $objetos;
    }
    
    public function getAllLimitTPVOtros(){
        $sql = 'select * from product where idfamily = 4 order by 1';
        $resultado = $this->db->execute($sql);
        $objetos = array();
        if($resultado){
            $sentencia = $this->db->getStatement();
            while($fila = $sentencia->fetch()) {
                $objeto = new Product();
                $objeto->set($fila);
                $objetos[] = $objeto;
            }
        }
        return $objetos;
    }

    public function remove($id) {
        $sql = 'DELETE FROM product WHERE id = :id';
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
    
    public function getFamilyByName($family){ //No es la id es el String de family
        $sql = 'Select * FROM family where family = :family';
        $params = array(
            'family' => $family
        );
        $resultado = $this->db->execute($sql, $params); //true or false
        $sentencia = $this->db->getStatement();
        $family = new Family();
        if ($resultado && $fila = $sentencia->fetch()) {
            $family->set($fila);
        } else {
            $family = null; // si la consulta fall o no encuentr el contacto
        }
        return $family;
        
    }
    
     public function getFamilyByIdfamily($idfamily){ //No es la id es el String de family
        $sql = 'Select * FROM family where id = :idfamily';
        $params = array(
            'idfamily' => $idfamily
        );
        $resultado = $this->db->execute($sql, $params); //true or false
        $sentencia = $this->db->getStatement();
        $family = new Family();
        if ($resultado && $fila = $sentencia->fetch()) {
            $family->set($fila);
        } else {
            $family = null; // si la consulta fall o no encuentr el contacto
        }
        return $family;
        
    }
    
    public function getAllProductFamily(){
        $sql = 'Select product.id,family.family,product.product,price,description FROM family JOIN product on product.idfamily = family.id ';

       $resultado = $this->db->execute($sql);
        $products = array();
        if($resultado){
            $sentencia = $this->db->getStatement();
            while($fila = $sentencia->fetch()) {
                $product = new Product();
                $product->set($fila);
                $products[] = $product;
            }
        }
        return $products;
        
    }
    
    public function getProductFamily($id){
        $sql = 'Select * FROM family JOIN product on product.idfamily = family.id  where product.id = :id';
         $params = array(
            'id'     => $id
        );
        $resultado = $this->db->execute($sql, $params);//true o false
        $sentencia = $this->db->getStatement();
        $product = new Product();
        if($resultado && $fila = $sentencia->fetch()) {
            $product->set($fila);
        } else {
            $product = null;//si la consulta falla o no encuentra el contacto
        }
        return $product;
        
    }
    
      function getProductLimit($a , $b){
        $sql = 'Select product.id,family.family,product.product,price,description FROM family JOIN product on product.idfamily = family.id limit ' . $a . ',' . $b . ';';
        $params = array(
            'a' => $a,
            'b' => $b
        );
        $res = $this->db->execute($sql, $params);
        $products = array();
        if($res){
            $sentencia = $this->db->getStatement();
            while($fila = $sentencia->fetch()){
                $product = new Product();
                $product->set($fila);
                $products[] = $product;
            }
        }
        return $products;
    }
    
    function getAllCount(){
        $sql = 'select count(*) from product';
        $res = $this->db->execute($sql);
        if($res){
            $sentencia = $sentencia = $this->db->getStatement();
            $fila = $sentencia->fetch();
            return $fila[0];       
        }
        return $res;
    }
    
     public function checkProductByProduct($product){
        $sql = 'select * from product where product = :product';
        $parametros = array(
            'product' => $product
        );
        $resultado = $this->db->execute($sql, $parametros);
        $products = array();
        if($resultado){
            $sentencia = $this->db->getStatement();
            while($fila = $sentencia->fetch()) {
                $product = new Product();
                $product->set($fila);
                $products[] = $product;
            }
        }
        return count($products);
    }
    
    
}

