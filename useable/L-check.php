<?php
//check if user is logged in or not
//Authorization access control
if(!isset($_SESSION['username']))//if user session is not set
{
    //user is not logged in
    //redirect to login
    $_SESSION['no-login-message']= '<script type="text/javascript"> alert("Please login in to access admin panel")</script';
    //redirect
    header('location:' . SITEURL . 'login.php');

}

?>
