<?php
    $products = $response["data"];
?>

<h1>PANEL ADMIN</h1>

<p class="panel-admin-add">
    <a href="?ctrl=admin&action=add">Ajouter un produit</a>
</p>

<table class="panel-admin" border=2>
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
        foreach ($products as $prod) {
            echo "<tr>
                    <td>", $prod->getId(), "</td>
                    <td>", $prod->getName(), "</td>
                    <td>", $prod->getPrice(true), "</td>
                    <td>", "<a href='?ctrl=admin&action=delete&id=", $prod->getId(), "'>Supprimer</a></td>
                </tr>";
        }
        ?>
    </tbody>
</table>