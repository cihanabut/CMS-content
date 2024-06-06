<?php
include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');
include('includes/header.php');
include('includes/deroulant.php');

// la connexion à la base de données
if (!$conn) {
    die("Error: " . mysqli_connect_error());
}

// la liste des utilisateurs depuis la base de données
$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);

// supprimer un utilisateur si l'ID est passé via GET
if (isset($_GET['delete'])) {
    $userId = $_GET['delete'];

    // la requête SQL pour supprimer l'utilisateur
    if ($stm = $conn->prepare('DELETE FROM users WHERE id = ?')) {
        $stm->bind_param('i', $userId);
        $stm->execute();

        // si la suppression a été réussie
        if ($stm->affected_rows > 0) {
            set_message("Deleted.");
        } else {
            set_message("Not found.");
        }

        $stm->close();
        header('Location: user-management.php');
        exit;
    } else {
        echo 'Could not prepare statement!';
    }
}
?>


<h2>Liste of Users</h2>
<br>
<div class="user-table">
    <table borders="1">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['role']; ?></td>
                    <td>
                        <a href="edit-user.php?id=<?php echo $row['id']; ?>">Edit</a> |
                        <a href="user-management.php?delete=<?php echo $row['id']; ?>">Delete</a>
                    </td>
                </tr>
                <?php
            }
        } else {
            ?>
            <tr>
                <td colspan="5">Nada.</td>
            </tr>
            <?php
        }
        ?>
    </table>
    <div class="add">
    <button><a class="margin" href="user-add.php">Add user</a> </button>
    </div>
</div>
