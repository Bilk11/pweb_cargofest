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
    // Création d'une connexion PDO
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);

    // Configuration des options de PDO
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Préparation de la requête d'insertion
    $stmt = $conn->prepare("INSERT INTO Connexion (id,login, password) VALUES (:id,:login, :password)");

    // Paramètres de la requête
    $login = $_POST['login'];
    $password = $_POST['password'];

    // Attribution des valeurs des paramètres
    $stmt->bindParam(':id', $nombreAleatoire);
    $stmt->bindParam(':login', $login);
    $stmt->bindParam(':password', $password);

    // Exécution de la requête
    $stmt->execute();
    if (!empty($login) && !empty($password)) {
        // Effectuer l'enregistrement dans la base de données
        // Votre code d'enregistrement ici
        // Vérifier si l'enregistrement a réussi
            // Redirection vers une autre page en cas de succès
            session_start();
            $_SESSION['loggedIn'] = true;
            header("Location: index.html");
            exit;
        
    }else{
        header("Location: connexion.html?erreur=1");
            exit;
    }
    echo "Enregistrement réussi !";
} catch(PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

// Fermeture de la connexion
$conn = null;
?>
