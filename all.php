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

    <h1 class="center">Nos Films</h1>


    <div class="box">
    <?php

    require_once('bdd.php');

    $query = $bdd->prepare("SELECT p.id, price, name, c.categorie FROM product as p, categorie as c WHERE p.categorie LIKE c.id AND c.categorie LIKE 'film'");

    $query->execute();

    $data = $query->fetchAll();



    for ($i = 0; $i < count($data); $i++) {
        $element = $data[$i]["categorie"];
        $name = $data[$i]["name"];
        $price = $data[$i]["price"];
        $id = $data[$i]["id"];

        $replace = str_replace(" ", "_", $name);
        echo <<<HTML
            <div class="border">
                <div>
                    <img src="img/$replace.jpg">
                    <div>
                       <a href="cart?id=$id.php" class="button black"> Acheter <i class="fa fa-shopping-cart"></i></a>
                    </div>
                    <p>$name<br><b>$price €</b></p>
                </div>
            </div>
            HTML;
    }

    ?>
    </div>
    <h1 class="center">Nos Jeux</h1>
    <div class="box">

    <?php

    $query = $bdd->prepare("SELECT p.id, price, name, c.categorie FROM product as p, categorie as c WHERE p.categorie LIKE c.id AND c.categorie LIKE 'Jeu'");

    $query->execute();

    $data = $query->fetchAll();



    for ($i = 0; $i < count($data); $i++) {
        $element = $data[$i]["categorie"];
        $name = $data[$i]["name"];
        $price = $data[$i]["price"];
        $id = $data[$i]["id"];

        $replace = str_replace(" ", "_", $name);
        echo <<<HTML
            <div class="border">
                <div>
                    <img src="img/$replace.jpg">
                    <div>
                       <a href="cart?id=$id.php" class="button black"> Acheter <i class="fa fa-shopping-cart"></i></a>
                    </div>
                    <p>$name<br><b>$price €</b></p>
                </div>
            </div>
            HTML;
    }

    ?>
    </div>  
    <h1 class="center">Nos Mangas</h1>
    <div class="box">
    <?php

$query = $bdd->prepare("SELECT p.id, price, name, c.categorie FROM product as p, categorie as c WHERE p.categorie LIKE c.id AND c.categorie LIKE 'Manga'");

$query->execute();

$data = $query->fetchAll();



for ($i = 0; $i < count($data); $i++) {
    $element = $data[$i]["categorie"];
    $name = $data[$i]["name"];
    $price = $data[$i]["price"];
    $id = $data[$i]["id"];

    $replace = str_replace(" ", "_", $name);
    echo <<<HTML
        <div class="border">
            <div>
                <img src="img/$replace.jpg">
                <div>
                   <a href="cart?id=$id.php" class="button black"> Acheter <i class="fa fa-shopping-cart"></i></a>
                </div>
                <p>$name<br><b>$price €</b></p>
            </div>
        </div>
        HTML;
}

                <div class="">
                    <img src="img/le_jeu_de_la_dame.jpg" >
                    <span class=""></span>
                    <div class="">
?>
    </div>   
    <h1 class="center">Nos Séries</h1>
    <div class="box">
    <?php

$query = $bdd->prepare("SELECT p.id, price, name, c.categorie FROM product as p, categorie as c WHERE p.categorie LIKE c.id AND c.categorie LIKE 'Serie'");
$query->execute();

$data = $query->fetchAll();



for ($i = 0; $i < count($data); $i++) {
    $element = $data[$i]["categorie"];
    $name = $data[$i]["name"];
    $price = $data[$i]["price"];
    $id = $data[$i]["id"];

    $replace = str_replace(" ", "_", $name);
    echo <<<HTML
        <div class="border">
            <div>
                <img src="img/$replace.jpg">
                <div>
                   <a href="cart?id=$id.php" class="button black"> Acheter <i class="fa fa-shopping-cart"></i></a>
                </div>
                <p>$name<br><b>$price €</b></p>
            </div>
        </div>
        HTML;
}

?>
        
    </div>


</body>

</html>