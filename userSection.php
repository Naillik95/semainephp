<?php
require('session.php');
require('bdd.php');
?>

<h1 class="center">Section Utilisateur</h1>

<table class="table table-striped my-5">
    <tbody>
    <?php
    $reponse = $bdd->query('SELECT id, firstname, lastname, email, status FROM user');
    while ($donnees = $reponse->fetch()) {
        ?>
        <tr class="row mx-5">
            <td class="col-4">
                <h4><?php echo $donnees['firstname'] ?> <?php echo $donnees['lastname'] ?></h4>
                <p>Email : <?php echo $donnees['email']?></p>
                <p>Status : <?php echo $donnees['status']?></p>
            </td>
            <td class="col-8">
                <a class="text-primary ml-5" href="modifyUser.php?id_user= <?php echo $donnees['id']; ?>">Modifier</a>
                <a class="text-danger mx-2" href="deleteUser.php?id_user= <?php echo $donnees['id']; ?>">Supprimer</a>
            </td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>