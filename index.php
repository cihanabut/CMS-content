<?php
include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');
include('includes/header.php');

if(isset($_SESSION['id'])){
    header('Location: dashboard.php');
    die();
}

// Connexion à la base de données
$conn = mysqli_connect('localhost', 'root', 'root', 'Cms');

// Vérifier la connexion
if (!$conn) {
    die("Erreur de connexion à la base de données: " . mysqli_connect_error());
}

// Vérifier si le formulaire a été soumis
if (isset($_POST['login'])) {
    // Récupérer les données du formulaire
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Préparer la requête SQL pour vérifier les informations d'identification
    $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password' ";
    $result = mysqli_query($conn, $query);

    // Vérifier si des résultats ont été renvoyés
    if (mysqli_num_rows($result) == 1) {
        // Authentification réussie, configurez la session
        $_SESSION['id'] = $email; // Utiliser un identifiant unique comme 'id'
        set_message("Successfully logged in");
        header("Location: dashboard.php"); // Rediriger vers le tableau de bord
        exit;
    } else {
        // Authentification échouée
        echo "Email ou mot de passe incorrect.";
    }
}

?>

<div class="login-page">
    <div class="form">
        <form class="login-form" method="POST">
            <input type="email" id="email" name="email" placeholder="email" required/>
            <input type="password" id="password" name="password" placeholder="password" required/>
            <button type="submit" id='login' name='login' >login</button>
        </form>
    </div>
</div>


