<?php include('useable/menu.php'); ?>


<?php

//check if id is set
if (isset($_GET['id'])) {
    //Get the ID and all other details
    //echo "Getting the data";
    $id = $_GET['id'];
    //Create SQL Query to get all other details
    $sql = "SELECT * FROM tbl_food WHERE id=$id";

    // Execute Query
    $res = mysqli_query($conn, $sql);

    //Count rows to check if the id is valid or not
    $count = mysqli_num_rows($res);

    if ($count == 1) {
        //Get all Data
        $row = mysqli_fetch_assoc($res);
        $title = $row['title'];
        $description = $row['description'];
        $price = $row['price'];
        $current_image = $row['image_name'];
        $current_category = $row['category_id'];
        $featured = $row['featured'];
        $active = $row['active'];
    } else {
        $_SESSION['No-category-food'] = "<div class='error'>Food not found</div>";
        //Redirect to M category
        header("location:" . SITEURL . 'M-food.php');
    }
} else {
    //redirect to category
    header("location:" . SITEURL . 'M-food.php');
}
?>



<div class="menu-content">
    <div class="wrapper">
        <h1>Update Food</h1>

        <br>
        <br>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>title</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title ?>" />
                    </td>
                </tr>


                <tr>
                    <td>description</td>
                    <td>
                        <textarea name="description" cols="30" rows="5"><?php echo $description ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>price</td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price ?>" />
                    </td>
                </tr>


                <tr>
                    <td>Current Image</td>
                    <td>
                        <?php
                        if ($current_image != " ") {
                            //display image
                        ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="100px" ; <?php

                                                                                                                    } else {
                                                                                                                        //display noting
                                                                                                                        echo "<div class'error'>Image not added</div>";
                                                                                                                    }
                                                                                                                        ?> </td>
                </tr>
                <tr>
                    <td>New image</td>
                    <td>
                        <input type="file" name="image_name" />

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
                            $count2 = mysqli_num_rows($res2);


                            //if count is greater than 0, we have categories else we do not have them
                            if ($count2 > 0) {
                                //we have categories
                                while ($row2 = mysqli_fetch_assoc($res2)) {
                                    //get The title of category
                                    $category_id = $row2['id'];
                                    $category_title = $row2['title'];

                            ?>

                                    <option <?php if ($current_category == $category_id) {
                                                echo "Selected";
                                            } ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                <?php
                                }
                            } else {
                                //we don't have categories
                                ?>
                                <option value="0">No category not found</option>
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
                        <input <?php if ($featured == "Yes") {
                                    echo "checked";
                                } ?> type="radio" name="featured" value="Yes" />Yes
                        <input <?php if ($featured == "No") {
                                    echo "checked";
                                } ?> type="radio" name="featured" value="No" />No
                    </td>
                </tr>
                <tr>
                    <td>Active</td>
                    <td>
                        <input <?php if ($active == "Yes") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="Yes" />Yes
                        <input <?php if ($active == "No") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="No" />No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
            </table>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            //echo "clicked";
            //get all the values from our form
            $id = mysqli_real_escape_string($conn, $_POST['id']);
            $title = mysqli_real_escape_string($conn, $_POST['title']);
            $description = mysqli_real_escape_string($conn, $_POST['description']);
            $price = mysqli_real_escape_string($conn, $_POST['price']);
            $current_name = mysqli_real_escape_string($conn, $_POST['current_image']);
            $category_id = mysqli_real_escape_string($conn, $_POST['category_id']);
            $featured = mysqli_real_escape_string($conn, $_POST['featured']);
            $active = mysqli_real_escape_string($conn, $_POST['active']);


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
            $sql3 = "UPDATE tbl_food SET
            title= '$title',
            description= '$description',
            price=$price,
            featured='$featured',
            image_name='$image_name',
            category_id='$category_id',
            active='$active'
            WHERE id='$id'
            ";

            //execute query

            $res3 = mysqli_query($conn, $sql3);

            //4. redirect to M category
            //check if the executed or not
            if ($res3 == TRUE) {
                //category
                $_SESSION['update'] = "<div class='success'>food successfully updated</div>";
                //redirect to M category
                header("location:" . SITEURL . 'M-food.php');
            } else {
                //failed to update category
                $_SESSION['update'] = "<div class='error'>Failed to update food</div>";
                //redirect to M Category
                header("location:" . SITEURL . 'M-food.php');
            }
        }
        ?>

    </div>
</div>
<?php include('useable/footer.php'); ?>