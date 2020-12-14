<?php
namespace App\Entity;

//! Modèle représentant un produit dans l'application
class Product { // Fully Qualified Class Name (FQCN) : App\Entity\Product
    private $id;
    private $name;
    private $price;

    public function __construct($id, $name, $price) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
    }

    
    //$ récupère l'id du produit
    public function getId() {
        return $this->id;
    }


    //$ récupère le nom du produit
    public function getName() {
        return ucfirst($this->name);
    }


    //$ récupère le prix du produit, formaté ou non
    public function getPrice($formatted = false) {
        if($formatted){
            return number_format($this->price, 2, ",", "&nbsp;");  
        }
        return $this->price;
    }
}
