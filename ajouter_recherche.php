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

    // Récupération de la liste des Festivals depuis la base de données
    $stmtFestivals = $conn->query("SELECT id, nom_festival FROM Festival");
    $Festivals = $stmtFestivals->fetchAll(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Formulaire soumis, récupération des valeurs
        $Festival = $_POST['Festival'];
        $place = $_POST['place'];
        $recherche_depart = $_POST['recherche_depart'];
        $recherche_retour = $_POST['recherche_retour'];

        // Préparation de la requête d'insertion
        $stmt = $conn->prepare("INSERT INTO Recherche (id, id_Festival, place, recherche_aller, recherche_retour) VALUES (:id, :id_Festival, :place, :recherche_aller, :recherche_retour)");

        // Attribution des valeurs des paramètres
        $stmt->bindParam(':id', $nombreAleatoire);
        $stmt->bindParam(':id_Festival', $Festival);
        $stmt->bindParam(':place', $place);
        $stmt->bindParam(':recherche_aller', $recherche_depart);
        $stmt->bindParam(':recherche_retour', $recherche_retour);

        // Exécution de la requête
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // Enregistrement réussi
            header("Location: recherche.html");
            exit;
        } else {
            // Erreur lors de l'enregistrement
            header("Location: ajouter_recherche.html?erreur=1");
            exit;
        }
    }

} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

// Fermeture de la connexion
$conn = null;
?>

<!DOCTYPE html>
<html>

<head>
    <title>Ajouter une recherche</title>
</head>

<body>
    <h2>Recherche de Trajet</h2>
    <form method="POST" action="ajouter_recherche.php">
        <label for="Festival">Choisissez un Festival :</label>
        <select name="Festival" id="Festival">
            <?php foreach ($Festivals as $Festival): ?>
                <option value="<?php echo $Festival['id']; ?>"><?php echo $Festival['nom_festival']; ?></option>
            <?php endforeach; ?>
        </select><br>
        <label for="place">Nombre de place recherchées :</label>
        <input type="number" name="place" id="place" required><br>
        <label for="recherche_depart">Date du depart :</label><br>
        <input type="date" name="recherche_depart" id="recherche_depart"><br>
        <label for="recherche_retour">Date du retour :</label><br>
        <input type="date" name="recherche_retour" id="recherche_retour"><br>

        <input type="submit" value="Envoyer">
    </form>
</body>

</html>