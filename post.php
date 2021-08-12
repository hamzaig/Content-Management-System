<?php include "includes/header.php" ?>
<?php include "includes/db.php" ?>
<!-- Navigation -->
<?php include "includes/navigation.php" ?>
<!-- Page Content -->
<div class="container">
    <div class="row">
        <?php
            if (isset($_GET["post_id"])) {
                $post_id_this = $_GET["post_id"];
            } else {
                header("Location: index.php");
            }
        ?>
        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <?php
            
            $query = "UPDATE posts SET post_views_count	= post_views_count + 1 WHERE post_id = $post_id_this";
            $view_posts_query = mysqli_query($conn, $query);
            if (!$view_posts_query) {
                die("Query is not executed".mysqli_error($conn));
            }

            $query = "SELECT * FROM posts WHERE post_id = $post_id_this";
            $select_all_posts_query = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];
            ?>
                <h1 class="page-header">
                    Post
                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>
                <hr>
            <?php }
            ?>
            <!-- Blog Comments -->
            <!-- Comments Form -->
            <?php
            if (isset($_POST["create_comment"])) {
                $comment_post_id = $_GET["post_id"];
                $comment_author = $_POST["comment_author"];
                $comment_email = $_POST["comment_email"];
                $comment_content = $_POST["comment_content"];
                
                if (!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {
                    $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) VALUES ( $comment_post_id, '$comment_author', '$comment_email', '$comment_content', 'Unapproved', now())";
                    $result = mysqli_query($conn, $query);
                    if (!$result) {
                        die("Query Not Executed" . mysqli_error($conn));
                    }
                }else {
                    echo '<script>alert("Please Fill All Fields")</script>';
                }
                
            }
            ?>
            <div class="well">
                <h4>Leave a Comment:</h4>
                <form role="form" method="POST" action="">
                    <div class="form-group">
                        <label for="author">Author</label>
                        <input type="text" name="comment_author" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="comment_email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="comment">Your Comment</label>
                        <textarea name="comment_content" class="form-control" rows="3"></textarea>
                    </div>
                    <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <hr>
            <!-- Posted Comments -->
            <?php
            $show_comments_query = "SELECT * FROM comments WHERE comment_post_id = $post_id_this AND comment_status = 'approved' ORDER BY comment_id DESC";
            $result_show_comments_query = mysqli_query($conn, $show_comments_query);
            if (!$result_show_comments_query) {
                die("Query Not Executed" . mysqli_error($conn));
            } else {
                while ($row_result_show_comments_query = mysqli_fetch_array($result_show_comments_query)) {
                    $comment_date = $row_result_show_comments_query["comment_date"];
                    $comment_content = $row_result_show_comments_query["comment_content"];
                    $comment_author = $row_result_show_comments_query["comment_author"];
            ?>
                    <!-- Comment -->
                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="http://placehold.it/64x64" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading"><?php echo $comment_author; ?>
                                <small><?php echo $comment_date; ?></small>
                            </h4>
                            <?php echo $comment_content; ?>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
            
        </div>
        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php" ?>
        <!-- /.row -->
        <?php include "includes/widget.php" ?>
    </div>
    <!-- Side Widget Well -->
</div>



<!-- /.row -->
<hr>
<?php include "includes/footer.php" ?>