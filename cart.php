<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php



    session_start();

    $_SESSION["panier"] = array();


    require_once('bdd.php');

    if (!empty($_GET["id"])) {



        $idArticle = $_GET["id"];


        $query = $bdd->prepare("SELECT `id`, `name`, `price`, `categorie` FROM `product` WHERE id LIKE $idArticle");

        $query->execute();
        $data = $query->fetch();

        $taillePanier = count($_SESSION["panier"]);

        if ($taillePanier > 0) {
            array_push($_SESSION["panier"][$taillePanier]["nomArticle"], $data["name"]);
            array_push($_SESSION["panier"][$taillePanier]["priceArticle"], $data["price"]);
        } else {
            array_push($_SESSION["panier"][0]["nomArticle"], $data["name"]);
            array_push($_SESSION["panier"][0]["priceArticle"], $data["price"]);
        }
        var_dump($_SESSION["panier"]);
        echo "
            <div>

            <div>Mon panier</div>
            <div>Prix : " . $data["price"] . "  </div>

            <div>Nom de l'article : " .  $data["name"] . " </div>
            </div>

            <a href='all.php'>ALL</a>

       ";
    }


    ?>


</body>

</html>