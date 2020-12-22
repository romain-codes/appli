<?php

$product = $response['data'];

?>
<p>
    <a href="?ctrl=store">Retour à la liste</a>
</p>
<article>
    <h1><?= $product->getName() ?></h1>
    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eum nobis alias incidunt id fugiat ipsam dolore quisquam expedita deleniti reprehenderit cum maxime, maiores beatae a quibusdam veritatis explicabo libero sit voluptatum et! A quidem soluta tenetur deserunt minus nemo, facere voluptatibus quos cum rerum perferendis unde cumque cupiditate inventore quaerat.</p>

    <p>
        <?= $product->getPrice(true) ?>
    </p>

    <p>
        <a href="">Ajouter au panier</a>
    </p>
</article>