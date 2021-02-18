<?php
require('session.php');
require('bdd.php');

$reponse = $bdd->query('SELECT id, categorie FROM categorie WHERE id = "' . $_GET['id_categorie'] . '"');
$donnees = $reponse->fetch();
?>

    <h2 class="center mb-5">Suppression de la catégorie</h2>

    <form method="post" action="#">
        <p class="ml-5">Etes vous sûr de bien vouloir supprimer cette catégorie : <?php echo $donnees['categorie'] ?> ?</p>
        <input name="categorie" class="btn btn-danger ml-5" type="submit" value="Supprimer">
    </form>

<?php
if (isset($_POST['categorie'])) {
    $req = $bdd->prepare('DELETE FROM categorie WHERE id=:id');
    $req->execute(array(
        ':id' => $_GET['id_categorie'],
    ));
    ?>
    <script> location.replace("categorySection.php"); </script>
    <?php
}
?>