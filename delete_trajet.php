<?php
$servername = "127.0.0.1";
$database = "kxbshafa_CarGoFest";
$username = "kxbshafa_marcus";
$password = "Basededonnee1234";
$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $passwordbase);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $deleteQuery = "DELETE FROM Annonce WHERE id = :id";
    $deleteStmt = $conn->prepare($deleteQuery);
    $deleteStmt->bindParam(':id', $id);
    $deleteStmt->execute();

    header("Location: annonce_vehicule.html"); // Redirige vers la page festival.html après la suppression
    exit();
} else {
    echo "Identifiant utilisateur non spécifié.";
    exit();
}
?>