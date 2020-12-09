<?php
    session_start();    
    require_once "MessageService.php"; //j'intègre le code présent dans MessageService.php ici
    require_once "ProductManager.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Oxygen&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="style.css">
        <title>Ajout produit</title>
    </head>
    <body>
        <?php 
            include "menu.php";
            include "messages.php";
        ?>

        <h1>Liste des produits</h1>
        <section>
            <table border=2>
                <thead>
                    <tr>
                        <th>ID</th>                    
                        <th>NOM</th>                        
                        <th>PRIX</th>                        
                        <th>ACTIONS</th>  
                    </tr>                      
                </thead>
                <tbody>

                    <?php
                        // on récupère tous les produits
                        $manager = new ProductManager();
                        $products = $manager->getAll();

                        // on boucle sur les produits
                        foreach($products as $prod){
                            echo "<tr><td>", $prod->getId(), "</td><td>", $prod->getName(), "</td><td>", $prod->getPrice(true), "</td><td>", "<a href='traitement.php?action=suppr&id=", $prod->getId(), "'>Supprimer</a></td></tr>";
                        }
                    ?>
                </tbody>
            </table>
        </section>


        <form action="traitement.php?action=add" method="post">
            <h1>Ajouter un produit</h1>
            <p>
                <label>Nom du produit&nbsp;: </label>
                <input type="text" name="name">
            </p>
            <p>
                <label>Prix du produit&nbsp;: </label>
                <input type="number" step="any" name="price">
            </p>
            <p class="submit-row">
                <input type="submit" name="submit" value="Ajouter le produit">
            </p>
        </form>
        
    </body>
</html>