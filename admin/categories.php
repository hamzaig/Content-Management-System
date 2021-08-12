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

                        <div class="col-xs-6">
                            <?php
                            
                            if(isset($_POST['submit'])){
                                $category_title = $_POST['category_title'];
                                if ($category_title === "" || empty($category_title)) {
                                    echo "This Field Shold Not be Empty";
                                }else {
                                    $query = "INSERT INTO categories(category_title) VALUE('{$category_title}')";
                                    $create_category_query = mysqli_query($conn,$query);
                                    if (!$create_category_query) {
                                        die("QUERY FAILED".mysqli_error($conn));
                                    }
                                }
                            }
                            
                            
                            ?>
                            <form action="" method="POST">
                                <h1>Add Category</h1>
                                <div class="form-group">
                                    <label for="category-title">Category Title</label>
                                    <input type="text" name="category_title" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="submit"  name="submit" class="btn btn-primary" value="Add Category">
                                </div>
                            </form>

                                

                                <?php
                                    
                                
                                    if (isset($_GET['update'])) {
                                        $update_category_id = $_GET['update'];
                                        $query = "SELECT category_title FROM categories WHERE category_id = $update_category_id";
                                        $update_title_retrive = mysqli_query($conn, $query);
                                        while ($row = mysqli_fetch_assoc($update_title_retrive)) {
                                            $category_title = $row['category_title'];
                                        }
                                        
                                        if (isset($_POST['category_title'])) {
                                        $update_category_title = $_POST['category_title'];
                                        $query = "UPDATE categories SET category_title = '$update_category_title' WHERE category_id = $update_category_id";
                                        $update = mysqli_query($conn, $query);
                                        }
                            
                                    echo '<form action="" method="POST">';
                                      echo '<h1>Update Category</h1>';
                                      echo  '<div class="form-group">';
                                      echo  '<input value="'.$category_title.'" type="text" name="category_title" class="form-control">';
                                      echo '</div>
                                            <div class="form-group">
                                                <input type="submit"  name="update_category" class="btn btn-primary" value="Update Category">
                                                </div>
                                            </form>';
                                      
                                    }
                                
                                ?>



                                    
                                
                        </div>

                        <div class="col-xs-6">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category Title</th>
                                        <th>Delete</th>
                                        <th>Update</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <?php
                                    $query = "SELECT * FROM categories";
                                    $select_all_categories_query = mysqli_query($conn, $query);
                                    while ($row = mysqli_fetch_assoc($select_all_categories_query)) {
                                        $category_id = $row['category_id'];
                                        $category_title = $row['category_title'];
                                        echo "<tr>
                                                <td>$category_id</td>
                                                <td>$category_title</td>
                                                <td><a href='categories.php?delete=$category_id'>Delete</a></td>
                                                <td><a href='categories.php?update=$category_id'>Update</a></td>
                                              </tr>";
                                    }
                                  ?>          
                                </tbody>
                            </table>
                        </div>

                        <?php
                            
                            if(isset($_GET['delete'])){
                                $category_id_delete = $_GET['delete'];
                                $query = "DELETE FROM categories WHERE category_id = {$category_id_delete}";
                                $delete_category_query = mysqli_query($conn,$query);
                                    if (!$delete_category_query) {
                                        die("QUERY FAILED".mysqli_error($conn));
                                    }else {
                                        header("Location: categories.php");
                                    }
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