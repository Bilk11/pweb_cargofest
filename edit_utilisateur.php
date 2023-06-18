<?php
$servername = "127.0.0.1";
$database = "kxbshafa_CarGoFest";
$username = "kxbshafa_marcus";
$passwordbase = "Basededonnee1234";
$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $passwordbase);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $login = $_POST["login"];
    $password = $_POST["password"];
    $prenom = $_POST["prenom"];
    $nom = $_POST["nom"];
    $dateNaissance = $_POST["date_naissance"];

    $updateQuery = "UPDATE Connexion SET login = :login, password = :password, Prenom = :prenom, Nom = :nom, date_naissance = :date_naissance WHERE id = :id";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bindParam(':login', $login);
    $updateStmt->bindParam(':password', $password);
    $updateStmt->bindParam(':prenom', $prenom);
    $updateStmt->bindParam(':nom', $nom);
    $updateStmt->bindParam(':date_naissance', $dateNaissance);
    $updateStmt->bindParam(':id', $id);
    $updateStmt->execute();

    header("Location: table_utilisateur.php"); 
    exit();
} else {
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $selectQuery = "SELECT id, login, password, Prenom, Nom, date_naissance FROM Connexion WHERE id = :id";
        $selectStmt = $conn->prepare($selectQuery);
        $selectStmt->bindParam(':id', $id);
        $selectStmt->execute();
        $row = $selectStmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $id = $row["id"];
            $login = $row["login"];
            $password = $row["password"];
            $prenom = $row["Prenom"];
            $nom = $row["Nom"];
            $dateNaissance = $row["date_naissance"];
        } else {
            echo "Utilisateur non trouvé.";
            exit();
        }
    } else {
        echo "Identifiant utilisateur non spécifié.";
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modifier un utilisateur</title>
</head>
<body>
    <h2>Modifier un utilisateur</h2>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label for="login">Login:</label>
        <input type="text" name="login" value="<?php echo $login; ?>">
        <br>
        <label for="password">Mot de passe:</label>
        <input type="password" name="password" value="<?php echo $password; ?>">
        <br>
        <label for="prenom">Prénom:</label>
        <input type="text" name="prenom" value="<?php echo $prenom; ?>">
        <br>
        <label for="nom">Nom:</label>
        <input type="text" name="nom" value="<?php echo $nom; ?>">
        <br>
        <label for="date_naissance">Date de naissance:</label>
        <input type="text" name="date_naissance" value="<?php echo $dateNaissance; ?>">
        <br>
        <input type="submit" value="Modifier">
    </form>
</body>
</html>
