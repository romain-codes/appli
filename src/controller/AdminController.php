<?php

namespace App\Controller;

use App\Manager\ProductManager;
use App\Service\MessageService as MS;
use App\Service\RouterService as Router;

class AdminController {
    public function indexAction() {
        $manager = new ProductManager();
        $products = $manager->getAll();

        return [
            "view" => "admin/panel.php",
            "data" => $products
        ];
    }

    public function addAction() {
        $manager = new ProductManager();

        if(isset($_POST['submit'])){

            $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
            $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    
            if($name && $price){
                $manager->insert($name, $price); //ajout en base de données
                MS::setMessage("success", "Produit ajouté avec succès !!");
                
                return Router::redirect("admin");
            }
            else MS::setMessage("error", "Formulaire mal rempli, réessayez !");
        }

        return [
            "view" => "admin/form.php"
        ];
    }


    public function deleteAction($id) {
        $manager = new ProductManager();
        $manager->delete($id);

        MS::setMessage("success", "Produit supprimé de la base de donnée");

        return Router::redirect("admin", "index");
    }
}
