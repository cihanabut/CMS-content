<?php
include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');
include('includes/header.php');
include('includes/deroulant.php');

if (isset($_POST['add-user'])) {
    // les données du formulaire
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // la requête SQL pour insérer un nouvel utilisateur
    $query = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)";
    
    // Préparation de la déclaration SQL
    $stmt = mysqli_prepare($conn, $query);
    
    // Lier les paramètres avec la déclaration SQL
    mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $password, $role);
    
    // Exécuter la déclaration
    $result = mysqli_stmt_execute($stmt);

    // Vérifier si l'ajout a réussi
    if ($result) {
        echo "Added.";
        header('Location: user-management.php');
        die();
    } else {
        echo "Error. " . mysqli_error($conn);
    }

}

?>

<div class="user-page">
    <div class="form">
        <h2>Add a user</h2>
        <form class="login-form" method="POST">
            <!-- username input -->
            <input type="text" id="username" name="username" placeholder="Username" required/>
            <!-- email input -->
            <input type="email" id="email" name="email" placeholder="Email" required/>
            <!-- password input -->
            <input type="password" id="password" name="password" placeholder="Password" required/>
            <!-- role input -->
            <select name="role" id="role" >
                        <option value="Admin">Admin</option>
                        <option value="User">User</option>
                    </select>
            <!-- button -->
            <button type="submit" id='add-user' name='add-user'>Add</button>
        </form>
    </div>
</div>
