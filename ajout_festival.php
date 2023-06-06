<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "127.0.0.1";
$database = "kxbshafa_CarGoFest";
$username = "kxbshafa_marcus";
$password = "Basededonnee1234";
$nombreAleatoire = mt_rand(1, 10000);

try {
    session_start();
    if (!isset($_SESSION['admin']) || $_SESSION['user'] !== 'admin') {
    header('Location: index.php');
    exit();
    }

    // Création d'une connexion PDO
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);

    // Configuration des options de PDO
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Préparation de la requête d'insertion
    $stmt = $conn->prepare("INSERT INTO Festival (id,nom_festival,debut_festival,localisation,fin_festival) VALUES (:id,:nom_festival,:debut_festival,:localisation,:fin_festival)");

    // Paramètres de la requête
    $nom_festival = $_POST['nom_festival'];
    $localisation = $_POST['localisation'];
    $debut_festival = $_POST['debut_festival'];
    $fin_festival = $_POST['fin_festival'];


    // Attribution des valeurs des paramètres
    $stmt->bindParam(':id', $nombreAleatoire);
    $stmt->bindParam(':nom_festival', $nom_festival);
    $stmt->bindParam(':debut_festival', $debut_festival);
    $stmt->bindParam(':localisation', $localisation);
    $stmt->bindParam(':fin_festival', $fin_festival);

    


    // Exécution de la requête
    $stmt->execute();
    if (!empty($nom_festival) && !empty($localisation)) {
        // Effectuer l'enregistrement dans la base de données
        // Votre code d'enregistrement ici
        // Vérifier si l'enregistrement a réussi
            // Redirection vers une autre page en cas de succès
            header("Location: festival.html");
            exit;
        
    }else{
        header("Location: ajout_festival.html?erreur=1");
            exit;
    }
    echo "Enregistrement réussi !";
} catch(PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

// Fermeture de la connexion
$conn = null;
?>
