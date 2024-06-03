<?php

include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');
secure();
include('includes/header.php');

if (isset($_POST['title'])) {

    if ($stm = $conn->prepare('UPDATE posts set  title = ?, content = ? , date = ?  WHERE id = ?')) {
        $stm->bind_param('sssi',  $_POST['title'], $_POST['content'], $_POST['date'], $_GET['id']);
        $stm->execute();

        $stm->close();

        set_message("Post " . $_GET['id'] . " has beed updated");
        header('Location: content-management.php');
        die();

    } else {
        echo 'Error!';
    }
}


if (isset($_GET['id'])) {

    if ($stm = $conn->prepare('SELECT * from posts WHERE id = ?')) {
        $stm->bind_param('i', $_GET['id']);
        $stm->execute();

        $result = $stm->get_result();
        $post = $result->fetch_assoc();

        if ($post) {


            ?>
          <div class="post-page">
          <div class="form">
    <h2>Update a post</h2>
    <form class="login-form" method="POST">
        <!-- title input -->
        <input type="text" id="title" name="title" value="<?php echo $post['title']; ?>" />
        <!-- content input -->
        <textarea name="content" id="content"><?php echo $post['content']; ?></textarea>
        <!-- date input -->
        <input type="date" id="date" name="date" value="<?php echo $post['date']; ?>" />
        <!-- button -->
        <button type="submit" id='update-post' name='update-post'>Update</button>
    </form>
</div>


<script src="js/tinymce/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: '#content'
    });
</script>


            <?php
        }
        $stm->close();
     

    } else {
        echo 'Could not prepare statement!';
    }

} else {
    echo "No post selected";
    die();
}

?>