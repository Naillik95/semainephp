<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Mon super blog test</title>
    <meta charset="utf-8"/>
    <link href="style.css" rel="stylesheet">
</head>
<body>

<?php
include("navBar.php");
?>

<?php
//
//try {
//    $bdd = new PDO('mysql:host=localhost;dbname=espace_membres;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
//} catch (Exception $e) {
//    die('Erreur : ' . $e->getMessage());
//}
//?>

<div class="container d-flex">
    <div class="incription">
        <h1 class="text-center font-weight-bold">Inscription</h1>
        <form class="formInscription">
            <div class="form-group">
                <label>Nom</label>
                <input type="text" class="form-control caseInfoContact" id="lastName" required>
            </div>
            <div class="form-group">
                <label>Prénom</label>
                <input type="text" class="form-control caseInfoContact" id="firstName" required>
            </div>
            <div class="form-group">
                <label>Adresse Mail</label>
                <input type="email" class="form-control caseInfoContact" id="email" placeholder="utilisateur@domaine.fr" required>
            </div>
            <div class="form-group">
                <label>Mot de passe</label>
                <input type="password" class="form-control" name="pass1" id="pass1" required>
            </div>
            <div class="form-group">
                <label>Retapez votre mot de passe</label>
                <input type="password" class="form-control" name="pass2" id="pass2" required>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary submit" value="S'inscrire"
            </div>
        </form>
    </div>
    </div>
    <div class="connexion">
        <h1 class="text-center font-weight-bold">Connexion</h1>
        <form class="formConnexion" action="connexion.php" method="post">
            <div class="form-group">
                <label>Adresse Mail</label>
                <input type="text" class="form-control" name="pseudo" id="email" required placeholder="Email">
            </div>
            <div class="form-group">
                <label>Mot de passe</label>
                <input type="password" class="form-control" name="pass" id="pass" required placeholder="Mot de passe">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary submit" value="Se connecter"
            </div>
        </form>
    </div>
</div>

<?php
// Inscription
// Vérification de la validité des informations
if (isset($_POST['pseudo'], $_POST['pass1'], $_POST['pass2'], $_POST['mail'])) {
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];
    $mail = htmlspecialchars($_POST['mail']);

    // Vérification du pseudo et du mail
    $reponse = $bdd->query('SELECT pseudo, email FROM membres WHERE pseudo = "' . $pseudo . '" OR email = "' . $mail . '"');
    if (!$donnees = $reponse->fetch()) {
        // Vérification des mots de passe
        if ($pass1 === $pass2) {
            // Hachage du mot de passe
            $pass_hache = password_hash($pass1, PASSWORD_DEFAULT);
            if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['mail'])) {
                // Insertion
                $req = $bdd->prepare('INSERT INTO membres(pseudo, pass, email, date_inscription) VALUES(:pseudo, :pass1, :mail, CURDATE())');
                $req->execute(array(
                    'pseudo' => $pseudo,
                    'pass1' => $pass_hache,
                    'mail' => $mail,
                ));
                header('Location: connexion.php');
            } else {
                echo "L'adresse mail n'est pas valide.";
            }
        } else {
            echo "Les deux mots de passe ne sont pas identiques.";
        }
    } else {
        echo "Le compte est déjà crée, veuillez vous connecter";
    }
}
?>

<?php
// COnnexion
//  Récupération de l'utilisateur et de son pass hashé
if (isset($_POST['pseudo'], $_POST['pass'])) {
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $reponse = $bdd->prepare('SELECT id, pass FROM membres WHERE pseudo = :pseudo');
    $reponse->execute(array(
        'pseudo' => $pseudo));
    $resultat = $reponse->fetch();

    // Comparaison du pass envoyé via le formulaire avec la base
    $isPasswordCorrect = password_verify($_POST['pass'], $resultat['pass']);

    if ($isPasswordCorrect) {
        $_SESSION['id'] = $resultat['id'];
        $_SESSION['pseudo'] = $pseudo;
        header('Location: accueilProfil.php');
    } else {
        echo 'Mauvais identifiant ou mot de passe !';
    }
}

?>

</body>
</html>