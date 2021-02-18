<?php
require('session.php');
require('bdd.php');

$reponse = $bdd->query('SELECT id, categorie FROM categorie WHERE id = "' . $_GET['id_categorie'] . '"');
$donnees = $reponse->fetch();
?>

    <form method="post" action="#">
        <input type="text" name="categorie" value="<?php echo $donnees['categorie'] ?>">
        <input class="btn btn-primary" type="submit" value="modifier">
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