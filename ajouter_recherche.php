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
    if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
        header('Location: identification.html');
        exit();
    }

    // Création d'une connexion PDO
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);

    // Configuration des options de PDO
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Préparation de la requête d'insertion
    $stmt = $conn->prepare("INSERT INTO  (id,id_festival,id_connexion,places,recherche_aller,recherche_retour) VALUES (:id,:id_festival, :id_connexion, :places, :recherche_aller, :recherche_retour)");

    // Paramètres de la requête
    $place = $_POST['place_dispo'];
    $recherche_depart = $_POST['recherche_depart'];
    $recherche_retour = $_POST['recherche_retour'];
    $id_connexion = "SELECT password FROM Connexion WHERE login = :login";



    // Attribution des valeurs des paramètres
    $stmt->bindParam(':id', $nombreAleatoire);
    $stmt->bindParam(':id_festival', $nombreAleatoire);
    $stmt->bindParam(':places', $place);

    $stmt->bindParam(':recherche_aller', $recherche_depart);
    $stmt->bindParam(':recherche_retour', $recherche_retour);


    // Exécution de la requête
    $stmt->execute();


    if (!empty($place)) {
        // Effectuer l'enregistrement dans la base de données
        // Votre code d'enregistrement ici
        // Vérifier si l'enregistrement a réussi
        // Redirection vers une autre page en cas de succès
        header("Location: recherche.html");
        exit;

    } else {
        header("Location: ajout_recherche.html?erreur=1");
        exit;
    }

} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

// Fermeture de la connexion
$conn = null;
?>