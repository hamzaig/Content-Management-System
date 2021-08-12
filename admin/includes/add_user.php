<?php
if (isset($_POST["create_user"])) {

    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];

    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cose' => 12));

    $query = "INSERT INTO users(user_firstname,user_lastname,user_role,username,user_email,user_password) ";
    $query .= "VALUES('{$user_firstname}','{$user_lastname}','{$user_role}','{$username}','{$user_email}','{$user_password}')";

    $result = mysqli_query($conn,$query);
    if(!$result){
        die("Not Executed".mysqli_error($conn));
    }
    echo "User Created : <a href='users.php'>View Users</a>";
}

?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="user_firstname">First Name</label>
        <input type="text" name="user_firstname" class="form-control">
    </div>

    <div class="form-group">
        <label for="user_lastname">Last Name</label>
        <input type="text" name="user_lastname" class="form-control">
    </div>

    <div class="form-group">
        <label for="user_role">Select Role</label>
        <select name="user_role" id="">
            <option value='admin'>Admin</option>
            <option value='subscriber'>Subscriber</option>

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
        <input type="text" name="username" class="form-control">
    </div>

    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="text" name="user_email" class="form-control">
    </div>

    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" name="user_password" class="form-control">
    </div>

    <div class="form-group">
        <input type="submit" value="Add User" class="btn btn-primary" name="create_user">
    </div>
</form>