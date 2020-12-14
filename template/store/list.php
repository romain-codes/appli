<?php
    $products = $response["data"];
?>

<!-- Liste des produits dans la boutique -->

<h1>Liste des produits</h1>
<section id="products-list">
    
    <?php
        foreach($products as $prod){
            echo "<article class='product-item'>",
                    "<h3><a href='?ctrl=store&action=voir&id=". $prod->getID() ."'>". $prod->getName() ."</a></h3>",
                    "<p>". $prod->getPrice(true) ."&nbsp;€</p>",
                    "<p><a href='traitement.php?action=incart&id=". $prod->getId() ."'>Ajouter au panier</a></p>",
                "</article>";
        }
    ?>

</section>