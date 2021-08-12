<?php

if (isset($_GET["edit_id"])) {
    $edit_id = $_GET["edit_id"];
    $query = "SELECT * FROM posts WHERE post_id = $edit_id";
    $select_edit_posts_query = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($select_edit_posts_query)) {
        $post_id = $row['post_id'];
        $post_user = $row['post_user'];
        $post_title = $row['post_title'];
        $post_category_id = $row['post_category_id'];
        $post_status = $row['post_status'];
        $post_content = $row['post_content'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_comments = $row['post_comment'];
        $post_date = $row['post_date'];
    }
}






if (isset($_POST["update_post"])) {

    $post_user_update = $_POST["post_user"];
    $post_title_update = $_POST["post_title"];
    $post_category_id_update = $_POST["post_category"];
    $post_status_update = $_POST["post_status"];

    $post_image_update = $_FILES["image"]["name"];
    $post_image_temp_update = $_FILES["image"]["tmp_name"];

    $post_content_update = $_POST["post_content"];
    $post_tags_update = $_POST["post_tags"];

    move_uploaded_file($post_image_temp_update, "../images/$post_image_update");

    if (empty($post_image_update)) {
        $query = "SELECT * FROM posts WHERE post_id = {$edit_id}";
        $select_image_query = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($select_image_query)) {
            $post_image_update = $row['post_image'];
        }
    }

    $query_update = "UPDATE posts SET ";
    $query_update .= "post_title = '{$post_title_update}', ";
    $query_update .= "post_category_id = '{$post_category_id_update}', ";
    $query_update .= "post_date = now(), ";
    $query_update .= "post_user = '{$post_user_update}', ";
    $query_update .= "post_status = '{$post_status_update}', ";
    $query_update .= "post_tags = '{$post_tags_update}', ";
    $query_update .= "post_content = '{$post_content_update}', ";
    $query_update .= "post_image = '{$post_image_update}' ";
    $query_update .= "WHERE post_id = {$edit_id} ";


    $update_post = mysqli_query($conn, $query_update);

    if (!$update_post) {
        die("SQL Error" . mysqli_error($conn));
    }
    echo "<p class='bg-success'>Post Updated. <a href='../post.php?post_id={$edit_id}'>View Post</a> | <a href='posts.php'>Edit More Posts</a></p>";
}
?>




<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post Title</label>
        <input value="<?php echo $post_title ?>" type="text" name="post_title" class="form-control">
    </div>

    <div class="form-group">
        <label for="post_category">Select Category</label>
        <select name="post_category" id="">
            <?php
            $query = "SELECT * FROM categories ";
            $select_all_categories_query = mysqli_query($conn, $query);
            if (!$select_all_categories_query) {
                die("Not Executed" . mysqli_error($conn));
            }
            while ($row = mysqli_fetch_assoc($select_all_categories_query)) {
                $category_title = $row['category_title'];
                $category_id = $row['category_id'];
                $printthis = "<option value='$category_id'";
                if ($category_id == $post_category_id) {
                    $printthis .= " Selected";
                }
                $printthis .= ">$category_title</option>";
                echo $printthis;
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
                if ($post_user == $username) {
                    echo "<option value='$username' selected>$username</option>";
                }else {
                    echo "<option value='$username'>$username</option>";
                }
            }
            ?>
        </select>
    </div>

    <!-- <div class="form-group">
        <label for="author">Post Author</label>
        <input value="<?php// echo $post_author ?>" type="text" name="post_author" class="form-control">
    </div> -->

    <div class="form-group">
        <label for="post_status">Post Status</label>
        <select name="post_status" id="">
            <option value="<?php echo $post_status ?>"><?php echo $post_status ?></option>
            <?php
            if ($post_status === 'published') {
                echo "<option value= 'draft'>draft</option>";
            } else {
                echo "<option value= 'published'>published</option>";
            }
            ?>
        </select>
    </div>


    <!-- <div class="form-group">
        <label for="post_status">Post Status</label>
        <input value="<?php echo $post_status ?>" type="text" name="post_status" class="form-control">
    </div> -->

    <div class="form-group">
        <img width="60" src="../images/<?php echo $post_image; ?>" alt=""><br>
        <label for="post_image">Post Image</label>
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input value="<?php echo $post_tags ?>" type="text" name="post_tags" class="form-control">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea name="post_content" id="editor" class="form-control" cols="30" rows="10"><?php echo str_replace('\r\n','</br>',$post_content);  ?></textarea>
    </div>

    <div class="form-group">
        <input type="submit" value="Publish Post" class="btn btn-primary" name="update_post">
    </div>

</form>