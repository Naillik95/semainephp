<?php
require('session.php');
require('bdd.php');

$reponse = $bdd->query('SELECT id, categorie FROM categorie');
?>

    <h2 class="center mb-5">Ajout du produit</h2>

    <form method="post" action="#">
        <p class="ml-5">Quel produit voulez-vous ajouter ?</p>
        <label for="addNameProduct" class="ml-5">Nom du produit :</label>
        <input type="text" id="addNameProduct" name="name" required> <br><br>
        <p class="ml-5">Catégorie du produit :
            <select name="categorie">
                <?php
                while ($donnees = $reponse->fetch()) {
                    ?>
                    <option value="<?php echo $donnees['id'] ?>"><?php echo $donnees['categorie'] ?></option>
                    <?php
                }
                ?>
            </select>
        </p>
        <br>
        <label for="addPriceProduct" class="ml-5">Prix du produit :</label>
        <input type="text" id="addPriceProduct" name="price" required><br><br>

        <input type="submit" class="ml-5 btn btn-primary" value="Ajouter le produit">
    </form>

<?php

if (isset($_POST['name'], $_POST['price'], $_POST['categorie'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $categorie = $_POST['categorie'];

    $rep = $bdd->query('SELECT name, categorie FROM product WHERE name = "' . $_POST['name'] . '" AND categorie = "' . $_POST['categorie'] . '"');
    $donnee = $rep->fetch();
    if ($donnee) {
        echo "<script>alert(\"Ce produit existe déjà\")</script>";
    } else {
        $req = $bdd->prepare('INSERT INTO product (name, price, categorie) VALUES (:name, :price, :categorie)');
        $req->execute(array(
            ':name' => $name,
            ':price' => $price,
            ':categorie' => $categorie
        ));
        ?>
        <script> location.replace("productSection.php"); </script>
        <?php
    }
}
?>