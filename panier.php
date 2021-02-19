// fichier qui ne sert plus mais à garder au cas où
// permet d'ajouter au panier quand on est connecté

<?php
require('session.php');
require('bdd.php');

if (isset($_GET['id'])) {
    $id_product = $_GET['id'];
    $rep = $bdd->query('SELECT * FROM product WHERE id = "' . $id_product . '"');
    $donnee = $rep->fetch();
    if (empty($_SESSION)) {

        echo "<script> location.replace('connexion.php'); </script>";

    } else {

        $req = $bdd->prepare('INSERT INTO panier (id_user, id_product) VALUES (:id_user, :id_product)');
        $req->execute(array(
            ':id_user' => $_SESSION['id'],
            ':id_product' => $donnee['id']
        ));
    }
}

echo "<script> location.replace('all.php'); </script>";

?>

