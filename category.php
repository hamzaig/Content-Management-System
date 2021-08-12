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
            if (isset($_GET["category_id"])) {
                $post_category_id = $_GET["category_id"];
            


            $query = "SELECT * FROM posts WHERE post_category_id = $post_category_id AND post_status = 'published'";
            $select_all_posts_query = mysqli_query($conn, $query);
            if (mysqli_num_rows($select_all_posts_query) < 1) {
               echo "<h1 class='text-center'>There is no Post</h1>";
            }
            while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = substr($row['post_content'], 0, 150);

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
                    by <a href="index.php"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>


            <?php 
            }
            }else {
                header("Location: index.php");
            } 
            ?>
        </div>
        <?php include "includes/sidebar.php" ?>
        <?php include "includes/widget.php" ?>
    </div>
</div>

<!-- Blog Sidebar Widgets Column -->
<!-- /.row -->
</div>

<!-- Side Widget Well -->


</div>



<hr>

<?php include "includes/footer.php" ?>