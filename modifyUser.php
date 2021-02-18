<?php
require('session.php');
require('bdd.php');

$reponse = $bdd->query('SELECT id, firstname, lastname, email, status FROM user WHERE id = "' . $_GET['id_user'] . '"');
$donnees = $reponse->fetch();
?>

    <h2 class="center mb-5">Modification de l'utilisateur</h2>

    <form method="post" action="#">
        <label for="modifyStatusUser" class="ml-5">Status de l'utilisateur :</label>
        <input type="text" id="modifyStatusUser" name="status" value="<?php echo $donnees['status'] ?>"><br><br>
        <input class="btn btn-primary ml-5" type="submit" value="Modifier">
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