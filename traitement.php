<!DOCTYPE html>
<html>

<head>
    <title>Résultat du formulaire</title>
</head>

<body>
    <h2>Résultat du formulaire</h2>

    <?php
    // Récupérer les données soumises via la méthode POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if (isset($_POST['prenom']) && !empty($_POST['prenom'])) {
            $prenom = $_POST['prenom'];
            echo "Prenom: " . htmlspecialchars($prenom) . "<br>";
        }
    }
    ?>

</body>

</html>