<?php

namespace App\Controller;

use App\Manager\ProductManager;

class StoreController {
    private $manager;

    public function __construct() {
        $this->manager = new ProductManager();
    }

    public function indexAction() {
        $products = $this->manager->getAll();

        return [
            "view" => "list.php",
            "data" => $products
        ];
    }

    public function voirAction($id) {
        $product = $this->manager->getOnebyId($id);

        return [
            "view" => "voir.php",
            "data" => $product
        ];
    }
}
