<?php
    require "vendor/autoload.php";    

    use App\Manager\ProductManager;
    use App\Service\MessageService;
    
    session_start();

    $manager = new ProductManager();
    

    if(isset($_GET['action'])){

        switch($_GET['action']){
            //! ajout d'un produit choisi en session (dans le panier)
            case "incart": 
                $product = $manager->getOneById($_GET['id']);

                $order = [
                    "product"  => $product, // (le prix est à l'intérieur du produit)
                    "qtt"   => 1,
                    "total" => $product->getPrice()
                ];

                $_SESSION['cart'][] = $order; //ajout en session
                MessageService::setMessage("success", "Produit ajouté au panier - <a href='recap.php'>Voir mon panier</a>");

                header("Location:index.php");
                die;

            //! ajout de produit


            //! supprimer un produit avec son index
            case "delete":
                if(isset($_SESSION['cart'][$_GET['index']])){
                    $indexProduit = $_GET['index'];
                    unset($_SESSION['cart'][$indexProduit]);
                    MessageService::setMessage("success", "Produit supprimé avec succès !!");
                }
                else MessageService::setMessage("error", "Le produit demandé n'existe pas...");
                break;

            //! vider la session
            case "clear": 
                if(!empty($_SESSION['cart'])){
                    unset($_SESSION['cart']);
                    MessageService::setMessage("success", "Liste des produits effacée !!");
                }
                break;              
        }
        //! fin du switch dans le cas où l'action n'a redirigé nulle part
        header("Location:recap.php");
        die;
    }
    //on redirige vers index dans ces deux cas de figure : 
    // - soit on est arrivé ici sans $_GET['action']
    // - soit on a une $_GET['action'] qui ne correspond à aucune action prévue
    header("Location:index.php");    
    