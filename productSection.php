<?php
require('session.php');
require('bdd.php');
?>

<h1 class="center">Section Produit</h1>
<div class="text-right mr-5">
    <a class="btn btn-outline-primary" href="addProduct.php">Ajouter un produit</a>
</div>

<table class="table table-striped my-5">
    <tbody>
    <?php
    $reponse = $bdd->query('SELECT DISTINCT p.id, p.name, p.price, c.categorie FROM product as p, categorie as c WHERE p.categorie = c.id');
    while ($donnees = $reponse->fetch()) {
        ?>
        <tr class="row mx-5">
            <td class="col-4">
                <h4><?php echo $donnees['name'] ?></h4>
                <p>Catégorie : <?php echo $donnees['categorie'] ?> , prix : <?php echo $donnees['price'] ?>€</p>
            </td>
            <td class="col-8">
                <a class="text-primary ml-5" href="modifyProduct.php?id_product= <?php echo $donnees['id']; ?>">Modifier</a>
                <a class="text-danger mx-2" href="deleteProduit.php?id_product= <?php echo $donnees['id']; ?>">Supprimer</a>
            </td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>