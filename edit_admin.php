<?php
$servername = "127.0.0.1";
$database = "kxbshafa_CarGoFest";
$username = "kxbshafa_marcus";
$passwordbase = "Basededonnee1234";
$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $passwordbase);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $id_connexion = $_POST["id_connexion"];
    $nom_admin = $_POST["nom_admin"];

    $updateQuery = "UPDATE Admin SET id_connexion = :id_connexion, nom_admin = :nom_admin WHERE id = :id";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bindParam(':id', $id);
    $updateStmt->bindParam(':id_connexion', $id_connexion);
    $updateStmt->bindParam(':nom_admin', $nom_admin);
    $updateStmt->execute();

    header("Location: table_admin.php");
    exit();
} else {
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $selectQuery = "SELECT id, id_connexion, nom_admin FROM Admin WHERE id = :id";
        $selectStmt = $conn->prepare($selectQuery);
        $selectStmt->bindParam(':id', $id);
        $selectStmt->execute();
        $row = $selectStmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $id = $row["id"];
            $id_connexion = $row["id_connexion"];
            $nom_admin = $row["nom_admin"];
        } else {
            echo "Admin non trouvé.";
            exit();
        }
    } else {
        echo "Admin non spécifié.";
        exit();
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Modifier un admin</title>
</head>

<body>
    <h2>Modifier un admin</h2>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label for="id_connexion">Login:</label>
        <input type="text" name="id_connexion" value="<?php echo $id_connexion; ?>">
        <br>
        <label for="nom_admin">Mot de passe:</label>
        <input type="text" name="nom_admin" value="<?php echo $nom_admin; ?>">
        <br>
        <input type="submit" value="Modifier">
    </form>
</body>

</html>