<?php

//include Constant file
include('../config/constants.php');

//1.get ID of admin tobe deleted
$id = $_GET['id'];

//2create SQL Query to delete admin
$sql = "DELETE FROM tbl_food WHERE id=$id";

//execute the query
$res = mysqli_query($conn, $sql);

//chec if the query executed successfully or not
if ($res == TRUE) {
    //Query executed successfully and  admin deleted

    //echo "Admin Deleted";
    //Create Session variable to display message
    $_SESSION['delete'] = "<div class='success'> Category Deleted Successfully</div>";
    //Redirec to Manage admin
    header('location:' . SITEURL . 'M-food.php');
} else {
    // Failed to delete admin
    //echo "Failed to delete Admin";

    //Create Session variable to display message
    $_SESSION['delete'] = "<div class='error'> Failed to delete Admin, try again later</div>";
    //Redirec to Manage admin
    header('location:' . SITEURL . 'M-food.php');
}
//echo "Delete";
//Check whether the id and image value is set or not
if (isset($_GET['id']) and isset($_GET['image_name'])) {
    //Get The value and Delete
    //echo get value and delete
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    //Remove the physical image file available
    if ($image_name != " ") {
        //Image is available, so remove it
        $path = "images/category/" . $image_name;

        //remove images
        $remove = unlink($path);
        // if fail to remove image then add error message
        if ($remove == false) {
            //Set the session message
            $_SESSION['remove'] = "<div class='error'>Failed to remove Food image</div>";
            //redrict to Manage category
            header('location:' . SITEURL . 'M-food.php');
            //Stop the process
            die();
        }
    }
    //Delete data from the database
    //SQL QUery Delete data from database
    $sql = "DELETE FROM tbl_food WHERE id=$id";

    //Query Execute
    $res = mysqli_query($conn, $sql);

    //Chec if the data is deleted from database or not
    if ($res == true) {
        //set Session message
        $_SESSION['delete'] = "<div class='success'>Food was successfully deleted</div>";
        header('location:' . SITEURL . 'M-food.php');
        //redirect to manage category
    } else {
        //Set session message
        $_SESSION['delete'] = "<div class='error'>Failed to delete Food</div>";
        header('location:' . SITEURL . 'M-food.php');
    }
} else {
    //redirect to category manager
    header('location:' . SITEURL . 'M-food.php');
}
