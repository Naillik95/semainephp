<?php
require('session.php');
require('bdd.php');
?>

    <h2 class="center">Ajout d'une catégorie</h2>

    <form method="post" action="#">
        <p class="ml-5">Quelle catégorie voulez-vous ajouter ?</p>
        <input type="text" name="categorie" class="ml-5">
        <input class="btn btn-primary" type="submit" value="Ajouter">
    </form>

<?php
if (isset($_POST['categorie'])) {
    $rep = $bdd->query('SELECT id, categorie FROM categorie WHERE categorie = "' . $_POST['categorie'] . '"');
    $donnee = $rep->fetch();
    if ($donnee) {
        echo "<script>alert(\"Cette catégorie existe déjà\")</script>";
    } else {
        $req = $bdd->prepare('INSERT INTO categorie (categorie) VALUES (:categorie)');
        $req->execute(array(
            ':categorie' => $_POST['categorie']
        ));
        ?>
        <script> location.replace("categorySection.php"); </script>
        <?php
    }
}
?>