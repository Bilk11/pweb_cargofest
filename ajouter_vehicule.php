
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
    $stmt = $conn->prepare("INSERT INTO Annonce (id,id_festival,type,places,date_aller,date_retour) VALUES (:id,:id_festival, :type, :places, :date_aller, :date_retour)");

    // Paramètres de la requête
    $type = $_POST['type_vehicule'];
    $place = $_POST['place_dispo'];
    $date_depart = $_POST['date_depart'];
    $date_retour = $_POST['date_retour'];



    // Attribution des valeurs des paramètres
    $stmt->bindParam(':id', $nombreAleatoire); 
    $stmt->bindParam(':id_festival', $nombreAleatoire);
    $stmt->bindParam(':type', $type);
    $stmt->bindParam(':places', $place);
   
    $stmt->bindParam(':date_aller', $date_depart);
    $stmt->bindParam(':date_retour', $date_retour);


    // Exécution de la requête
        $stmt->execute();
        
        
        if (!empty($date_depart) && !empty($place)) {
        // Effectuer l'enregistrement dans la base de données
        // Votre code d'enregistrement ici
        // Vérifier si l'enregistrement a réussi
            // Redirection vers une autre page en cas de succès
            header("Location: index.html");
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

