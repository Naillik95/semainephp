<?php
require('session.php');
require('bdd.php');
?>

<h1 class="center">Section Catégorie</h1>
<div class="text-right mr-5">
    <a class="btn btn-outline-primary" href="addCategory.php">Ajouter une catégorie</a>
</div>

<table class="table table-striped my-5">
    <tbody>
<?php
    $reponse = $bdd->query('SELECT id, categorie FROM categorie');
    while ($donnees = $reponse->fetch()) {
?>
        <tr class="row mx-5">
            <td class="col-4">
                <h4><?php echo $donnees['categorie'] ?></h4>
            </td>
            <td class="col-8">
                <a class="text-primary ml-5" href="modifyCategory.php?id_categorie= <?php echo $donnees['id']; ?>">Modifier</a>
                <a class="text-danger mx-2" href="deleteCategorie.php?id_categorie= <?php echo $donnees['id']; ?>">Supprimer</a>
            </td>
        </tr>
<?php
    }
?>
    </tbody>
</table>