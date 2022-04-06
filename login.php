<?php include('config/constants.php'); ?>

<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>

<body style="background-color:#000000">
    <div id="main-wrapper">
        <center>
            <?php

            if (isset($_SESSION['no-login-message'])) {
                echo $_SESSION['no-login-message']; //displaying session
                unset($_SESSION['no-login-message']); //removing Session message
            }
            ?>



            <h2>Login</h2>
            <img src="images/menu-burger.jpg" class="cute" />
        </center>
        <form class="myform" action="login.php" method="post">
            <label>Username:</b></label><br>
            <input name="username" type="text" class="inputvalues" placeholder="Type in your username" required />
            <br>
            <label> Password:</b></label><br>
            <input name="password" type="password" class="inputvalues" placeholder="Type in your password" required /><br>
            <input name="login" type="submit" id="login_btn" value="Login"> <span id="c1" class="glyphicon glyphicon-user"></span></input><br>
            <p class="text-center">Developed by <a href="#">Lesedi Kosie - Green Forest Media</p>
        </form>
        <?php
        if (isset($_POST['login'])) {
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $password = mysqli_real_escape_string($conn, md5($_POST['password']));

            $query = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

            $query_run = mysqli_query($conn, $query);
            if (mysqli_num_rows($query_run) > 0) {
                $_SESSION['username'] = $username;
                $_SESSION['password'] = $password; //to check if user is logged in or not
                $_SESSION['login'] = "<div class='success text-center'>Logged in Successful</div>";




                //redirect
                header('location:' . SITEURL . 'Admin-index.php');
            } else {
                echo '<script type="text/javascript"> alert("Incorrect username and password")</script';
            }
        }
        ?>

    </div>
    <script src="validate_function.js"></script>
</body>

</html>