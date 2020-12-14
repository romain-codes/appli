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
            case "add": 
                if(isset($_POST['submit'])){

                    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
                    $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            
                    if($name && $price){
                        $manager->insert($name, $price); //ajout en base de données
                        MessageService::setMessage("success", "Produit ajouté avec succès !!");                                                
                    }
                    else MessageService::setMessage("error", "Formulaire mal rempli, réessayez !");
                }
                else MessageService::setMessage("error", "Vous n'avez pas soumis le formulaire...");
                header("Location:index.php");
                die;

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

            //! supprimer un produit en base de données    
            case "suppr":
                $manager->delete($_GET['id']);
                MessageService::setMessage("success", "Produit supprimé de la base de donnée");
                header("Location:form.php");
                die;                
        }
        //! fin du switch dans le cas où l'action n'a redirigé nulle part
        header("Location:recap.php");
        die;
    }
    //on redirige vers index dans ces deux cas de figure : 
    // - soit on est arrivé ici sans $_GET['action']
    // - soit on a une $_GET['action'] qui ne correspond à aucune action prévue
    header("Location:index.php");    
    