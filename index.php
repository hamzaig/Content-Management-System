<?php include "includes/header.php" ?>
<?php include "includes/db.php" ?>
<!-- Navigation -->
<?php include "includes/navigation.php" ?>
<!-- Page Content -->
<div class="container">
    <div class="row">
        <!-- Blog Entries Column -->
        <div class="col-md-8">
        <?php
            if (isset($_GET["page"])) {
                $page = $_GET["page"];
            } else {
                $page = "";
            }

            if ($page == "" || $page == 1) {
                $page_1 = 0;
            } else {
                $page_1 = ($page * 5) - 5;
            }



            $query = "SELECT * FROM posts WHERE post_status = 'published'";
            $count_all_posts_query = mysqli_query($conn, $query);
            $countss = mysqli_num_rows($count_all_posts_query);
            $published_posts_count = $countss;
            $countss = ceil($countss / 5);


            $query = "SELECT * FROM posts WHERE post_status = 'published' LIMIT $page_1,5";
            $select_all_posts_query = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_user'];
                $post_date = $row['post_date'];
                $post_status = $row['post_status'];
                $post_image = $row['post_image'];
                $post_content = substr($row['post_content'], 0, 150);
                $post_status = strtolower($post_status);
            ?>
                    <h1 class="page-header">
                        Page Heading
                        <small>Secondary Text</small>
                    </h1>
                    <!-- First Blog Post -->
                    <h2>
                        <a href="post.php?post_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
                    </h2>
                    <p class="lead">
                        by <a href="author_posts.php?author=<?php echo $post_author ?>&post_id=<?php echo $post_id ?>"><?php echo $post_author ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                    <hr>
                    <a href="post.php?post_id=<?php echo $post_id ?>">
                        <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                    </a>
                    <hr>
                    <p><?php echo $post_content ?></p>
                    <a class="btn btn-primary" href="post.php?post_id=<?php echo $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                    <hr>
            <?php
                }
                if ($published_posts_count < 1) {
                    echo "<h1 class='text-center'>There is no Post</h1>";
                }
            
           
            ?>
        </div>
        <?php include "includes/sidebar.php" ?>
        <?php include "includes/widget.php" ?>
    </div>
    <!-- Blog Sidebar Widgets Column -->
    <!-- /.row -->
    <!-- Side Widget Well -->
</div>
</div>
<!-- /.row -->
<hr>
<ul class="pager" >
    <?php

    for ($i = 1; $i <= $countss; $i++) {
        if ($i == $page) {
            echo "<li ><a style='background-color: burlywood;' href='index.php?page=$i'>$i</a></li>";
        } else {
            echo "<li ><a href='index.php?page=$i'>$i</a></li>";
        }
    }

    ?>
</ul>
<?php include "includes/footer.php" ?>
<!-- /.container -->
<!-- jQuery -->
<script src="js/jquery.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>