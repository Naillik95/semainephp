<?php
require('session.php');
require('bdd.php');

$reponse = $bdd->query('SELECT id, name, price, categorie FROM product WHERE id = "' . $_GET['id_product'] . '"');
$rep = $bdd->query('SELECT id, categorie FROM categorie');

$donnees = $reponse->fetch();
?>

    <h2 class="center mb-5">Modification du produit</h2>

    <form method="post" action="#">
        <label for="modifyNameProduct" class="ml-5">Nom du produit :</label>
        <input type="text" id="modifyNameProduct" name="name" value="<?php echo $donnees['name'] ?>"><br><br>
        <label for="modifyPriceProduct" class="ml-5">Prix du produit :</label>
        <input type="text" id="modifyPriceProduct" name="price" value="<?php echo $donnees['price'] ?>"><br><br>
        <label class="ml-5">Catégorie du produit :</label>
        <select name="categorie">
            <?php
            while ($donnee = $rep->fetch()) {
                ?>
                <option value="<?php echo $donnee['id'] ?>"><?php echo $donnee['categorie'] ?></option>
                <?php
            }
            ?>
        </select><br><br>
        <input class="btn btn-primary ml-5" type="submit" value="Modifier">
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