<?php

include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');
secure();

include('includes/header.php');

if (isset($_POST['username'])) {

    if ($stm = $conn->prepare('UPDATE users set  username = ?,email = ? , role = ?  WHERE id = ?')) {
        $stm->bind_param('sssi', $_POST['username'], $_POST['email'], $_POST['role'], $_GET['id']);
        $stm->execute();

        $stm->close();

        if (isset($_POST['password'])) {
            if ($stm = $conn->prepare('UPDATE users set  password = ? WHERE id = ?')) {
                $hashed = SHA1($_POST['password']);
                $stm->bind_param('si', $hashed, $_GET['id']);
                $stm->execute();

                $stm->close();

            } else {
                echo 'Error!';
            }
        }

        set_message("user  " . $_GET['id'] . " has beed updated");
        header('Location: user-management.php');
        die();

    } else {
        echo 'Error!';
    }

}


if (isset($_GET['id'])) {

    if ($stm = $conn->prepare('SELECT * from users WHERE id = ?')) {
        $stm->bind_param('i', $_GET['id']);
        $stm->execute();

        $result = $stm->get_result();
        $user = $result->fetch_assoc();

        if ($user) {


            ?>
          <div class="login-page">
          <div class="form">

                        <h1>Edit user</h1>

                        <form method="post">
                            <!-- Username input -->
                                <input type="text" id="username" name="username" class="form-control active"
                                    value="<?php echo $user['username'] ?>" />
                            <!-- Email input -->
                                <input type="email" id="email" name="email" class="form-control active"
                                    value="<?php echo $user['email'] ?>" />
                            <!-- Password input -->
                                <input type="password" id="password" name="password" class="form-control" />
                            <!-- Active select -->
                                <select name="role" class="form-select" id="role">
                                    <option <?php echo ($user['role']) ? "selected" : ""; ?> value="admin">admin</option>
                                    <option <?php echo ($user['role']) ? "" : "selected"; ?> value="user">user</option>
                                </select>
                            <!-- Submit button -->
                            <button type="submit">Update</button>
                        </form>



                    </div>

                </div>
            </div>


            <?php
        }
        $stm->close();
     

    } else {
        echo 'Could not prepare statement!';
    }

} else {
    echo "No user selected";
    die();
}

?>