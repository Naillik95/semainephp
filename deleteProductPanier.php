<?php
require('session.php');
require('bdd.php');

if (isset($_GET['id'])) {
    array_splice($_SESSION['panier'], $_GET['id'], 1);
    ?>
    <script> location.replace("cart.php"); </script>
    <?php
}
if (isset($_GET['action']) && $_GET['action']== "paye") {
    unset($_SESSION['panier']);
    echo "<script>alert(\"Commande réussie !\")</script>";
    ?>
    <script> location.replace("cart.php"); </script>
    <?php
}

?>