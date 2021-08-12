<?php include "delete_modal.php"; ?>
<?php

if (isset($_POST["checkBoxArray"])) {
    foreach ($_POST["checkBoxArray"] as $checkBoxArray) {
        $bulkOptions = $_POST["bulkOptions"];
        switch ($bulkOptions) {
            case 'published':
                $query = "UPDATE posts SET post_status = 'published' WHERE post_id =  $checkBoxArray";
                $publish_query = mysqli_query($conn, $query);
                if (!$publish_query) {
                    die("Query is not executed" . mysqli_error($conn));
                }
                break;
            case 'draft':
                $query = "UPDATE posts SET post_status = 'draft' WHERE post_id =  $checkBoxArray";
                $draft_query = mysqli_query($conn, $query);
                if (!$draft_query) {
                    die("Query is not executed" . mysqli_error($conn));
                }
                break;
            case 'delete':
                $query = "DELETE FROM posts WHERE post_id =  $checkBoxArray";
                $delete_query = mysqli_query($conn, $query);
                if (!$delete_query) {
                    die("Query is not executed" . mysqli_error($conn));
                }
                break;
            case 'resetViews':
                $query = "UPDATE posts SET post_views_count = 0 WHERE post_id =  $checkBoxArray";
                $reset_query = mysqli_query($conn, $query);
                if (!$reset_query) {
                    die("Query is not executed" . mysqli_error($conn));
                }
                break;
            case 'clone':
                $query = "SELECT * FROM posts WHERE post_id = $checkBoxArray";
                $clone_query = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_array($clone_query)) {
                    $clone_post_title = $row['post_title'];
                    $clone_post_category_id = $row['post_category_id'];
                    $clone_post_date = $row['post_date'];
                    $clone_post_author = $row['post_author'];
                    $clone_post_user = $row['post_user'];
                    $clone_post_status = $row['post_status'];
                    $clone_post_image = $row['post_image'];
                    $clone_post_tags = $row['post_tags'];
                    $clone_post_contents = $row['post_content'];
                }
                if (!$clone_query) {
                    die("Query is not executed" . mysqli_error($conn));
                }
                $query = "INSERT INTO posts(post_category_id,post_title,post_author,post_user,post_date,post_image,post_content,post_tags,post_status) ";
                $query .= "VALUES($clone_post_category_id,'$clone_post_title','$clone_post_author','$clone_post_user','$clone_post_date','$clone_post_image','$clone_post_contents','$clone_post_tags','$clone_post_status')";
                $clone_query = mysqli_query($conn, $query);
                if (!$clone_query) {
                    die("Query is not executed" . mysqli_error($conn));
                }
                break;
        }
    }
}
?>

<form action="" method="post">
    <table class="table table-bordered table-hover">
        <div id="bulkOptionContainer" style="padding: 0%;" class="col-xs-4">
            <select name="bulkOptions" id="" class="form-control">
                <option value="">Select Options</option>
                <option value="published">Publish</option>
                <option value="draft">Draft</option>
                <option value="delete">Delete</option>
                <option value="clone">Clone</option>
                <option value="resetViews">Reset Views</option>
            </select>
        </div>
        <div class="col-xs-4">
            <input type="submit" value="Apply" class="btn btn-success" name="submit">
            <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
        </div>



        <thead>
            <tr>
                <th><input type="checkbox" name="selectAllBoxes" class="" id="selectAllBoxes"></th>
                <th>Id</th>
                <th>Users</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Date</th>
                <th>Views</th>
                <th>View Post</th>
                <th>Edit Post</th>
                <th>Delete Post</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $query = "SELECT * FROM posts ORDER BY post_id DESC";
            $select_all_posts_query = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                $post_id = $row['post_id'];
                $post_author = $row['post_author'];
                $post_user = $row['post_user'];
                $post_title = $row['post_title'];
                $post_category_id = $row['post_category_id'];
                $post_status = $row['post_status'];
                $post_image = $row['post_image'];
                $post_tags = $row['post_tags'];
                $post_comments = $row['post_comment'];
                $post_date = $row['post_date'];
                $post_views_count = $row['post_views_count'];



                $comment_query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
                $send_comment_query = mysqli_query($conn, $comment_query);
                $query_result_row = mysqli_num_rows($send_comment_query);





                $query_cat = "SELECT category_title FROM categories WHERE category_id = {$post_category_id}";
                $update_title_retrive = mysqli_query($conn, $query_cat);
                while ($row = mysqli_fetch_assoc($update_title_retrive)) {
                    $category_title_cat = $row['category_title'];
                }
                echo "
                                    <tr>"
            ?>

                <td><input type="checkbox" class="checkBoxes" name="checkBoxArray[]" value="<?php echo $post_id ?>" id=""></td>


            <?php
                echo "<td>$post_id</td>";

                echo "<td>$post_user</td>";

                echo "<td>$post_title</td>
                    <td>$category_title_cat</td>
                    <td>$post_status</td>
                    <td><img src='../images/$post_image' width='100'></td>
                    <td>$post_tags</td>
                    <td><a href='post_comments.php?id=$post_id'>$query_result_row</a></td>
                    <td>$post_date</td>
                    <td><a href='../post.php?post_id=$post_id'>$post_views_count</a></td>
                    <td><a class='btn btn-success' href='../post.php?post_id=$post_id'>View Post</a></td>
                    <td><a class='btn btn-info' href='posts.php?source=edit_post&edit_id=$post_id'>Edit</a></td>";
                // <td><a onClick = \"javascript: return confirm('Are you sure you want to delete'); \" href='posts.php?delete=$post_id'>Delete</a></td>
                echo "<td><a class='btn btn-danger' href='javascript:void(0)' rel='$post_id' class='delete_link'>Delete</a></td>";
                echo "</tr>";
            }
            if (isset($_GET['delete'])) {
                $post_id = $_GET['delete'];
                $query = "DELETE FROM posts WHERE post_id = {$post_id}";
                $result = mysqli_query($conn, $query);
                if (!$result) {
                    die("Record Not Deleted" . mysqli_error($conn));
                } else {
                    // header("Location : posts.php");
                }
            }
            ?>
        </tbody>
    </table>
</form>

<script>
    $(document).ready(function() {
        $(".delete_link").on("click", function() {
            var id = $(this).attr("rel");
            var delete_url = "posts.php?delete=" + id;
            $(".modal_delete_link").attr("href", delete_url);
            $("#myModal").modal("show");
        });
    });
</script>