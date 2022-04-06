<?php

    //include constants.php file here
    include('../config/constants.php');
    //1.get ID of admin tobe deleted
    $id = $_GET['id'];

    //2create SQL Query to delete admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    //execute the query
    $res = mysqli_query($conn, $sql);

    //chec if the query executed successfully or not
    if($res==TRUE){
      //Query executed successfully and  admin deleted

      //echo "Admin Deleted";
      //Create Session variable to display message
      $_SESSION['delete'] = "<div class='success'> Admin Deleted Successfully</div>";
      //Redirec to Manage admin
      header('location:'.SITEURL.'manage.php');

    }
    else {
      // Failed to delete admin
      //echo "Failed to delete Admin";

      //Create Session variable to display message
      $_SESSION['delete'] = "<div class='error'> Failed to delete Admin, try again later</div>";
      //Redirec to Manage admin
      header('location:'.SITEURL.'manage.php');
    }

    //3.Redirect to Manage page with message
 ?>
