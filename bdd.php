<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

try {
    $pdo = 'mysql:host=cosql.fakecompany.life;dbname=groupe3;port=3306;charset=utf8';
    $bdd = new PDO($pdo,'groupe3','Super-Groupe3');
    // Affiche un max d'erreur
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // default fetch mode
    $bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
?>