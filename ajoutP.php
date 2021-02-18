<?php
session_start();

include("navBarAdmin.php");
require('bdd.php');

if(!empty($_POST)) {
    if(!empty($_POST['name']($_POST['price'])($_POST['categorie']))) {
        $nom=$_POST['nom'];
        $prix=$_POST['prix'];
        $categorie=$_POST['Catégorie'];
    }
    foreach($_POST as $indice => $valeur) {
        $_POST[$indice] = htmlEntities(addSlashes($valeur));
    }
    $req = $bdd->prepare('INSERT INTO product (name, price, categorie) values (:name, :price, :categorie');
    $req->execute(array(
        ':name' => $nom,
        ':price' => $prix,
        ':categorie' => $categorie
    ));
}
    ?>

<h1> Ajout de produit</h1>
<h2>Ajout du produit</h2>
<form method="post" enctype="multipart/form-data" action="">
 
    <label for="titre">Nom</label><br>
    <input type="text" id="name" name="nom" placeholder="le nom du produit"> <br><br>
     
    <label for="prix">Categorie</label><br>
    <input type="text" id="categorie" name="Catégorie" placeholder="la catégorie du produit"><br><br>

    <label for="prix">prix</label><br>
    <input type="text" id="price" name="prix" placeholder="le prix du produit"><br><br>
     
    <input type="submit" value="Ajouter le produit">
</form>