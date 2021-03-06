<?php
include("session.php");
require("bdd.php");
?>

    <p id="message" class="center"></p>
    <div class="container d-flex">
        <div class="incription">
            <h1 class="center font-weight-bold mb-4">Inscription</h1>
            <form class="formInscription" action="#" method="post">
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
                    <input type="email" class="form-control" name="emailInscription" id="emailInscription"
                           placeholder="utilisateur@domaine.fr" required>
                </div>
                <div class="form-group">
                    <label>Mot de passe</label>
                    <input type="password" class="form-control" name="passwordInscription" id="passwordInscription"
                           required>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary submit" value="S'inscrire"
                </div>
            </form>
        </div>
    </div>
    <div class="connexion">
        <h1 class="center font-weight-bold mb-4">Connexion</h1>
        <form class="formConnexion" action="#" method="post">
            <div class="form-group">
                <label>Adresse Mail</label>
                <input type="text" class="form-control" name="emailConnexion" id="emailConnexion" required
                       placeholder="Email">
            </div>
            <div class="form-group">
                <label>Mot de passe</label>
                <input type="password" class="form-control" name="passwordConnexion" id="passwordConnexion" required
                       placeholder="Mot de passe">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary submit" value="Se connecter"
            </div>
        </form>
    </div>
    </div>

<?php
$message = "";

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
            $message = "Inscription réussi, vous pouvez désormais vous connecter !";
        } else {
            $message = "L'adresse mail n'est pas valide !";
        }
    } else {
        $message = "Le compte est déjà crée, veuillez vous connecter !";
    }
}

// Connexion
//  Récupération de l'utilisateur et de son pass hashé
if (isset($_POST['emailConnexion'], $_POST['passwordConnexion'])) {
    $emailConnexion = $_POST['emailConnexion'];
    $reponse = $bdd->prepare('SELECT id, email, password, firstname, status FROM user WHERE email = :email');
    $reponse->execute(array(
        ':email' => $emailConnexion));
    $resultat = $reponse->fetch();

    // Comparaison du pass envoyé via le formulaire avec la base
    if ($resultat) {
        $isPasswordCorrect = password_verify($_POST['passwordConnexion'], $resultat['password']);

        if ($isPasswordCorrect) {
            $_SESSION['id'] = $resultat['id'];
            $_SESSION['email'] = $resultat['email'];
            $_SESSION['firstname'] = $resultat['firstname'];
            $_SESSION['status'] = $resultat['status'];
            echo "<script> location.replace('index.php'); </script>";
        }
    } else {
        $message = "Mauvais identifiant ou mot de passe !";
    }
}

echo '<script>document.getElementById("message").innerHTML = "' . $message . '"</script>';
?>