<?php
require('session.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://fonts.googleapis.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Tous les articles</title>
</head>

<body>


<?php
require_once('bdd.php');
$q = $bdd->query('SELECT id, categorie FROM categorie');
while ($cat = $q->fetch()) {

    $query = $bdd->prepare('SELECT p.id, price, name, c.categorie FROM product as p, categorie as c WHERE p.categorie = c.id AND p.categorie = "' . $cat['id'] . '"');
    $query->execute();
    $data = $query->fetchAll();
    ?>
    <h1 class="center"><?php echo $cat['categorie'] ?></h1>
    <div class="box mb-4">
        <?php
        for ($i = 0; $i < count($data); $i++) {
            $element = $data[$i]["categorie"];
            $name = $data[$i]["name"];
            $price = $data[$i]["price"];
            $id = $data[$i]["id"];

            $replace = str_replace(" ", "_", $name);
            ?>
            <div class="border">
                <div>
                    <img src="img/<?php echo $replace ?>.jpg" height="250px" width="190px">
                    <?php
                    if (!empty($_SESSION)) {
                        if ($_SESSION['status'] == 'c') {
                            ?>
                            <div>
                                <a href="cart?id=<?php echo $id ?>.php" class="btn btn-primary mt-2"> Acheter <i
                                            class="fa fa-shopping-cart"></i></a>
                            </div>
                            <?php
                        }
                    } elseif (empty($_SESSION)) {
                        ?>
                        <div>
                            <a href="cart?id=<?php echo $id ?>.php" class="btn btn-primary mt-2"> Acheter <i
                                        class="fa fa-shopping-cart"></i></a>
                        </div>
                        <?php
                    }
                    ?>
                    <p><?php echo $name ?><br><b><?php echo $price ?> €</b></p>
                </div>
            </div>

            <?php
        }
        ?>
    </div>
    <?php
}
?>

</body>

</html>