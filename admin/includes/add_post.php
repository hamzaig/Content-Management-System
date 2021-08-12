<?php
if (isset($_POST["create_post"])) {

    $post_category_id = $_POST['post_category_id'];
    $post_title = $_POST['post_title'];
    $post_user = $_POST['post_user'];
    $post_status = $_POST['post_status'];
    $post_date = date('d-m-y');

    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];

    $post_content = $_POST['post_content'];
    $post_tags = $_POST['post_tags'];
    $post_comment_count = 0;
    $post_view_count = 0;
    $post_comment = "Commentsssss";


    move_uploaded_file($post_image_temp, "../images/$post_image");

    $query = "INSERT INTO posts(post_category_id,post_title,post_status,post_user,post_date,post_image,post_content,post_tags,post_comment_count,post_views_count,post_comment) ";
    $query .= "VALUES({$post_category_id},'{$post_title}','{$post_status}','{$post_user}',now(),'{$post_image}','{$post_content}','{$post_tags}',{$post_comment_count},{$post_view_count},'{$post_comment}')";

    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Not Executed" . mysqli_error($conn));
    }
    $edit_id = mysqli_insert_id($conn);
    echo "<p class='bg-success'>Post Created. <a href='../post.php?post_id={$edit_id}'>View Post</a> | <a href='posts.php'>Edit More Posts</a></p>";
}

?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" name="post_title" class="form-control">
    </div>


    <div class="form-group">
        <label for="post_category">Select Category</label>
        <select name="post_category_id" id="">
            <?php
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
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="users_category">Select Users</label>
        <select name="post_user" id="">
            <?php
            $query = "SELECT * FROM users ";
            $select_all_users_query = mysqli_query($conn, $query);
            if (!$select_all_categories_query) {
                die("Not Executed" . mysqli_error($conn));
            }
            while ($row = mysqli_fetch_assoc($select_all_users_query)) {
                $username = $row['username'];
                $user_id = $row['user_id'];
                echo "<option value='$username'>$username</option>";
            }
            ?>
        </select>
    </div>


    <!-- <div class="form-group">
        <label for="author">Post Author</label>
        <input type="text" name="post_author" class="form-control">
    </div> -->

    <div class="form-group">
        <label for="users_category">Select Status</label>
        <select name="post_status" id="">
            <option value="draft">Select Status</option>
            <option value="published">Publish</option>
            <option value="draft">Draft</option>
        </select>
    </div>

    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" name="post_tags" class="form-control">
    </div>

    <div class="form-group" id="">
        <label for="post_content">Post Content</label>
        <textarea name="post_content" id="editor" class="form-control" cols="30" rows="10"></textarea>
    </div>



    <div class="form-group">
        <input type="submit" value="Publish Post" class="btn btn-primary" name="create_post">
    </div>

</form>