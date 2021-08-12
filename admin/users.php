<?php include "includes/admin_header.php" ?>
<?php 

    if (!is_admin($_SESSION['username'])) {
        header("Location: index.php");
    }

?>
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
                    <?php
                    if(isset($_GET['source'])){
                        if($_GET['source']==='add_user'){
                            include "includes/add_user.php";
                        }
                        else if($_GET['source']==='edit_user'){
                            include "includes/edit_user.php";
                        }
                        else {
                            include "includes/view_all_users.php";
                        }
                    }else {
                            include "includes/view_all_users.php";
                        }
                    ?>
                        







                        
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