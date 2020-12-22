
<form action="?ctrl=admin&action=add" method="post">
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