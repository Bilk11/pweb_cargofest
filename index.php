<?php
session_start();
echo 'Bonjour ' . $_SESSION['username'] . '<br>';
if ($_SESSION['admin'] == true) {
    // L'utilisateur est connecté en tant qu'administrateur
    echo "<a href='table_utilisateur.php'>table utilisateur </a>";
    echo "<a href='table_admin.php'>table admin </a>";

    // Le contenu de la page d'administration peut être affiché ici
}
if ($_SESSION['loggedIn'] != true) {
    echo "<a href='identification.html'> S'identifier</a>";

} else {
    echo "";
}

?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
    <style>
        a {
            background-color: #0a0a23;
            color: white;
            border: none;
            border-radius: 10px;
            margin-left: 2%;
            box-shadow: 0px 0px 2px 2px rgb(0, 0, 0);
            font-family: Calibri, Helvetica, sans-serif;
            width: 200px;
            height: auto;
            padding-top: 10px;
            padding-bottom: 10px;
            text-decoration: none;
        }

        a:hover {
            background-color: white;
            color: black;
            transition: 0.5s;
            text-decoration: none;
        }
    </style>
    <meta charset="utf-8">

</head>

<body>
    <!--<a href="connexion.html" class="button">Se connecter</a></br>
    <a href="festival.html" class="button">Ajouter un festival</a></br>
    <a href="annonce_vehicule.html" class="button">Ajouter un trajet</a>-->
    <!--<button type="button" onclick="window.location.href = 'identification.html';">S'identifier</button>-->
    <button type="button" onclick="window.location.href = 'festival.html';">Ajouter un festival</button>
    <button type="button" onclick="window.location.href = 'annonce_vehicule.html';">Ajouter un trajet</button>
    <button type="button" onclick="window.location.href = 'recherche.html';">Ajouter une recherche de trajet</button>
    <form action="deconnexion.php">
        <button type="submit">Se déconnecter</button>
    </form>



</body>

</html>