<?php
require('session.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://fonts.googleapis.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Jeux</title>
</head>

<body>

<div class="box">
    <?php
    $id_category = $_GET['id_category'];

    $query = $bdd->prepare('SELECT p.id , p.name, p.categorie, p.price FROM product as p, categorie as c WHERE p.categorie = c.id AND p.categorie = "' . $id_category . '"');
    $query->execute();
    $data = $query->fetchAll();
    ?>

    <?php
    for ($i = 0; $i < count($data); $i++) {
        $element = $data[$i]["categorie"];
        $name = $data[$i]["name"];
        $price = $data[$i]["price"];
        $id = $data[$i]["id"];

        $replace = str_replace(" ", "_", $name);
        ?>
        <div class="border mt-5">
            <div>
                <img src="img/<?php echo $replace ?>.jpg" height="250px" width="190px">
                <?php
                if (isset($_SESSION['status'])) {
                    if ($_SESSION['status'] == 'c') {
                        ?>
                        <div>
                            <a href="cart.php?id=<?php echo $id ?>" class="btn btn-primary mt-2"> Acheter <i
                                        class="fa fa-shopping-cart"></i></a>
                        </div>
                        <?php
                    }
                } elseif (empty($_SESSION['status']) || ($_SESSION['panier'])) {
                    ?>
                    <div>
                        <a href="cart.php?id=<?php echo $id ?>" class="btn btn-primary mt-2"> Acheter <i
                                    class="fa fa-shopping-cart"></i></a>
                    </div>
                    <?php
                }
                ?>
                <p><?php echo $name ?><br><b> <?php echo $price ?>€</b></p>
            </div>
        </div>
        <?php
    }
    ?>
</div>

</body>
</html>