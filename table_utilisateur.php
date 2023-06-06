<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$servername = "127.0.0.1";
$database = "kxbshafa_CarGoFest";
$username = "kxbshafa_marcus";
$passwordbase = "Basededonnee1234";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $passwordbase);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if (isset($_GET['delete'])) {
        $deleteId = $_GET['delete'];
        $deleteQuery = "DELETE FROM Connexion WHERE id = :id";
        $deleteStmt = $conn->prepare($deleteQuery);
        $deleteStmt->bindParam(':id', $deleteId);
        $deleteStmt->execute();
    }
    $sql = "SELECT id,login, password, Prenom, Nom, date_naissance FROM Connexion";
    $stmt = $conn->query($sql);

    if ($stmt->rowCount() > 0) {
        echo "<table>";
        echo "<tr><th>Login</th><th>Mot de passe</th><th>Prénom</th><th>Nom</th><th>Date de naissance</th><th>Supprimer</th><th>Modifier</th></tr>";

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row["login"] . "</td>";
            echo "<td>" . $row["password"] . "</td>";
            echo "<td>" . $row["Prenom"] . "</td>";
            echo "<td>" . $row["Nom"] . "</td>";
            echo "<td>" . $row["date_naissance"] . "</td>";
            echo "<td><a href=\"?delete=" . $row['id'] . "\">Supprimer</a></td>";
            echo "<td><a href=\"edit_utilisateur.php?id=" . $row["id"] . "\">Modifier</a></td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "Aucun enregistrement trouvé dans la table connexion.";
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>


<html>
<head>
    <title>Tableau des annonces</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 16px;
        }
        
        table th,
        table td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ccc;
        }
        
        table th {
            background-color: #f2f2f2;
        }
        
        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        
        table tr:hover {
            background-color: #eaeaea;
        }
    </style>
</head>
<html>