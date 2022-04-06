<?php
        if (isset($_POST['submit'])) {
            //echo "clicked";
            //get all the values from our form
            $id = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $current_image =  $_POST['current_image'];
            $category_id = $_POST['category_id'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];


            //2.updating new image
            //check if the image is selected or not
            if (isset($_FILES['image_name']['name'])) {
                //get image details
                $image_name = $_FILES['image_name']['name'];

                //check if image is available or not
                if ($image_name != "") {
                    //image available
                    //upload the new image
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
                        //stop process
                        die();
                    }
                    //remove the current image if available
                    if ($current_image != "") {
                        $remove_path = "images/food/" . $current_image;

                        $remove = unlink($remove_path);

                        //check if the image is removed or not

                        //if removed display message and stop process
                        if ($remove == false) {
                            //failed to remove image
                            $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current image</div>";
                            header("location:" . SITEURL . 'M-food.php');
                            die();
                        }
                    }
                } else {
                    $image_name = $current_image;
                }
            } else {
                $image_name = $current_image;
            }




            //.update database
            $sql2 = "UPDATE tbl_food SET
            title= '$title',
            description= '$description',
            price=$price,
            image_name='$image_name',
            featured='$featured',
            category_id='$category_id',
            active='$active'
            WHERE id='$id'
            ";

            //execute query

            $res2 = mysqli_query($conn, $sql2);

            //4. redirect to M category
            //check if the executed or not
            if ($res2 == true) {
                //category
                $_SESSION['update'] = "<div class='success'>food successfully updated</div>";
                //redirect to M category
                header("location:" . SITEURL . 'M-food.php');
            } else {
                //failed to update category
                $_SESSION['update'] = "<div class='error>Failed to update food</div>";
                //redirect to M Category
                header("location:" . SITEURL . 'M-food.php');
            }
        }
        ?>