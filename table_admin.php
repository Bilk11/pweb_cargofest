<?php
$servername = "127.0.0.1";
$database = "kxbshafa_CarGoFest";
$username = "kxbshafa_marcus";
$password = "Basededonnee1234";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT id_connexion, nom_admin FROM Admin";
    $stmt = $conn->query($sql);

    if ($stmt->rowCount() > 0) {
        echo "<table>";
        echo "<tr><th>Login</th><th>Mot de passe</th></tr>";

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row["id_connexion"] . "</td>";
            echo "<td>" . $row["nom_admin"] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "Aucun enregistrement trouvé dans la table admin.";
    }
} catch(PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}


$conn = null;
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