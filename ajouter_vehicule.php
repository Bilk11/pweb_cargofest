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
        $type_vehicule = $_POST['type_vehicule'];
        $places = $_POST['places'];
        $date_depart = $_POST['date_depart'];
        $date_retour = $_POST['date_retour'];

        // Préparation de la requête d'insertion
        $stmt = $conn->prepare("INSERT INTO Annonce (id, id_Festival, type, places, date_aller, date_retour) VALUES (:id, :id_Festival, :type, :places, :date_aller, :date_retour)");

        // Attribution des valeurs des paramètres
        $stmt->bindParam(':id', $nombreAleatoire);
        $stmt->bindParam(':id_Festival', $Festival);
        $stmt->bindParam(':type', $type_vehicule);
        $stmt->bindParam(':places', $places);
        $stmt->bindParam(':date_aller', $date_depart);
        $stmt->bindParam(':date_retour', $date_retour);

        // Exécution de la requête
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // Enregistrement réussi
            header("Location: annonce_vehicule.html");
            exit;
        } else {
            // Erreur lors de l'enregistrement
            header("Location: ajouter_vehicule.php?erreur=1");
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

<h2>
    Vehicule
</h2>
<form method="POST" action="ajouter_vehicule.php">
    <label for="Festival">Choisissez un Festival :</label>
    <select name="Festival" id="Festival">
        <?php foreach ($Festivals as $Festival): ?>
            <option value="<?php echo $Festival['id']; ?>"><?php echo $Festival['nom_festival']; ?></option>
        <?php endforeach; ?>
    </select><br>
    <label for="type_vehicule">Selectioner un type de Vehicule:</label>

    <select name="type_vehicule" id="type_vehicule">
        <option value="familliale">familliale</option>
        <option value="suv">SUV</option>
        <option value="coupe">Coupe</option>
        <option value="Monospace">Monospace</option>
        <option value="citadine">Citadine</option>
        <option value="Van">Van</option>
    </select></br>
    <label for="places">Nombre de places disponibles :</label>
    <input type="number" name="places" id="places" required></br>
    <label for="date_depart">Date du depart :</label></br>
    <input type="date" name="date_depart" id="date_depart" required></br>
    <label for="date_retour">Date du retour (facultatif) :</label></br>
    <input type="date" name="date_retour" id="date_retour"></br>

    <input type="submit" value="Envoyer">
</form>

</html>