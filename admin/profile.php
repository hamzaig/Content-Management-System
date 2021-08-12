<?php include "includes/admin_header.php" ?>
<?php






if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
    $profile_query = "SELECT * FROM users WHERE username = '$username'";
    $profile_query_result = mysqli_query($conn, $profile_query);
    while ($row = mysqli_fetch_assoc($profile_query_result)) {
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
    }
}

?>

<?php

if (isset($_POST["edit_profile"])) {

    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    // $post_user = "Hamza";
    // $post_date = date('d-m-y');

    // $post_image = $_FILES['image']['name'];
    // $post_image_temp = $_FILES['image']['tmp_name'];

    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    // $post_comment_count = 4065;
    // $post_view_count = 654;
    // $post_comment = "Commentsssss";


    // move_uploaded_file($post_image_temp,"../images/$post_image");

    $query_update = "UPDATE users SET ";
    $query_update .= "user_firstname = '{$user_firstname}', ";
    $query_update .= "user_lastname = '{$user_lastname}', ";
    $query_update .= "username = '{$username}', ";
    $query_update .= "user_email = '{$user_email}', ";
    $query_update .= "user_password = '{$user_password}' ";
    $query_update .= "WHERE username = {$username} ";


    $update_user = mysqli_query($conn, $query_update);

    if (!$update_user) {
        die("SQL Error" . mysqli_error($conn));
    }
}

?>


<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_navigation.php" ?>



    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to Admin
                        <small>Author</small>
                    </h1>
                    <form action="" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="user_firstname">First Name</label>
                            <input type="text" value="<?php echo $user_firstname ?>" name="user_firstname" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="user_lastname">Last Name</label>
                            <input type="text" value="<?php echo $user_lastname ?>" name="user_lastname" class="form-control">
                        </div>

                      




                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" value='<?php echo $username ?>' name="username" class="form-control">
                        </div>

                        <!-- <div class="form-group">
                            <label for="post_image">Post Image</label>
                            <input type="file" name="image">
                        </div> -->

                        <div class="form-group">
                            <label for="user_email">Email</label>
                            <input type="text" value='<?php echo $user_email ?>' name="user_email" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="user_password">Password</label>
                            <input type="password" name="user_password" class="form-control">
                        </div>


                        <div class="form-group">
                            <input type="submit" value="Update User" class="btn btn-primary" name="edit_profile">
                        </div>

                    </form>









                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php include "includes/admin_footer.php" ?>