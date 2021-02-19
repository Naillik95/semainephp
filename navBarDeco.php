<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
    <title>MicroFactory</title>
</head>

<body>
<header>
    <!-- Static navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Accueil</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Nos Produits
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="all.php">Tous les articles</a>
                        <?php
                        require_once('bdd.php');
                        $query = $bdd->prepare("SELECT categorie, id FROM categorie");
                        $query->execute();
                        $data = $query->fetchAll();
                        for ($i = 0; $i < count($data); $i++) {
                            $element = $data[$i]["categorie"];
                            $id = $data[$i]['id'];
                            ?>
                            <a class='dropdown-item'
                               href='defaultCategory.php?id_category=<?php echo $id ?>'><?php echo $element ?></a>
                            <?php
                            // echo "<a class='dropdown-item' href='defaultCategory.php?id_category='". echo $data[$i]['id'].">$element</a>";
                        }
                        ?>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="histCommande.php">Historique</a>
                </li>
                <li class="nav-item align-self-center">
                    <form method="post" action="formDeconnexion.php">
                        <input type="submit" name="submit" class="deconnexion btn btn-sm btn-outline-primary"
                               value="Se déconnecter">
                    </form>
                </li>
            </ul>
            <a class="btn btn-outline-primary my-2 my-sm-0" href="cart.php">Panier</a>
        </div>
    </nav>
</header>

<!-- /container -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous"></script>

</body>
</html>