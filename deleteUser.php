<?php
require('session.php');
require('bdd.php');

$reponse = $bdd->query('SELECT id, firstname, lastname, email, status FROM user WHERE id = "' . $_GET['id_user'] . '"');
$donnees = $reponse->fetch();
?>

    <form method="post" action="#">
        <p>Etes vous sûr de bien vouloir supprimer cet utilisateur : <?php echo $donnees['firstname']?> <?php echo $donnees['lastname']?>?</p>
        <input name="user" class="btn btn-danger" type="submit" value="Supprimer">
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