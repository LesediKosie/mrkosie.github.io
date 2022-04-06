<?php include('useable/menu.php'); ?>

<div class="menu-content">
    <div class="wrapper">
        <h1>change Admin password</h1>

        <br>
        <br>

        <?php
        //1. get id of selected Admin
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }







        ?>


        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Old Password</td>
                    <td><input type="password" name="old_password" placeholder="Enter your current password"></td>

                </tr>
                <tr>
                    <td>New Password</td>
                    <td><input type="password" name="new_password" placeholder="Enter your new password"></td>

                </tr>
                <tr>
                    <td>Confirm Password</td>
                    <td><input type="password" name="confirm_password" placeholder="Confirm password"></td>

                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>


            </table>



        </form>
    </div>
</div>


<?php

//check if the update is clicked or not
if (isset($_POST['submit'])) {
    // echo "Update clicked";

    //get all the values from form to update
    echo $id = mysqli_real_escape_string($conn, $_POST['id']);
    $old_password = mysqli_real_escape_string($conn, md5($_POST['old_password']));
    $new_password = mysqli_real_escape_string($conn, md5($_POST['new_password']));
    $confirm_password = mysqli_real_escape_string($conn, md5($_POST['confirm_password']));

    //check if the user with the old password exist or not

    $sql = "SELECT * FROM tbl_admin WHERE id= $id AND password='$old_password'
    ";

    //Execute  the query
    $res = mysqli_query($conn, $sql);
    //check whether the query is executed available or not
    if ($res == TRUE) {
        $count = mysqli_num_rows($res);

        if ($count == 1) {
            //user exist and password can be changed
            //echo "User Found";


            if ($new_password == $confirm_password) {
                //Update the Password

                $sql2 = "UPDATE tbl_admin SET
                password='$new_password'
                WHERE id=$id
                ";


                //execute query
                $res2 = mysqli_query($conn, $sql2);

                //check whether the query execute or not

                if ($res2 == TRUE) {
                    //Display message

                    //Redirect to manager with success message
                    $_SESSION['change-pwd'] = "<div class='success'>Password changed successfully</div>";

                    //Redirect the user
                    header("location:" . SITEURL . 'manage.php');
                } else {
                    //Display error message
                    $_SESSION['change-pwd'] = "<div class='error'>Failed to change password</div>";

                    //Redirect the user
                    header("location:" . SITEURL . 'manage.php');
                }
            } else {

                //Redirect to manager with error message
                $_SESSION['pwd-not-match'] = "<div class='error'>Password does not match</div>";

                //Redirect the user
                header("location:" . SITEURL . 'manage.php');
            }
        } else {
            //check if user does not exist and password cannot be changed
            $_SESSION['user-Not-Found'] = "<div class='error'>User Not Found</div>";

            //Redirect the user
            header("location:" . SITEURL . 'manage.php');
        }
    }
}
?>

<?php include('useable/footer.php'); ?>