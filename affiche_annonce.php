<?php
$servername = "127.0.0.1";
$database = "kxbshafa_CarGoFest";
$username = "kxbshafa_marcus";
$password = "Basededonnee1234";

try {

    session_start(); // Start the session


    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the user is logged in as an admin
    $isAdmin = false; // Set the initial value to false
    if ($_SESSION['admin'] == true) {
        $isAdmin = true; // User is logged in as admin
    }

    if (isset($_GET['delete'])) {
        $deleteId = $_GET['delete'];
        $deleteQuery = "DELETE FROM Annonce WHERE id = :id";
        $deleteStmt = $conn->prepare($deleteQuery);
        $deleteStmt->bindParam(':id', $deleteId);
        $deleteStmt->execute();
    }


    $sql = "SELECT R.id, R.id_festival, R.type, R.places, R.date_aller, R.date_retour, F.nom_festival 
    FROM Annonce R
    INNER JOIN Festival F ON R.id_festival = F.id";

    $stmt = $conn->query($sql);

    if ($stmt->rowCount() > 0) {
        echo "<table id='festivalTable'>";
        echo "<tr><th class='sortable'>Festival</th><th class='sortable'>Type</th><th class='sortable'>Places</th><th class='sortable'>Date Aller</th><th class='sortable'>Date Retour</th>";
        if ($isAdmin) {
            echo "<th>Action</th>";
        }
        echo "</tr>";

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td style='display: none;'>" . $row["id"] . "</td>";
            echo "<td>" . $row["nom_festival"] . "</td>";
            echo "<td>" . $row["type"] . "</td>";
            echo "<td>" . $row["places"] . "</td>";
            echo "<td>" . $row["date_aller"] . "</td>";
            echo "<td>" . $row["date_retour"] . "</td>";
            if ($isAdmin) {
                echo "<td><a href=\"?delete=" . $row['id'] . "\">Supprimer</a> ";
                echo "<a href=\"edit_annonce.php?id=" . $row["id"] . "\">Modifier</a></td>";
            } else {
                echo "<td>Annonce non trouvé</td>";
            }
            echo "</tr>";
        }


        echo "</table>";
    } else {
        echo "Aucune annonce trouvée.";
    }
} catch (PDOException $e) {
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
    headers[i].addEventListener("click", function() {
        sortTable(i);
    });
}
</script>

<html>