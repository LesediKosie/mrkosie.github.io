<?php include('useable/menu.php'); ?>

<div class="menu-content">
    <div class="wrapper">
        <h1>Update Admin</h1>

        <br>
        <br>

        <?php
        //1. get id of selected Admin

        $id = $_GET['id'];

        //2. Create SQL Query to get Data

        $sql = "SELECT * FROM tbl_admin WHERE id=$id";

        //execute the query
        $res = mysqli_query($conn, $sql);

        //check if query is executed or not
        if ($res == TRUE) {
            // check whether data is available or not
            $count = mysqli_num_rows($res);
            //check whether  we have admin data or not

            if ($count == 1) {
                //get the details
                //echo "Admin available";
                $row = mysqli_fetch_assoc($res);

                $full_name = $row['full_name'];
                $username = $row['username'];
            } else {
                //redirect to Manage Admin page
                header('location:' . SITEURL . 'manage.php');
            }
        }


        ?>


        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full name</td>
                    <td><input type="text" name="full_name" value="<?php echo $full_name; ?>"></td>

                </tr>
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="username" value="<?php echo $username; ?>"></td>

                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
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
    echo mysqli_real_escape_string($conn, $id = $_POST['id']);
    echo mysqli_real_escape_string($conn, $full_name = $_POST['full_name']);
    echo mysqli_real_escape_string($conn, $username = $_POST['username']);

    //create a SQL Query to updata admin

    $sql = "UPDATE tbl_admin SET
    full_name='$full_name',
    username= '$username'
    WHERE id= '$id'
    ";


    //Execute  the query
    $res = mysqli_query($conn, $sql);
    //check whether the query is executed successfully or not
    if ($res == TRUE) {
        //Query executed and admin updated
        $_SESSION['update'] = "<div class='success'>Admin Updated successfully</div>";

        //redirect page to Manage Admin
        header("location:" . SITEURL . 'manage.php');
    } else {
        //failed to update admin
        $_SESSION['update'] = "<div class='error'>Admin failed to update</div>";

        //redirect page to Manage Admin
        header("location:" . SITEURL . 'update-admin.php');
    }
}
?>

<?php include('useable/footer.php'); ?>