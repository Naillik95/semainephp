<?php
require('session.php');
require('bdd.php');

$reponse = $bdd->query('SELECT id, name, price, categorie FROM product WHERE id = "' . $_GET['id_product'] . '"');
$rep = $bdd->query('SELECT id, categorie FROM categorie');

$donnees = $reponse->fetch();
?>

    <form method="post" action="#">
        <input type="text" name="name" value="<?php echo $donnees['name'] ?>">
        <input type="text" name="price" value="<?php echo $donnees['price'] ?>">
        <select name="categorie">
            <?php
            while ($donnee = $rep->fetch()) {
                ?>
                <option value="<?php echo $donnee['id'] ?>"><?php echo $donnee['categorie'] ?></option>
                <?php
            }
            ?>
        </select>

        <input class="btn btn-primary" type="submit" value="modifier">
    </form>

<?php
if (isset($_POST['name'], $_POST['price'], $_POST['categorie'])) {
    $rep = $bdd->query('SELECT name, categorie FROM product WHERE name = "' . $_POST['name'] . '" AND categorie = "' . $_POST['categorie'] . '"');
    $donnee = $rep->fetch();
    if ($donnee) {
        echo "<script>alert(\"Ce produit existe déjà\")</script>";
    } else {
        $req = $bdd->prepare('UPDATE product SET name=:name, price=:price, categorie=:categorie WHERE id=:id');
        $req->execute(array(
            ':id' => $_GET['id_product'],
            ':name' => $_POST['name'],
            ':price' => $_POST['price'],
            ':categorie' => $_POST['categorie']

        ));
        ?>
        <script> location.replace("productSection.php"); </script>
        <?php
    }
}
?>