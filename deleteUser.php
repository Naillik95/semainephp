<?php
require('session.php');
require('bdd.php');

$reponse = $bdd->query('SELECT id, firstname, lastname, email, status FROM user WHERE id = "' . $_GET['id_user'] . '"');
$donnees = $reponse->fetch();
?>

    <h2 class="center mb-5">Suppression de l'utilisateur</h2>

    <form method="post" action="#">
        <p class="ml-5">Etes vous sûr de bien vouloir supprimer cet utilisateur : <?php echo $donnees['firstname']?> <?php echo $donnees['lastname']?> ?</p>
        <input name="user" class="btn btn-danger ml-5" type="submit" value="Supprimer">
    </form>

<?php
if (isset($_POST['user'])) {
    $req = $bdd->prepare('DELETE FROM user WHERE id=:id');
    $req->execute(array(
        ':id' => $_GET['id_user'],
    ));
    ?>
    <script> location.replace("userSection.php"); </script>
    <?php
}
?>