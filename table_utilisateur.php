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
        echo "<table id='festivalTable'>";
        echo "<tr><th class='sortable'>Login</th><th class='sortable'>Mot de passe</th><th class='sortable'>Prénom</th><th class='sortable'>Nom</th><th class='sortable'>Date de naissance</th><th class='sortable'>Supprimer</th><th class='sortable'>Modifier</th></tr>";

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
<script>
    // Fonction pour trier le tableau
    function sortTable(n) {
        let table, rows, switching, i, x, y, shouldSwitch;
        table = document.getElementById("festivalTable");
        switching = true;

        // Définir la direction de tri comme ascendante
        let dir = "asc";
        let switchcount = 0;

        // Continue à effectuer les échanges jusqu'à ce que le tri soit terminé
        while (switching) {
            switching = false;
            rows = table.rows;

            // Parcourir toutes les lignes, sauf la première (en-têtes de colonne)
            for (i = 1; i < rows.length - 1; i++) {
                shouldSwitch = false;
                x = rows[i].getElementsByTagName("TD")[n];
                y = rows[i + 1].getElementsByTagName("TD")[n];

                // Compare les valeurs selon la direction et le type de données
                if (dir === "asc") {
                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                } else if (dir === "desc") {
                    if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                }
            }
            if (shouldSwitch) {
                // Effectue l'échange et marque le changement
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
                switchcount++;
            } else {
                // Si aucun échange n'a été effectué et que la direction est ascendante,
                // change la direction en descendante et recommence
                if (switchcount === 0 && dir === "asc") {
                    dir = "desc";
                    switching = true;
                }
            }
        }
    }

    // Ajoute des écouteurs d'événements aux en-têtes de colonne pour déclencher le tri
    const headers = document.getElementsByClassName("sortable");
    for (let i = 0; i < headers.length; i++) {
        headers[i].addEventListener("click", function () {
            sortTable(i);
        });
    }
</script>

<html>