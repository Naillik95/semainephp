<?php
require('session.php');
require('bdd.php');

$reponse = $bdd->query('SELECT id, categorie FROM categorie WHERE id = "' . $_GET['id_categorie'] . '"');
$donnees = $reponse->fetch();
?>

    <h2 class="center mb-5">Mofification de la catégorie</h2>

    <form method="post" action="#">
        <label for="modifyNameCategory" class="ml-5">Nom de la catégorie :</label>
        <input type="text" id="modifyNameCategory" name="categorie" value="<?php echo $donnees['categorie'] ?>"><br><br>
        <input class="btn btn-primary ml-5" type="submit" value="Modifier">
    </form>

<?php
if (isset($_POST['categorie'])) {
    $rep = $bdd->query('SELECT id, categorie FROM categorie WHERE categorie = "' . $_POST['categorie'] . '"');
    $donnee = $rep->fetch();
    if ($donnee) {
        echo "<script>alert(\"Cette catégorie existe déjà\")</script>";
    } else {
        $req = $bdd->prepare('UPDATE categorie SET categorie=:categorie WHERE id=:id');
        $req->execute(array(
            ':id' => $_GET['id_categorie'],
            ':categorie' => $_POST['categorie']
        ));
        ?>
        <script> location.replace("categorySection.php"); </script>
        <?php
    }
}
?>