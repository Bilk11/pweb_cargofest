<?php
// Connexion à la base de données
$servername = "127.0.0.1";
$database = "kxbshafa_CarGoFest";
$username = "kxbshafa_marcus";
$password = "Basededonnee1234";

try {

    session_start(); // Start the session

    $pdo = new PDO("mysql:host=$servername;dbname=$database;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the user is logged in as an admin
    $isAdmin = false; // Set the initial value to false
    if ($_SESSION['admin'] == true) {
        $isAdmin = true; // User is logged in as admin
    }

    // Check if a delete request was sent
    if ($isAdmin && isset($_GET['delete'])) {
        $deleteId = $_GET['delete'];
        $deleteQuery = "DELETE FROM Festival WHERE id = :id";
        $deleteStmt = $pdo->prepare($deleteQuery);
        $deleteStmt->bindParam(':id', $deleteId);
        $deleteStmt->execute();
    }

    // Query to retrieve data from the table "Festival"
    $query = "SELECT id, nom_festival, localisation, debut_festival, fin_festival FROM Festival";
    $stmt = $pdo->query($query);

    // Display the table
    echo "<table id='festivalTable'>";
    echo "<tr>";
    echo "<th class='sortable'>Nom du festival</th>";
    echo "<th class='sortable'>Localisation</th>";
    echo "<th class='sortable'>Début du festival</th>";
    echo "<th class='sortable'>Fin du festival</th>";
    if ($isAdmin) {
        echo "<th>Action</th>";
    }
    echo "</tr>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . $row['nom_festival'] . "</td>";
        echo "<td>" . $row['localisation'] . "</td>";
        echo "<td>" . $row['debut_festival'] . "</td>";
        echo "<td>" . $row['fin_festival'] . "</td>";
        if ($isAdmin) {
            echo "<td><a href=\"?delete=" . $row['id'] . "\">Supprimer</a> | <a href=\"edit.php?id=" . $row['id'] . "\">Modifier</a></td>";
        }
        echo "</tr>";
    }

    echo "</table>";


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