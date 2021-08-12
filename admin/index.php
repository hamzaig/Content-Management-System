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
                        <small><?php echo $_SESSION["username"]; ?></small>
                    </h1>

                </div>
            </div>
            <!-- /.row -->


            <!-- /.row -->

            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-5x"></i>
                                </div>
                                <?php
                                $post_count_query = "SELECT * FROM posts";
                                $post_count_query_result = mysqli_query($conn, $post_count_query);
                                $post_count = mysqli_num_rows($post_count_query_result);
                                ?>
                                <div class="col-xs-9 text-right">
                                    <div class='huge'><?php echo $post_count; ?></div>
                                    <div>Posts</div>
                                </div>
                            </div>
                        </div>
                        <a href="posts.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <?php
                                $comments_count_query = "SELECT * FROM comments";
                                $comments_count_query_result = mysqli_query($conn, $comments_count_query);
                                $comments_count = mysqli_num_rows($comments_count_query_result);
                                ?>
                                <div class="col-xs-9 text-right">
                                    <div class='huge'><?php echo $comments_count; ?></div>
                                    <div>Comments</div>
                                </div>
                            </div>
                        </div>
                        <a href="comments.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                    $users_count_query = "SELECT * FROM users";
                                    $users_count_query_result = mysqli_query($conn, $users_count_query);
                                    $users_count = mysqli_num_rows($users_count_query_result);
                                    ?>
                                    <div class='huge'><?php echo $users_count; ?></div>
                                    <div> Users</div>
                                </div>
                            </div>
                        </div>
                        <a href="users.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-list fa-5x"></i>
                                </div>
                                <?php
                                $categories_count_query = "SELECT * FROM categories";
                                $categories_count_query_result = mysqli_query($conn, $categories_count_query);
                                $categories_count = mysqli_num_rows($categories_count_query_result);
                                ?>
                                <div class="col-xs-9 text-right">
                                    <div class='huge'><?php echo $categories_count; ?></div>
                                    <div>Categories</div>
                                </div>
                            </div>
                        </div>
                        <a href="categories.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <?php
            $publish_posts_count_query = "SELECT * FROM posts WHERE post_status = 'published' ";
            $publish_posts_count_query_result = mysqli_query($conn, $publish_posts_count_query);
            $publish_posts_count = mysqli_num_rows($publish_posts_count_query_result);

            $draft_posts_count_query = "SELECT * FROM posts WHERE post_status = 'draft' ";
            $draft_posts_count_query_result = mysqli_query($conn, $draft_posts_count_query);
            $draft_posts_count = mysqli_num_rows($draft_posts_count_query_result);

            $unaproved_comments_count_query = "SELECT * FROM comments WHERE comment_status = 'unapproved' ";
            $unaproved_comments_count_query_result = mysqli_query($conn, $unaproved_comments_count_query);
            $unaproved_comments_count = mysqli_num_rows($unaproved_comments_count_query_result);

            $subscriber_count_query = "SELECT * FROM users WHERE user_role = 'subscriber' ";
            $subscriber_count_query_result = mysqli_query($conn, $subscriber_count_query);
            $subscriber_count = mysqli_num_rows($subscriber_count_query_result);
            ?>

            <div class="row">
                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                <script type="text/javascript">
                    google.charts.load('current', {
                        'packages': ['bar']
                    });
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Data', 'Count'],
                            ['All Posts', <?php echo $post_count; ?>],
                            ['Active Posts', <?php echo $publish_posts_count; ?>],
                            ['Draft Posts', <?php echo $draft_posts_count; ?>],
                            ['Comments', <?php echo $comments_count; ?>],
                            ['Pending Comments', <?php echo $unaproved_comments_count; ?>],
                            ['Users', <?php echo $users_count; ?>],
                            ['Subscriber', <?php echo $subscriber_count; ?>],
                            ['Categories', <?php echo $categories_count; ?>]
                        ]);

                        var options = {
                            chart: {
                                title: '',
                                subtitle: '',
                            }
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                </script>
                <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
            </div>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php include "includes/admin_footer.php" ?>