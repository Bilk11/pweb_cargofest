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
    $id_festival = $_POST["id_festival"]; // Ajout de cette ligne
    $type = $_POST["type"];
    $places = $_POST["places"];
    $date_aller = $_POST["date_aller"];
    $date_retour = $_POST["date_retour"];

    $updateQuery = "UPDATE Annonce SET id_festival = :id_festival, type = :type, places = :places, date_aller = :date_aller, date_retour = :date_retour WHERE id = :id";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bindParam(':id_festival', $id_festival);
    $updateStmt->bindParam(':type', $type);
    $updateStmt->bindParam(':places', $places);
    $updateStmt->bindParam(':date_aller', $date_aller);
    $updateStmt->bindParam(':date_retour', $date_retour);
    $updateStmt->bindParam(':id', $id);

    $updateStmt->execute();

    if ($updateStmt->rowCount() > 0) {
        header("Location: affiche_annonce.php");
        exit();
    } else {
        echo "La mise à jour a échoué.";
    }
    exit();
} else {
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $selectQuery = "SELECT id, id_festival, type, places, date_aller, date_retour FROM Annonce WHERE id = :id";
        $selectStmt = $conn->prepare($selectQuery);
        $selectStmt->bindParam(':id', $id);
        $selectStmt->execute();
        $row = $selectStmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $id = $row["id"];
            $id_festival = $row["id_festival"];
            $type = $row["type"];
            $places = $row["places"];
            $date_aller = $row["date_aller"];
            $date_retour = $row["date_retour"];
        } else {
            echo "Annonce non trouvée.";
            exit();
        }
    } else {
        echo "Identifiant de l'annonce non spécifié.";
        exit();
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Modifier une annonce</title>
</head>

<body>
    <h2>Modifier une annonce</h2>

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
        <label for="type_vehicule">Selectioner un type de Vehicule:</label>

        <select name="type" id="type_vehicule">
            <option value="familliale">familliale</option>
            <option value="suv">SUV</option>
            <option value="coupe">Coupe</option>
            <option value="Monospace">Monospace</option>
            <option value="citadine">Citadine</option>
            <option value="Van">Van</option>
        </select></br>
        <label for="places">Places:</label>
        <input type="text" name="places" value="<?php echo $places; ?>">
        <br>
        <label for="date_aller">Date aller:</label>
        <input type="date" name="date_aller" value="<?php echo $date_aller; ?>">
        <br>
        <label for="date_retour">Date retour:</label>
        <input type="date" name="date_retour" value="<?php echo $date_retour; ?>">
        <br>
        <input type="submit" value="Modifier">
    </form>
</body>

</html>