<?php
require ('session.php');
require ('bdd.php');

$reponse = $bdd->query('SELECT id, categorie FROM categorie WHERE id = "' . $_GET['id_categorie'] . '"');
$donnees = $reponse->fetch();
?>

<form method="post" action="#">
    <p>Etes vous sûr de bien vouloir supprimer cette catégorie : <?= $donnees['categorie']?> ?</p>
    <input name="categorie" class="btn btn-danger" type="submit" value="Supprimer">
</form>

<?php
if(isset($_POST['categorie'])) {
    $req = $bdd->prepare('DELETE FROM categorie WHERE id=:id');
    $req->execute(array(
        ':id' => $_GET['id_categorie'],
    ));
    header('Location: categorySection.php');
}
?>

