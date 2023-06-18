<?php
$servername = "127.0.0.1";
$database = "kxbshafa_CarGoFest";
$username = "kxbshafa_marcus";
$passwordbase = "Basededonnee1234";
$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $passwordbase);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

<<<<<<< HEAD

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
=======
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
>>>>>>> 38d8bf01ac65e7c716af7c8e63686eb9794a350d
    exit();
} else {
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $selectQuery = "SELECT id, nom_festival, localisation, debut_festival, fin_festival FROM Festival WHERE id = :id";
<<<<<<< HEAD

        $selectStmt = $pdo->prepare($selectQuery);
=======
        $selectStmt = $conn->prepare($selectQuery);
>>>>>>> 38d8bf01ac65e7c716af7c8e63686eb9794a350d
        $selectStmt->bindParam(':id', $id);
        $selectStmt->execute();
        $row = $selectStmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $id = $row["id"];
<<<<<<< HEAD
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
=======
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
>>>>>>> 38d8bf01ac65e7c716af7c8e63686eb9794a350d
        exit();
    }
}
?>

<<<<<<< HEAD
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
=======
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
>>>>>>> 38d8bf01ac65e7c716af7c8e63686eb9794a350d
