<?php
$servername = "127.0.0.1";
$database = "kxbshafa_CarGoFest";
$username = "kxbshafa_marcus";
$password = "Basededonnee1234";
$pdo = new PDO("mysql:host=$servername;dbname=$database;charset=utf8", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$id = $_GET['id'];
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nom_festival'], $_POST['localisation'], $_POST['debut_festival'], $_POST['fin_festival'])) {
    // Perform the update operation
    $nom_festival = $_POST['nom_festival'];
$localisation = $_POST['localisation'];
$debut_festival = $_POST['debut_festival'];
$fin_festival = $_POST['fin_festival'];

$updateQuery = "UPDATE Festival SET nom_festival = :nom, localisation = :localisation, debut_festival = :debut, fin_festival = :fin WHERE id = :id";
$updateStmt = $pdo->prepare($updateQuery);
$updateStmt->bindParam(':nom', $nom_festival);
$updateStmt->bindParam(':localisation', $localisation);
$updateStmt->bindParam(':debut', $debut_festival);
$updateStmt->bindParam(':fin', $fin_festival);
$updateStmt->bindParam(':id', $id);
$updateStmt->execute();

$selectQuery = "SELECT nom_festival, localisation, debut_festival, fin_festival FROM Festival WHERE id = :id";
$selectStmt = $pdo->prepare($selectQuery);
$selectStmt->bindParam(':id', $id);
$selectStmt->execute();

$row = $selectStmt->fetch(PDO::FETCH_ASSOC);

$nom_festival = $row['nom_festival'];
$localisation = $row['localisation'];
$debut_festival = $row['debut_festival'];
$fin_festival = $row['fin_festival'];


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nom_festival'], $_POST['localisation'], $_POST['debut_festival'], $_POST['fin_festival'])) {


    //  redirige vers la page aui vient d'etre modif
    header("Location: festival.html");
    exit();
}
}



?>
<html>
<form action="edit.php?id=<?php echo $id; ?>" method="POST">
    <label for="nom_festival">Nom du festival:</label>
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
