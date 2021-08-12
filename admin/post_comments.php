<?php include "includes/admin_header.php" ?>
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
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Author</th>
                                <th>Comment</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Post Name</th>
                                <th>Date</th>
                                <th>Approve</th>
                                <th>Unapprove</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $post_id_get = $_GET["id"];
                            $query = "SELECT * FROM comments WHERE comment_post_id = $post_id_get";
                            $select_all_posts_query = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                                $comment_id = $row['comment_id'];
                                $comment_author = $row['comment_author'];
                                $comment_content = $row['comment_content'];
                                $comment_email = $row['comment_email'];
                                $comment_status = $row['comment_status'];
                                $comment_post_id = $row['comment_post_id'];
                                $comment_date = $row['comment_date'];

                                // $query_cat = "SELECT category_title FROM categories WHERE category_id = {$post_category_id}";
                                //     $update_title_retrive = mysqli_query($conn, $query_cat);
                                //     while ($row = mysqli_fetch_assoc($update_title_retrive)) {
                                //         $category_title_cat = $row['category_title'];
                                //     }
                                echo "
                                    <tr>
                                        <td>$comment_id</td>
                                        <td>$comment_author</td>
                                        <td>$comment_content</td>
                                        <td>$comment_email</td>
                                        <td>$comment_status</td>";

                                $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
                                $select_all_posts = mysqli_query($conn, $query);



                                // for updating post counts
                                $comment_count_retriving_query = "SELECT * FROM comments WHERE comment_post_id = $comment_post_id";
                                $comment_count_retriving_query_result = mysqli_query($conn, $comment_count_retriving_query);
                                $comment_count_retriving_query_result_row = mysqli_num_rows($comment_count_retriving_query_result);

                                $comment_count_updating_query = "UPDATE posts SET post_comment_count = $comment_count_retriving_query_result_row WHERE post_id = $comment_post_id";
                                $comment_count_updating_query_result = mysqli_query($conn, $comment_count_updating_query);

                                ///************************************************** */





                                while ($row1 = mysqli_fetch_assoc($select_all_posts)) {
                                    $post_title = $row1['post_title'];
                                    $post_id = $row1['post_id'];
                                    echo "<td><a href='../post.php?post_id={$post_id}'>$post_title</a></td>";
                                }





                                echo "<td>$comment_date</td>
                                        <td><a href='post_comments.php?approve=$comment_id&id=$post_id_get'>Approve</a></td>
                                        <td><a href='post_comments.php?unapprove=$comment_id&id=$post_id_get'>UnApprove</a></td>
                                        <td><a href='post_comments.php?delete_comment=$comment_id&id=$post_id_get'>Delete</a></td>
                                    </tr>";
                            }








                            if (isset($_GET['delete_comment'])) {
                                $comment_id = $_GET['delete_comment'];
                                $query = "DELETE FROM comments WHERE comment_id = {$comment_id}";
                                $result = mysqli_query($conn, $query);
                                if (!$result) {
                                    die("Record Not Deleted" . mysqli_error($conn));
                                } else {
                                    header("Location: post_comments.php?id=$post_id_get");
                                }
                            }
                            if (isset($_GET['approve'])) {
                                $comment_id = $_GET['approve'];
                                $approve_query = "UPDATE comments SET comment_status = 'Approved' WHERE comment_id = {$comment_id}";
                                $result = mysqli_query($conn, $approve_query);
                                if (!$result) {
                                    die("Record Not Deleted" . mysqli_error($conn));
                                } else {

                                    header("Location: post_comments.php?id=$post_id_get");
                                }
                            }
                            if (isset($_GET['unapprove'])) {
                                $comment_id = $_GET['unapprove'];
                                $unapprove_query = "UPDATE comments SET comment_status = 'Unapproved' WHERE comment_id = {$comment_id}";
                                $result = mysqli_query($conn, $unapprove_query);
                                if (!$result) {
                                    die("Status Not Changed" . mysqli_error($conn));
                                } else {
                                    header("Location: post_comments.php?id=$post_id_get");
                                }
                            }
                            ?>
                        </tbody>
                    </table>


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