<?php
session_start();
            echo 'Bonjour ' .$_SESSION['username'];
            if ( $_SESSION['admin'] === true) {
                // L'utilisateur est connecté en tant qu'administrateur
                echo "<a href='table_utilisateur.php'>table utilisateur</a>";

                // Le contenu de la page d'administration peut être affiché ici
            }
            if ($_SESSION['loggedIn'] !== true) {
                echo "<a href='identification.html'>S'identifier</a>";

                }else{
                    echo "";
                }
        ?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    
</head>
<body>
    <!--<a href="connexion.html" class="button">Se connecter</a></br>
    <a href="festival.html" class="button">Ajouter un festival</a></br>
    <a href="annonce_vehicule.html" class="button">Ajouter un trajet</a>-->
    <!--<button type="button" onclick="window.location.href = 'identification.html';">S'identifier</button>-->
    <button type="button" onclick="window.location.href = 'festival.html';">Ajouter un festival</button>
    <button type="button" onclick="window.location.href = 'annonce_vehicule.html';">Ajouter un trajet</button>

    <form action="deconnexion.php" >
        <button type="submit">Se déconnecter</button>
    </form>
    


</body>
</html>
