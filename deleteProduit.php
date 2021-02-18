<?php
require('session.php');
require('bdd.php');

$reponse = $bdd->query('SELECT id, name, price, categorie FROM product WHERE id = "' . $_GET['id_product'] . '"');
$donnees = $reponse->fetch();
?>

    <form method="post" action="#">
        <p>Etes vous sûr de bien vouloir supprimer ce produit : <?php echo $donnees['name']?> ?</p>
        <input name="product" class="btn btn-danger" type="submit" value="Supprimer">
    </form>

<?php
if (isset($_POST['product'])) {
    $req = $bdd->prepare('DELETE FROM product WHERE id=:id');
    $req->execute(array(
        ':id' => $_GET['id_product'],
    ));
    ?>
    <script> location.replace("productSection.php"); </script>
    <?php
}
?>