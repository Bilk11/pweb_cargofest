<?php
$servername = "127.0.0.1";
$database = "kxbshafa_CarGoFest";
$username = "kxbshafa_marcus";
$passwordbase = "Basededonnee1234";
$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $passwordbase);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmtFestivals = $conn->query("SELECT id, nom_festival FROM Festival");
$Festivals = $stmtFestivals->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"]; // Ajout de cette ligne
    $id_festival = $_POST["id_festival"];
    $places = $_POST["places"];
    $recherche_aller = $_POST["recherche_aller"];
    $recherche_retour = $_POST["recherche_retour"];

    $updateQuery = "UPDATE Recherche SET id_festival = :id_festival, places = :places, recherche_aller = :recherche_aller, recherche_retour = :recherche_retour WHERE id = :id";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bindParam(':id_festival', $id_festival);
    $updateStmt->bindParam(':places', $places);
    $updateStmt->bindParam(':recherche_aller', $recherche_aller);
    $updateStmt->bindParam(':recherche_retour', $recherche_retour);
    $updateStmt->bindParam(':id', $id);

    $updateStmt->execute();

    if ($updateStmt->rowCount() > 0) {
        header("Location: affiche_recherche.php");
        exit();
    } else {
        echo "La mise à jour a échoué.";
    }
    exit();
} else {
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $selectQuery = "SELECT id, id_festival, places, recherche_aller, recherche_retour FROM Recherche WHERE id = :id";
        $selectStmt = $conn->prepare($selectQuery);
        $selectStmt->bindParam(':id', $id);
        $selectStmt->execute();
        $row = $selectStmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $id = $row["id"];
            $id_festival = $row["id_festival"];
            $places = $row["places"];
            $recherche_aller = $row["recherche_aller"];
            $recherche_retour = $row["recherche_retour"];
        } else {
            echo "Recherche non trouvée.";
            exit();
        }
    } else {
        echo "Identifiant de la recherche non spécifié.";
        exit();
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Modifier une recherche de trajet</title>
</head>

<body>
    <h2>Modifier une recherche de trajet</h2>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label for="id_festival">Choisissez un Festival :</label>
        <select name="id_festival" id="Festival">
            <?php foreach ($Festivals as $Festival): ?>
                <option value="<?php echo $Festival['id']; ?>" <?php if ($Festival['id'] == $id_festival)
                       echo 'selected'; ?>>
                    <?php echo $Festival['nom_festival']; ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <label for="places">Places:</label>
        <input type="text" name="places" value="<?php echo $places; ?>">
        <br>
        <label for="recherche_aller">Date aller:</label>
        <input type="date" name="recherche_aller" value="<?php echo $recherche_aller; ?>">
        <br>
        <label for="recherche_retour">Date retour:</label>
        <input type="date" name="recherche_retour" value="<?php echo $recherche_retour; ?>">
        <br>
        <input type="submit" value="Modifier">
    </form>
</body>

</html>