<?php

if (isset($_GET['edit_user'])) {
    $edit_user_id = $_GET['edit_user'];
    $query = "SELECT * FROM users where user_id = $edit_user_id";
    $edit_query = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($edit_query)) {
        $edit_user_id = $row['user_id'];
        $edit_username = $row['username'];
        $edit_user_password = $row['user_password'];
        $edit_user_firstname = $row['user_firstname'];
        $edit_user_lastname = $row['user_lastname'];
        $edit_user_email = $row['user_email'];
        $edit_user_image = $row['user_image'];
        $edit_user_role = $row['user_role'];
    }


    if (isset($_POST["edit_user"])) {

        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_role = $_POST['user_role'];
        $username = $_POST['username'];
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];

        if (!empty($user_password)) {
            $query = "SELECT user_password FROM users where user_id = $edit_user_id";
            $password_query = mysqli_query($conn, $query);
            if (!$password_query) {
                die("Query Not Executed.");
            }
            $row = mysqli_fetch_assoc($password_query);
            $db_user_password = $row["user_password"];
            if ($db_user_password != $user_password) {
                $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cose' => 12));
            }
        }

        $query_update = "UPDATE users SET ";
        $query_update .= "user_firstname = '{$user_firstname}', ";
        $query_update .= "user_lastname = '{$user_lastname}', ";
        $query_update .= "user_role = '{$user_role}', ";
        $query_update .= "username = '{$username}', ";
        $query_update .= "user_email = '{$user_email}', ";
        $query_update .= "user_password = '{$user_password}' ";
        $query_update .= "WHERE user_id = {$edit_user_id} ";


        $update_user = mysqli_query($conn, $query_update);

        if (!$update_user) {
            die("SQL Error" . mysqli_error($conn));
        }
    }
}else {
    header("Location: index.php");
}
?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="user_firstname">First Name</label>
        <input type="text" value="<?php echo $edit_user_firstname ?>" name="user_firstname" class="form-control">
    </div>

    <div class="form-group">
        <label for="user_lastname">Last Name</label>
        <input type="text" value="<?php echo $edit_user_lastname ?>" name="user_lastname" class="form-control">
    </div>

    <div class="form-group">
        <label for="user_role">Select Role</label>
        <select name="user_role" id="">
            <option value='<?php echo $edit_user_role ?>'><?php echo $edit_user_role ?></option>

            <?php
            if ($edit_user_role == "subscriber" || $edit_user_role == "Subscriber") {
                echo "<option value='admin'>admin</option>";
            } else {
                echo "<option value='subscriber'>Subscriber</option>";
            }
            ?>
            <!-- <?php
                    $query = "SELECT * FROM categories ";
                    $select_all_categories_query = mysqli_query($conn, $query);
                    if (!$select_all_categories_query) {
                        die("Not Executed" . mysqli_error($conn));
                    }
                    while ($row = mysqli_fetch_assoc($select_all_categories_query)) {
                        $category_title = $row['category_title'];
                        $category_id = $row['category_id'];
                        echo "<option value='$category_id'>$category_title</option>";
                    }
                    ?> -->
        </select>
    </div>
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" value='<?php echo $edit_username ?>' name="username" class="form-control">
    </div>

    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="text" value='<?php echo $edit_user_email ?>' name="user_email" class="form-control">
    </div>

    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" name="user_password" class="form-control">
    </div>


    <div class="form-group">
        <input type="submit" value="Update User" class="btn btn-primary" name="edit_user">
    </div>

</form>