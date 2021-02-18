<?php
require('session.php');
require('bdd.php');
?>

    <form method="post" action="#">
        <p>Quelle catégorie voulez-vous ajouter ?</p>
        <input type="text" name="categorie">
        <input class="btn btn-primary" type="submit" value="Ajouter">
    </form>

<?php
if (isset($_POST['categorie'])) {
    $req = $bdd->prepare('INSERT INTO categorie (categorie) VALUES (:categorie)');
    $req->execute(array(
        ':categorie' => $_POST['categorie']
    ));
    ?>
    <script> location.replace("categorySection.php"); </script>
    <?php
}
?>