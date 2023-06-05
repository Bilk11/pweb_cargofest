<?php
session_start();

// Vérifier si l'utilisateur est déjà connecté
if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true) {
    // Rediriger vers une page appropriée après la connexion
    header('Location: ajouter_vehicule.html');
    exit;
}

// Vérifier si le formulaire de connexion a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $login = $_POST['login'];
    $password = $_POST['password'];

    // Connexion à la base de données
    $servername = "127.0.0.1";
    $database = "kxbshafa_CarGoFest";
    $username = "kxbshafa_marcus";
    $passwordbase = "Basededonnee1234";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $passwordbase);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $adminQuery = "SELECT * FROM Admin WHERE id_connexion = :login AND nom_admin = :password";
        $adminStmt = $conn->prepare($adminQuery);
        $adminStmt->bindParam(':login', $login);
        $adminStmt->bindParam(':password', $password);
        $adminStmt->execute();
        $adminResult = $adminStmt->fetch();

    if ($adminResult) {
        // L'utilisateur a entré un login et mot de passe d'admin, traitement approprié
        header('Location: index.php');
        $_SESSION['admin'] = true;
    }else{

        // Vérifier le login et le mot de passe dans la base de données
        $query = "SELECT password FROM Connexion WHERE login = :login";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':login', $login);
        $stmt->execute();
        $result = $stmt->fetch();

        if ( $password === $result['password']) {
            // Le mot de passe est correct, connecter l'utilisateur
            $_SESSION['loggedIn'] = true;
            $_SESSION['username'] = $login;
            header('Location: index.php');
            exit;
        } else {
            // Le login ou le mot de passe est incorrect
            echo "mauvais mot de passe";
        }
    }
    } catch (PDOException $e) {
        echo "Erreur de connexion à la base de données : " . $e->getMessage();
    }
}
?>