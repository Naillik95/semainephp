<?php
include("navBar.php");
require("bdd.php");
?>

<div class="container d-flex">
    <div class="incription">
        <h1 class="text-center font-weight-bold">Inscription</h1>
        <form class="formInscription" action="formConnexion.php" method="post">
            <div class="form-group">
                <label>Nom</label>
                <input type="text" class="form-control" name="nom" id="lastName" required>
            </div>
            <div class="form-group">
                <label>Prénom</label>
                <input type="text" class="form-control" name="prenom" id="firstName" required>
            </div>
            <div class="form-group">
                <label>Adresse Mail</label>
                <input type="email" class="form-control" name="emailInscription" id="emailInscription" placeholder="utilisateur@domaine.fr" required>
            </div>
            <div class="form-group">
                <label>Mot de passe</label>
                <input type="password" class="form-control" name="passwordInscription" id="passwordInscription" required>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary submit" value="S'inscrire"
            </div>
        </form>
    </div>
    </div>
    <div class="connexion">
        <h1 class="text-center font-weight-bold">Connexion</h1>
        <form class="formConnexion" action="formConnexion.php" method="post">
            <div class="form-group">
                <label>Adresse Mail</label>
                <input type="text" class="form-control" name="emailConnexion" id="emailConnexion" required placeholder="Email">
            </div>
            <div class="form-group">
                <label>Mot de passe</label>
                <input type="password" class="form-control" name="passwordConnexion" id="passwordConnexion" required placeholder="Mot de passe">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary submit" value="Se connecter"
            </div>
        </form>
    </div>
</div>