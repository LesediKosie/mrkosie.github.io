<?php include('useable/menu.php'); ?>

<div class="menu-content">
    <div class="wrapper">
        <h1>Add Food</h1>

        <br>
        <br>
        <?php
        if (isset($_SESSION['add'])) //checking if its set or not
        {
            echo $_SESSION['add']; //displaying session
            unset($_SESSION['add']); //removing Session message
        }

        if (isset($_SESSION['upload'])) //checking if its set or not
        {
            echo $_SESSION['upload']; //displaying session
            unset($_SESSION['upload']); //removing Session message
        }
        ?>
        <br>
        <br>

        <!---Add form start--->

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>title</td>
                    <td>
                        <input type="text" name="title" placeholder="Food Title" required />
                    </td>
                </tr>
                <tr>
                    <td>description</td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Food description">   </textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td>
                        <input type="number" name="price" placeholder="Food price" required />
                    </td>

                <tr>
                    <td>image_name</td>
                    <td>
                        <input type="file" name="image_name" required />

                    </td>
                </tr>
                <tr>
                    <td>Category</td>
                    <td>
                        <select name="category_id">
                            <?php
                            //display category id from database
                            //create sql to get all active categories
                            $sql2 = "SELECT * FROM tbl_category WHERE active='Yes'";

                            //execute query
                            $res2 = mysqli_query($conn, $sql2);

                            //Count rows to check if categoies
                            $count = mysqli_num_rows($res2);


                            //if count is greater than 0, we have categories else we do not have them
                            if ($count > 0) {
                                //we have categories
                                while ($row = mysqli_fetch_assoc($res2)) {
                                    //get The title of category
                                    $id = $row['id'];
                                    $title = $row['title'];

                            ?>

                                    <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                <?php
                                }
                            } else {
                                //we don't have categories
                                ?>
                                <option value="0">Category not found</option>
                            <?php

                            }



                            //Display on Dropdown
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>featured</td>
                    <td>
                        <input type="radio" name="featured" value="Yes" required />Yes
                        <input type="radio" name="featured" value="No" required />No
                    </td>
                </tr>
                <tr>
                    <td>Active</td>
                    <td>
                        <input type="radio" name="active" value="Yes" required />Yes
                        <input type="radio" name="active" value="No" required />No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
            </table>
        </form>


        <!---Add form ends--->


        <?php
        //Process the value from form and save it in Database
        //Check whether the submit button is clicked

        if (isset($_POST['submit'])) {
            //Button clicked
            //echo "Button Clicked";

            //Create data from form


            //1. Get data from form
            $title = mysqli_real_escape_string($conn, $_POST['title']);
            $description = mysqli_real_escape_string($conn, $_POST['description']);
            $price = mysqli_real_escape_string($conn, $_POST['price']);
            $image_name = mysqli_real_escape_string($conn, $_POST['image_name']);
            $category_id = mysqli_real_escape_string($conn, $_POST['category_id']);


            // for radio input type, check if button is selected
            if (isset($_POST['featured'])) {
                //get value from for
                $featured = $_POST['featured'];
            } else {
                //set default value
                $featured = "No";
            }

            if (isset($_POST['active'])) {
                //get value from for
                $active = $_POST['active'];
            } else {
                //set default value
                $active = "No";
            }

            //check if the image is selected or  not and set the value for image name  accordingly
            //print_r($_FILES['image_name']);

            //die(); //break the code here

            if (isset($_FILES['image_name']['name'])) {
                //Upload the image
                // to upload image and image name, source path
                $image_name = $_FILES['image_name']['name'];

                //auto rename

                //get extention of our image png, jpg, jfif e.g


                $source_path = $_FILES['image_name']['tmp_name'];

                $destination_path = "images/food/" . $image_name;

                //upload image
                $upload = move_uploaded_file($source_path, $destination_path);

                // check if the image is uploaded or not
                //and if the image is not uploaded then stop the process and redirect with error
                if ($upload == false) {
                    //set message
                    $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                    //redirect to M-Category
                    header("location:" . SITEURL . 'M-food.php');
                    //top process
                    die();
                }
            } else {
                //don't upload the image and set image name value as blank
                $image_name = "";
            }








            //2. SQL Query to save the data into database
            //for number, do not need to add quotes
            $sql = "INSERT INTO tbl_food SET
            title ='$title',
            description ='$description',
            price =$price,
            featured='$featured',
            image_name='$image_name',
            category_id =$category_id,
            active='$active'
        ";

            //3.Executing Query and Saving data into database
            $res = mysqli_query($conn, $sql);

            //.4 check whether the (Query is executed) data is inserted or not and display appropriate message

            if ($res == true) {
                //Data Inserted
                //echo "Data Inserted";

                //create a session variable to display Message For matter
                $_SESSION['add'] = "<div class='success'>Food added successfully</div>";
                //redirect page to Manage Category
                header("location:" . SITEURL . 'M-food.php');
            } else {
                // Failed insert Data...
                //echo "Failed to Insert Data";

                //create a session variable to display Message For matter
                $_SESSION['add'] = "<div class='error'>Failed to add Food</div>";
                //redirect page to Manage category
                header('location:' . SITEURL . 'M-food.php');
            }
        }
        ?>

    </div>
</div>







<?php include('useable/footer.php');
