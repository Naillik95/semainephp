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
    $req = $bdd->query('DELETE FROM panier WHERE id_user = "' . $_SESSION['id'] . '"');
    echo "<script>alert(\"Commande réussie !\")</script>";
    ?>
    <script> location.replace("cart.php"); </script>
    <?php
}

?>