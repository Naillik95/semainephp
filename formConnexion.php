<?php
require('bdd.php');
// Inscription
// Vérification de la validité des informations
if (isset($_POST['nom'], $_POST['prenom'], $_POST['emailInscription'], $_POST['passwordInscription'])) {
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $emailInscription = $_POST['emailInscription'];
    $passwordInscription = $_POST['passwordInscription'];

    // Vérification du mail
    $reponse = $bdd->query('SELECT email FROM user WHERE email = "' . $emailInscription . '"');
    if (!$donnees = $reponse->fetch()) {
        // Hachage du mot de passe
        $pass_hache = password_hash($passwordInscription, PASSWORD_DEFAULT);
        if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['emailInscription'])) {
            // Insertion
            $req = $bdd->prepare('INSERT INTO user (firstname, lastname, email, password) VALUES(:nom, :prenom, :email, :passwordHache)');
            $req->execute(array(
                ':nom' => $nom,
                ':prenom' => $prenom,
                ':email' => $emailInscription,
                ':passwordHache' => $pass_hache
            ));
            echo "<script>alert(\"Inscription réussi, vous pouvez désormais vous connecter\")</script>";
        } else {
            echo "<script>alert(\"L'adresse mail n'est pas valide\")</script>";
        }
    } else {
        echo "<script>alert(\"Le compte est déjà crée, veuillez vous connecter\")</script>";
    }
}

// Connexion
//  Récupération de l'utilisateur et de son pass hashé
if (isset($_POST['emailConnexion'], $_POST['passwordConnexion'])) {
    $emailConnexion = $_POST['emailConnexion'];
    $reponse = $bdd->prepare('SELECT email, password FROM user WHERE email = :email');
    $reponse->execute(array(
        ':email' => $emailConnexion));
    $resultat = $reponse->fetch();

    // Comparaison du pass envoyé via le formulaire avec la base
    $isPasswordCorrect = password_verify($_POST['passwordConnexion'], $resultat['password']);

    if ($isPasswordCorrect) {
        $_SESSION['email'] = $resultat['email'];
        header('Location: index.php');
        exit();
    } else {
        echo "<script>alert(\"Mauvais identifiant ou mot de passe !\")</script>";
    }
}
?>