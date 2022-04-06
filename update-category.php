<?php include('useable/menu.php'); ?>


<?php

//check if id is set
if (isset($_GET['id'])) {
    //Get the ID and all other details
    //echo "Getting the data";
    $id = $_GET['id'];
    //Create SQL Query to get all other details
    $sql = "SELECT * FROM tbl_category WHERE id=$id";

    // Execute Query
    $res = mysqli_query($conn, $sql);

    //Count rows to check if the id is valid or not
    $count = mysqli_num_rows($res);

    if ($count == 1) {
        //Get all Data
        $row = mysqli_fetch_assoc($res);
        $title = $row['title'];
        $current_image = $row['image_name'];
        $featured = $row['featured'];
        $active = $row['active'];
    } else {
        $_SESSION['No-category-food'] = "<div class='error'>Category not found</div>";
        //Redirect to M category
        header("location:" . SITEURL . 'M-category.php');
    }
} else {
    //redirect to category
    header("location:" . SITEURL . 'M-category.php');
}
?>



<div class="menu-content">
    <div class="wrapper">
        <h1>Update Category</h1>

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
                    <td>Current Image</td>
                    <td>
                        <?php
                        if ($current_image != " ") {
                            //display image
                        ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="100px" ; <?php

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
            $current_name =  mysqli_real_escape_string($conn, $_POST['current_image']);
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

                    $destination_path = "images/category/" . $image_name;

                    //upload image
                    $upload = move_uploaded_file($source_path, $destination_path);

                    // check if the image is uploaded or not
                    //and if the image is not uploaded then stop the process and redirect with error
                    if ($upload == false) {
                        //set message
                        $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                        //redirect to M-Category
                        header("location:" . SITEURL . 'M-category.php');
                        //stop process
                        die();
                    }
                    //remove the current image if available
                    if ($current_image != "") {
                        $remove_path = "images/category/" . $current_image;

                        $remove = unlink($remove_path);

                        //check if the image is removed or not

                        //if removed display message and stop process
                        if ($remove == false) {
                            //failed to remove image
                            $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current image</div>";
                            header("location:" . SITEURL . 'M-category.php');
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
            $sql2 = "UPDATE tbl_category SET
            title= '$title',
            featured='$featured',
            image_name='$image_name',
            active='$active'
            WHERE id='$id'
            ";

            //execute query

            $res2 = mysqli_query($conn, $sql2);

            //4. redirect to M category
            //check if the executed or not
            if ($res2 == true) {
                //category
                $_SESSION['update'] = "<div class='success'>category successfully updated</div>";
                //redirect to M category
                header("location:" . SITEURL . 'M-category.php');
            } else {
                //failed to update category
                $_SESSION['update'] = "<div class='error>Failed to update category</div>";
                //redirect to M Category
                header("location:" . SITEURL . 'M-category.php');
            }
        }
        ?>

    </div>
</div>
<?php include('useable/footer.php'); ?>