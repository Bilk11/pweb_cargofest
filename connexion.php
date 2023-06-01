<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "127.0.0.1";
$database = "kxbshafa_CarGoFest";
$username = "kxbshafa_marcus";
$password = "Basededonnee1234";

try {
    // Création d'une connexion PDO
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);

    // Configuration des options de PDO
    //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Préparation de la requête d'insertion
    $stmt = $conn->prepare("INSERT INTO Connexion (login, password) VALUES (:login, :password)");

    // Paramètres de la requête
    $login = $_POST['login'];
    $password = $_POST['password'];

    // Attribution des valeurs des paramètres
    $stmt->bindParam(':login', $login);
    $stmt->bindParam(':password', $password);

    // Exécution de la requête
    $stmt->execute();

    echo "Enregistrement réussi !";
} catch(PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

// Fermeture de la connexion
$conn = null;
?>
