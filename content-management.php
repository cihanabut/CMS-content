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

// la liste des posts depuis la base de données
$query = "SELECT * FROM posts";
$result = mysqli_query($conn, $query);

if (isset($_GET['delete'])) {

    if ($stm = $conn->prepare('DELETE FROM posts WHERE id = ?')) {
        $stm->bind_param('i', $_GET['delete']);
        $stm->execute();

        if ($stm->affected_rows > 0) {
            set_message("Deleted.");
        } else {
            set_message("Not found.");
        }

        $stm->close();
        header('Location: content-management.php');
        exit;
    } else {
        echo 'Could not prepare statement!';
    }
}
?>


<h2>Liste of Posts</h2>
<div class="post-table">
    <table borders="1">
        <tr>
            <th>id</th>
            <th>title</th>
            <th>content</th>
            <th>author</th>
            <th>date</th>
            <br>
            <th>added_date</th>
        </tr>
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($list = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo $list['id']; ?></td>
                    <td><?php echo $list['title']; ?></td>
                    <td><?php echo $list['content']; ?></td>
                    <td><?php echo $list['author']; ?></td>
                    <td><?php echo $list['date']; ?></td>
                    <td><?php echo $list['added_date']; ?></td>

                    <td><a href="post-edit.php?id=<?php echo $list['id']; ?>">Edit</a> | 
            <a href="content-management.php?delete=<?php echo $list['id']; ?>">Delete</a></td>
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
    <a class= "margin" href="post-add.php">Add new post</a>
    </div>
</div>

