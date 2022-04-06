<?php include('useable/menu.php'); ?>

<body>

    </div>
    <!--Menu Section ends-->


    <!--Menu Section start-->
    <div class="menu-content">
        <div class="wrapper">
            <h1>Manage Food</h1>
            <br>
            <br>

            <?php
            if (isset($_SESSION['add'])) {
                echo $_SESSION['add']; //displaying session
                unset($_SESSION['add']); //removing Session message
            }

            if (isset($_SESSION['delete'])) {
                echo $_SESSION['delete']; //displaying session
                unset($_SESSION['delete']); //removing Session message
            }
            if (isset($_SESSION['remove'])) {
                echo $_SESSION['remove']; //displaying session
                unset($_SESSION['remove']); //removing Session message
            }

            if (isset($_SESSION['update'])) {
                echo $_SESSION['update']; //displaying session
                unset($_SESSION['update']); //removing Session message
            }

            if (isset($_SESSION['upload'])) {
                echo $_SESSION['upload']; //displaying session
                unset($_SESSION['upload']); //removing Session message

            }

            if (isset($_SESSION['failed-remove'])) {
                echo $_SESSION['failed-remove']; //displaying session
                unset($_SESSION['failed-remove']); //removing Session message
            }
            if (isset($_SESSION['pwd-not-match'])) {
                echo $_SESSION['pwd-not-match']; //displaying session
                unset($_SESSION['pwd-not-match']); //removing Session message
            }


            ?>
            <br>
            <br>


            <!--Button to add admin-->
            <a href="add-food.php" class="btn-primary">Add Food</a>
            <br>
            <br>
            <br>
            <br>
            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>title</th>
                    <th>description</th>
                    <th>price</th>
                    <th>image_name</th>
                    <th>featured</th>
                    <th>active</th>
                    <th>Actions</th>
                </tr>

                <?php
                //Query to get all admin
                $sql = "SELECT * FROM tbl_food";
                //execute the query
                $res = mysqli_query($conn, $sql);

                //check if the query is executed

                if ($res == TRUE) {
                    //count rows to check if we have data inside the database
                    $count = mysqli_num_rows($res); //Function to get all the rows

                    $sn = 1; //create a variable and assign the value

                    //check the numbers of rows
                    if ($count > 0) {
                        //we have database
                        while ($rows = mysqli_fetch_assoc($res)) {
                            //to get all data from database
                            //will run as long as we have database
                            //get individual database
                            $id = $rows['id'];
                            $title = $rows['title'];
                            $description = $rows['description'];
                            $price = $rows['price'];
                            $image_name = $rows['image_name'];
                            $category_id = $rows['category_id'];
                            $featured = $rows['featured'];
                            $active = $rows['active'];

                            //display the values in our mysql_list_tables
                ?>

                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $title; ?></td>
                                <td><?php echo $description; ?></td>
                                <td>R<?php echo $price; ?></td>


                                <td>

                                    <?php
                                    if ($image_name != "") {
                                        //display image
                                    ?>
                                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="80px">
                                    <?php
                                    } else {
                                        //Display Message
                                        echo "<div class='error'>Image not added</div>";
                                    }
                                    ?>
                                </td>
                                <td><?php echo $featured; ?></td>



                                <td><?php echo $active; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>update-food.php?id= <?php echo $id; ?>" class="btn-secondary">Update</a>

                                    <a href="<?php echo SITEURL; ?>useable/delete-food.php?id= <?php echo $id; ?>" class="btn-danger">Delete</a>
                                </td>
                            </tr>

                <?php
                        }
                    } else {
                        //we don't have any data inside the database
                        echo "<tr> <td colspan='7' class='error> Food not added yet</td></tr>";
                    }
                }
                ?>





            </table>






        </div>

    </div>
</body>

<!--Menu Section ends-->


<?php include('useable/footer.php'); ?>