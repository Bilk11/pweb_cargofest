<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Connexion à la base de données
$serveur = "kxbshafa_CarGoFest"; // Adresse du serveur MySQL
$utilisateur = "kxbshafa_Joseph"; // Nom d'utilisateur MySQL
$motDePasse = "Basededonnee1234"; // Mot de passe MySQL
$baseDeDonnees = "Connexion"; // Remplacez par le nom de votre base de données

$serveurMySQL = distant;
$serveur = "127.0.0.1:3306"; // Adresse IP ou nom de domaine du serveur MySQL distant
$port = 21; // Port MySQL distant (généralement 3306)
$conn = new PDO($serveur, $utilisateur, $motDePasse, $baseDeDonnees);

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

// Récupérer les données du formulaire
$login = $_POST['login'];
$password = $_POST['password'];

// Préparer et exécuter la requête SQL
$stmt = $conn->prepare("INSERT INTO Connexion (login, password) VALUES (?, ?)");
$stmt->bind_param("ss", $login, $password);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "Enregistrement réussi !";
} else {
    echo "Erreur lors de l'enregistrement : " . $stmt->error;
}

// Fermer la connexion
$stmt->close();
$conn->close();

?>