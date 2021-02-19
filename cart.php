<?php
require('session.php');
require_once('bdd.php');

if (!empty($_GET["id"])) {
        if (empty($_SESSION["panier"])) {
            $_SESSION["panier"] = array();
        }


    $idArticle = $_GET["id"];

    // Regarde dans ma table produit
    $query = $bdd->prepare("SELECT `id`, `name`, `price`, `categorie` FROM `product` WHERE id LIKE $idArticle");
    $query->execute();
    $data = $query->fetch();

    if (empty($data)) {
        echo "Cet article n'existe pas";
        ?>
        <script> location.replace("all.php"); </script>
        <?php
        exit();
    }

    array_push($_SESSION["panier"], $data["id"]);
}
if (empty($_SESSION["panier"])) {
    $_SESSION["panier"] = array();
}
echo "<h1 class='center'>Mon panier</h1>";
echo "<hr></br>";

?>

<table class="table table-striped my-5">
    <tbody>
    <?php
    //session_destroy();
    //var_dump($_SESSION["panier"]);
    for ($i = 0; $i < count($_SESSION["panier"]); $i++) {
        $query2 = $bdd->prepare('SELECT * FROM product WHERE id = "' . $_SESSION["panier"][$i] . '"');
        $query2->execute();
        $data = $query2->fetch();
        $key = array_search($_SESSION["panier"][$i], $_SESSION["panier"]);
        ?>
        <tr class="row mx-5">
            <td class="col-4">
                <p>Nom de l'article : <?php echo $data["name"] ?></p>
                <p>Prix : <?php echo $data["price"] ?>€</p>
            </td>
            <td>
                <a href='deleteProductPanier.php?id=<?php echo $key ?>' class='text-danger'> Supprimer</a>
            </td>
        </tr>
        <?php
    }
    ?>

    </tbody>
</table>
<a class="btn btn-primary ml-5" href='all.php'>Retour</a>
<?php
if (!empty($_SESSION["panier"])) {
    echo "<a class='btn btn-primary ml-5' href='deleteProductPanier.php?action=paye'>Commander</a>";
}
?>

</body>

</html>