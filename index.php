<!DOCTYPE html>
<html>

<head>
    <link href="style.css" rel="stylesheet" media="all" type="text/css">
    <script src="https://kit.fontawesome.com/656574d4d8.js" crossorigin="anonymous"></script>
    <meta charset="utf-8">
</head>

<body>
    <a href="index.php">
        <header>
            <i class="fa-solid fa-car"></i>
            <h1>CAR GO FEST</h1>
        </header>
    </a>
    <div class="links">
        <?php
        session_start();
        echo 'Bonjour ' . $_SESSION['username'];
        if ($_SESSION['admin'] == true) {
            // L'utilisateur est connecté en tant qu'administrateur
            echo "<a href='table_utilisateur.php' class='link'>table utilisateur</a>";
            echo "<a href='table_admin.php' class='link'>table admin</a>";

            // Le contenu de la page d'administration peut être affiché ici
        }
        if ($_SESSION['loggedIn'] != true) {
            echo "<a href='identification.html'>S'identifier</a>";
        }
        ?>
    </div>
    <div class="contenue">
        <button type="button" onclick="window.location.href = 'festival.html';">Les festivals</br></button>
        <button type="button" onclick="window.location.href = 'annonce_vehicule.html';">Les trajets</br></button>
        <button type="button" onclick="window.location.href = 'recherche.html';">Les recherche de
            trajet</button>
    </div>
    <div class="deco">
        <form action="deconnexion.php">
            <button type="submit">Se déconnecter</button>
        </form>
    </div>
</body>

</html>