<?php
try {
    $pdo = 'mysql:host=cosql.fakecompany.life;dbname=groupe3;port=3306;charset=utf8';
    $bdd = new PDO($pdo,'groupe3','Super-Groupe3');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
?>