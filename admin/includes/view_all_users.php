<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>FirstName</th>
            <th>LastName</th>
            <th>Email</th>
            <th>Role</th>
        </tr>
    </thead>
    <tbody>

        <?php
        $query = "SELECT * FROM users";
        $select_all_posts_query = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_password = $row['user_password'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_image = $row['user_image'];
            $user_role = $row['user_role'];

            // $query_cat = "SELECT category_title FROM categories WHERE category_id = {$post_category_id}";
            //     $update_title_retrive = mysqli_query($conn, $query_cat);
            //     while ($row = mysqli_fetch_assoc($update_title_retrive)) {
            //         $category_title_cat = $row['category_title'];
            //     }
            echo "
                                    <tr>
                                        <td>$user_id</td>
                                        <td>$username</td>
                                        <td>$user_firstname</td>
                                        <td>$user_lastname</td>
                                        <td>$user_email</td>
                                        <td>$user_role</td>";

            // $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
            // $select_all_posts = mysqli_query($conn, $query);



            // for updating post counts
            // $comment_count_retriving_query = "SELECT * FROM comments WHERE comment_post_id = $comment_post_id";
            // $comment_count_retriving_query_result = mysqli_query($conn, $comment_count_retriving_query);
            // $comment_count_retriving_query_result_row = mysqli_num_rows($comment_count_retriving_query_result);

            // $comment_count_updating_query = "UPDATE posts SET post_comment_count = $comment_count_retriving_query_result_row WHERE post_id = $comment_post_id";
            // $comment_count_updating_query_result = mysqli_query($conn, $comment_count_updating_query);

            ///************************************************** */





            // while ($row1 = mysqli_fetch_assoc($select_all_posts)) {
            //     $post_title = $row1['post_title'];
            //     $post_id = $row1['post_id'];
            //     echo "<td><a href='../post.php?post_id={$post_id}'>$post_title</a></td>";


            // }





            echo "
                    <td><a href='users.php?change_to_admin=$user_id'>Admin</a></td>
                    <td><a href='users.php?change_to_subscriber=$user_id'>Subscriber</a></td>
                    <td><a href='users.php?source=edit_user&edit_user=$user_id'>Edit</a></td>
                    <td><a href='users.php?delete_user=$user_id'>Delete</a></td>
                </tr>";
        }








        if (isset($_GET['delete_user'])) {
            $user_id = $_GET['delete_user'];
            $query = "DELETE FROM users WHERE user_id = {$user_id}";
            $result = mysqli_query($conn, $query);
            if (!$result) {
                die("Record Not Deleted" . mysqli_error($conn));
            } else {
                header("Location: users.php");
            }
        }


        if (isset($_GET['change_to_admin'])) {
            $user_id = $_GET['change_to_admin'];
            $admin_query = "UPDATE users SET user_role = 'Admin' WHERE user_id = {$user_id}";
            $result = mysqli_query($conn, $admin_query);
            if (!$result) {
                die("Record Not Deleted" . mysqli_error($conn));
            } else {

                header("Location: users.php");
            }
        }
        if (isset($_GET['change_to_subscriber'])) {
            $user_id = $_GET['change_to_subscriber'];
            $subscriber_query = "UPDATE users SET user_role = 'Subscriber' WHERE user_id = {$user_id}";
            $result = mysqli_query($conn, $subscriber_query);
            if (!$result) {
                die("Status Not Changed" . mysqli_error($conn));
            } else {
                header("Location: users.php");
            }
        }
        ?>
    </tbody>
</table>