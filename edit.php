<?php
$servername = "127.0.0.1";
$database = "kxbshafa_CarGoFest";
$username = "kxbshafa_marcus";
$password = "Basededonnee1234";
$pdo = new PDO("mysql:host=$servername;dbname=$database;charset=utf8", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST["id"]; // Ajout de cette ligne
    $nom_festival = $_POST['nom_festival'];
    $localisation = $_POST['localisation'];
    $debut_festival = $_POST['debut_festival'];
    $fin_festival = $_POST['fin_festival'];

    $updateQuery = "UPDATE Festival SET nom_festival = :nom_festival, localisation = :localisation, debut_festival = :debut_festival, fin_festival = :fin_festival WHERE id = :id";
    $updateStmt = $pdo->prepare($updateQuery);
    $updateStmt->bindParam(':nom_festival', $nom_festival);
    $updateStmt->bindParam(':localisation', $localisation);
    $updateStmt->bindParam(':debut_festival', $debut_festival);
    $updateStmt->bindParam(':fin_festival', $fin_festival);
    $updateStmt->bindParam(':id', $id);
    $updateStmt->execute();

    if ($updateStmt->rowCount() > 0) {
        header("Location: affiche_festival.php");
        exit();
    } else {
        echo "La mise à jour a échoué.";
    }
    exit();
} else {
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $selectQuery = "SELECT id, nom_festival, localisation, debut_festival, fin_festival FROM Festival WHERE id = :id";

        $selectStmt = $pdo->prepare($selectQuery);
        $selectStmt->bindParam(':id', $id);
        $selectStmt->execute();
        $row = $selectStmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $id = $row["id"];
            $nom_festival = $row["nom_festival"];
            $localisation = $row["localisation"];
            $debut_festival = $row["debut_festival"];
            $fin_festival = $row["fin_festival"];
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

<html>
<form action="edit.php?id=<?php echo $id; ?>" method="POST">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <label for="nom_festival">Nom festival:</label>
    <input type="text" name="nom_festival" value="<?php echo $nom_festival; ?>">
    <br>
    <label for="localisation">Localisation:</label>
    <input type="text" name="localisation" value="<?php echo $localisation; ?>">
    <br>
    <label for="debut_festival">Début du festival:</label>
    <input type="date" name="debut_festival" value="<?php echo $debut_festival; ?>">
    <br>
    <label for="fin_festival">Fin du festival:</label>
    <input type="date" name="fin_festival" value="<?php echo $fin_festival; ?>">
    <br>
    <input type="submit" value="Modifier">

</form>

</html>