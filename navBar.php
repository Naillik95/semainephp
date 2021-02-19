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
                        $query = $bdd->prepare("SELECT categorie, id  FROM categorie");
                        $query->execute();
                        $data = $query->fetchAll();
                        for ($i = 0; $i < count($data); $i++) {
                            $element = $data[$i]["categorie"];
                            $id = $data[$i]['id'];
                            ?>
                            <a class='dropdown-item' href='defaultCategory.php?id_category=<?php echo $id ?>'><?php echo $element ?></a>
                            <?php
                        }
                        ?>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="connexion.php">Connexion</a>
                </li>
            </ul>
            <button class="btn btn-outline-primary my-2 my-sm-0" type="submit" data-toggle="modal"
                    data-target="#exampleModalScrollable">Panier
            </button>
        </div>
    </nav>

    <!-- Modale -->
    <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">Mon Panier</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- TESTS POUR LA FENETRE MODALE -->
                    <section class="container content-section">
                        <?php
                        if (!empty($_SESSION)) {
                            $rep = $bdd->query('SELECT prod.name, prod.price, pan.id as panier_id FROM panier as pan, product as prod WHERE pan.id_product = prod.id AND pan.id_user = "' . $_SESSION['id'] . '"');
                            while ($donnee = $rep->fetch()) {
                                ?>
                                <p><?php echo $donnee['name'] ?> - <?php echo $donnee['price'] ?>€ <a href="deleteProductPanier.php?id=<?php echo $donnee['panier_id'] ?>" class="text-danger"> Supprimer</a></p>
                                <?php
                            }
                        }
                        ?>
                    </section>
                </div>
                <div class="modal-footer">
                    <!-- Pour le total  -->
                    <div id="totalCount">
                        <span class="cart-total-title font-weight-bold">Total</span>
                        <?php
                        if (!empty($_SESSION)) {
                            $rep = $bdd->query('SELECT SUM(prod.price) as total FROM panier as pan, product as prod WHERE pan.id_product = prod.id AND pan.id_user = "' . $_SESSION['id'] . '"');
                            $donnee = $rep->fetch()
                            ?>
                            <span class="cart-total-price"><?php echo $donnee['total'] ?>€</span>
                            <?php
                        }

                        ?>
                    </div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <a class="btn btn-primary btn-purchase" type="button" href="deleteProductPanier.php?action=paye">Acheter</a>
                </div>
            </div>
        </div>
    </div>
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
