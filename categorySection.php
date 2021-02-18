<?php
require('session.php');
require('bdd.php');
?>

<h1 class="center">Section Catégorie</h1>
<div class="text-right mr-5">
    <a class="btn btn-outline-primary" href="ajouterCategorie.php">Ajouter une catégorie</a>
</div>
<div class="bg-light p-5 rounded mt-5 mx-5">
<?php
    $reponse = $bdd->query('SELECT id, categorie FROM categorie');
    while ($donnees = $reponse->fetch()) {
?>
        <div class="row d-flex">
            <div class="col-2">
                <h4><?php echo $donnees['categorie'] ?></h4>
            </div>
            <div class="col-10">
                <a class="text-primary ml-5" href="modifierCategorie.php?id_categorie= <?php echo $donnees['id']; ?>">Modifier</a>
                <a class="text-danger mx-2" href="supprimerCategorie.php?id_categorie= <?php echo $donnees['id']; ?>">Supprimer</a>
            </div>
        </div>
<?php
    }
?>
</div>