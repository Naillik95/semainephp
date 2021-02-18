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
    <title>Mangas</title>
</head>

<body>

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

?>
        </div>

</body>

</html>