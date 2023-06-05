<?php
    session_start();
    // Vérifier si l'utilisateur est connecté en tant qu'administrateur
    if ( $_SESSION['admin'] === true) {
        // L'utilisateur est connecté en tant qu'administrateur
        echo "<h1>Bienvenue, administrateur !</h1>";
        // Le contenu de la page d'administration peut être affiché ici
    } else {
        // L'utilisateur n'est pas connecté en tant qu'administrateur
        echo "<h1>Accès restreint</h1>";
        echo "<p>Vous devez être connecté en tant qu'administrateur pour accéder à cette page.</p>";
    }
    ?>