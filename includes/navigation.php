<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">CMS Front</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php
                $query = "SELECT * FROM categories";
                $select_all_categories_query = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($select_all_categories_query)) {
                    $category_title = $row['category_title'];
                    $category_id = $row['category_id'];

                    $category_class = "";
                    $registration_class = "";
                    $registration = 'registration.php';
                    $contact = 'contact_us.php';
                    $pageName = basename($_SERVER['PHP_SELF']);
                    if (isset($_GET["category_id"]) && $_GET["category_id"] == $category_id) {
                        $category_class = "darkorange";
                    } elseif ($pageName == $registration) {
                        $registration_class = "darkorange";
                    } elseif ($pageName == $contact) {
                        $contact_class = "darkorange";
                    }






                    echo "<li>
                        <a style='color: $category_class;' href='category.php?category_id=$category_id'>$category_title</a>
                    </li>";
                }
                ?>

                <?php
                session_start();
                if (isset($_SESSION["user_role"])) {
                    echo '<li style="font-weight: bold; color: white;">
                            <a  href="admin">Admin</a>
                        </li>';
                }
                ?>


                <?php
                if (isset($_SESSION["user_role"])) {
                    if (isset($_GET["post_id"])) {
                        $p_id = $_GET["post_id"];
                        echo "<li style='font-weight: bold; color: white;'><a href='admin/posts.php?source=edit_post&edit_id=$p_id'>Edit Post</a></li>";
                    }
                }
                ?>
                <li style="font-weight: bold; color: white; ">
                    <a style="color: <?php echo $registration_class ?>; " href="registration.php">Register</a>
                </li>
                <li style="font-weight: bold; color: white;">
                    <a style="color: <?php echo $contact_class ?>; " href="contact_us.php">Contact</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>