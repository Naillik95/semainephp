<?php
require('session.php');
require('bdd.php');

$reponse = $bdd->query('SELECT id, firstname, lastname, email, status FROM user WHERE id = "' . $_GET['id_user'] . '"');
$donnees = $reponse->fetch();
?>

    <form method="post" action="#">
        <input type="text" name="status" value="<?php echo $donnees['status'] ?>">
        <input class="btn btn-primary" type="submit" value="modifier">
    </form>

<?php
if (isset($_POST['status'])) {
    $req = $bdd->prepare('UPDATE user SET status=:status WHERE id=:id');
    $req->execute(array(
        ':id' => $_GET['id_user'],
        ':status' => $_POST['status']
    ));
    ?>
    <script> location.replace("userSection.php"); </script>
    <?php
}
?>