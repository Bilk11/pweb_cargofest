<?php
$servername = "127.0.0.1";
$database = "kxbshafa_CarGoFest";
$username = "kxbshafa_marcus";
$passwordbase = "Basededonnee1234";
$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $passwordbase);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nomFestival = $_POST["nom_festival"];
    $localisation = $_POST["localisation"];
    $debutFestival = $_POST["debut_festival"];
    $finFestival = $_POST["fin_festival"];

    $updateQuery = "UPDATE Festival SET nom_festival = :nom_festival, localisation = :localisation, debut_festival = :debut_festival, fin_festival = :fin_festival WHERE id = :id";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bindParam(':nom_festival', $nomFestival);
    $updateStmt->bindParam(':localisation', $localisation);
    $updateStmt->bindParam(':debut_festival', $debutFestival);
    $updateStmt->bindParam(':fin_festival', $finFestival);
    $updateStmt->bindParam(':id', $id);
    $updateStmt->execute();

    header("Location: festival.html"); // Redirige vers la page table_festival.php après la modification
    exit();
} else {
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $selectQuery = "SELECT id, nom_festival, localisation, debut_festival, fin_festival FROM Festival WHERE id = :id";
        $selectStmt = $conn->prepare($selectQuery);
        $selectStmt->bindParam(':id', $id);
        $selectStmt->execute();
        $row = $selectStmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $id = $row["id"];
            $nomFestival = $row["nom_festival"];
            $localisation = $row["localisation"];
            $debutFestival = $row["debut_festival"];
            $finFestival = $row["fin_festival"];
        } else {
            echo "Festival non trouvé.";
            exit();
        }
    } else {
        echo "Identifiant du festival non spécifié.";
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modifier un festival</title>
</head>
<body>
    <h2>Modifier un festival</h2>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label for="nom_festival">Nom du festival:</label>
        <input type="text" name="nom_festival" value="<?php echo $nomFestival; ?>">
        <br>
        <label for="localisation">Localisation:</label>
        <input type="text" name="localisation" value="<?php echo $localisation; ?>">
        <br>
        <label for="debut_festival">Début du festival:</label>
        <input type="date" name="debut_festival" value="<?php echo $debutFestival; ?>">
        <br>
        <label for="fin_festival">Fin du festival:</label>
        <input type="date" name="fin_festival" value="<?php echo $finFestival; ?>">
        <br>
        <input type="submit" value="Modifier">
    </form>
</body>
</html>
