
<?php
include('config/constants.php');
//dEstroy session
SESSION_destroy();


//redirect to login
header('location:' . SITEURL . 'login.php');
?>