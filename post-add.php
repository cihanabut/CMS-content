<?php

include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');
secure();

include('includes/header.php');

if (isset($_POST['title'])) {

    if ($stm = $conn->prepare('INSERT INTO posts (title, content, author, date) VALUES (?, ?, ?, ?)')) {
        $stm->bind_param('ssis', $_POST['title'], $_POST['content'], $_POST['author'], $_POST['date']);
        $stm->execute();

        $stm->close();

        set_message("Post " . $_GET['id'] . " has beed created.");
        header('Location: content-management.php');
        die();

    } else {
        echo 'Error!';
    }
}

?>

<div class="post-page">
    <div class="form">
        <h2>Add a post</h2>
        <form class="login-form" method="POST">
            <!-- title input -->
            <input type="text" id="title" name="title" placeholder="Title" required/>
            <!-- content input -->
            <textarea name="content" id="content"></textarea>
            <!-- date input -->
            <input type="date" id="date" name="date">
            <!-- author input -->
            <input type="number" id="author" name="author">
            <!-- button -->
            <button type="submit" id='add-post' name='add-post'>Add</button>
        </form>
    </div>
</div>

<script src="js/tinymce/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: '#content'
    });
</script>

