 <div class="col-md-4">
     <!-- Blog Search Well -->
     <div class="well">
         <form action="search.php" method="POST">
             <h4>Blog Search</h4>
             <div class="input-group">
                 <input name="search" type="text" class="form-control">
                 <span class="input-group-btn">
                     <button name="submit" class="btn btn-default" type="submit">
                         <span class="glyphicon glyphicon-search"></span>
                     </button>
                 </span>
             </div>
         </form>
         <!-- /.input-group -->
     </div>
     <div class="well">
         <?php if (isset($_SESSION["user_role"])) : ?>
             <h3>Logged in as <?php echo $_SESSION["username"]; ?></h3>
             <a href="includes/logout.php" class="btn btn-primary">Logout</a>
         <?php else : ?>
             <h4>Login</h4>
             <form action="includes/login.php" method="POST">
                 <div class="form-group">
                     <input name="username" type="text" class="form-control" placeholder="Enter Username">
                 </div>
                 <div class="input-group">
                     <input name="password" type="password" class="form-control" placeholder="Enter Password">
                     <span class="input-group-btn">
                         <button type="submit" class="btn btn-primary" name="login">Submit</button>
                     </span>
                 </div>
             </form>
         <?php endif; ?>
     </div>


     <!-- /.input-group -->

     <!-- Blog Categories Well -->
     <div class="well">
         <h4>Blog Categories</h4>
         <div class="row">
             <div class="col-lg-12">
                 <ul class="list-unstyled">
                     <?php
                        $query = "SELECT * FROM categories";
                        $select_sidebar_categories_query = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_assoc($select_sidebar_categories_query)) {
                            $category_title = $row['category_title'];
                            $category_id = $row['category_id'];
                            echo "<li>
                                        <a href='category.php?category_id=$category_id'>$category_title</a>
                                    </li>";
                        }
                        ?>
                 </ul>
             </div>
             <!-- /.col-lg-6 -->
             <!--  -->
             <!-- /.col-lg-6 -->
         </div>
     </div>