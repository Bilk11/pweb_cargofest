<?php
// Informations de connexion à la base de données
$serveur = "https://node90-eu.n0c.com/phpmyadmin/index.php?route=/sql&pos=0&db=kxbshafa_CarGoFest&table=Connexion"; // Adresse du serveur MySQL
$utilisateur = "kxbshafa_Joseph"; // Nom d'utilisateur MySQL
$motDePasse = "BYC8qeaGyswSZ9"; // Mot de passe MySQL
$baseDeDonnees = "connexion"; // Nom de la base de données

// Connexion à la base de données
$connexion = new mysqli($serveur, $utilisateur, $motDePasse, $baseDeDonnees);

// Vérifier la connexion
if ($connexion->connect_error) {
    die("La connexion a échoué : " . $connexion->connect_error);
}

// Récupérer les données du formulaire
$login = $_POST['login']; // Récupérer la valeur du champ "login" du formulaire
$password = $_POST['password']; // Récupérer la valeur du champ "password" du formulaire

// Échapper les caractères spéciaux pour éviter les injections SQL
$login = $connexion->real_escape_string($login);
$password = $connexion->real_escape_string($password);

// Requête d'insertion des données dans la table
$sql = "INSERT INTO utilisateurs (login, password) VALUES ('$login', '$password')";

if ($connexion->query($sql) === TRUE) {
    echo "Enregistrement réussi.";
} else {
    echo "Erreur lors de l'enregistrement : " . $connexion->error;
}

// Fermer la connexion à la base de données
$connexion->close();
?>

<html>
<head>
    <title>Connexion</title>
</head>
<body>
    <h2>Veuillez rentre votre nom d'utilisateur et votre mot de passe</h2>
    <form method="POST" action="connexion.php">
        
        <label for="login">Login :</label>
        <input type="text" name="login" id="login" required></br>
        <label for="password">Password :</label>
        <input type="password" name="password" id="password" required></br>
        <input type="submit" value="Envoyer">
    </form>
</body>
</html>
