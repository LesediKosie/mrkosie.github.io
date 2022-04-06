<?php include('useable/menu.php'); ?>

<body>

  </div>
  <!--Menu Section ends-->


  <!--Menu Section start-->
  <div class="menu-content">
    <div class="wrapper">
      <h1>Manage Admin</h1>
      <br>
      <br>

      <?php
      if (isset($_SESSION['add'])) {
        echo $_SESSION['add']; //displaying session
        unset($_SESSION['add']); //removing Session message
      }

      if (isset($_SESSION['delete'])) {
        echo $_SESSION['delete']; //displaying session
        unset($_SESSION['delete']); //removing Session message
      }

      if (isset($_SESSION['update'])) {
        echo $_SESSION['update']; //displaying session
        unset($_SESSION['update']); //removing Session message
      }

      if (isset($_SESSION['user-Not-Found'])) {
        echo $_SESSION['user-Not-Found']; //displaying session
        unset($_SESSION['user-Not-Found']); //removing Session message

      }

      if (isset($_SESSION['change-pwd'])) {
        echo $_SESSION['change-pwd']; //displaying session
        unset($_SESSION['change-pwd']); //removing Session message
      }
      if (isset($_SESSION['pwd-not-match'])) {
        echo $_SESSION['pwd-not-match']; //displaying session
        unset($_SESSION['pwd-not-match']); //removing Session message
      }


      ?>
      <br>
      <br>


      <!--Button to add admin-->
      <a href="add-admin.php" class="btn-primary">Add admin</a>
      <br>
      <br>
      <br>
      <br>
      <table class="tbl-full">
        <tr>
          <th>S.N.</th>
          <th>Name</th>
          <th>Username</th>
          <th>Actions</th>
        </tr>

        <?php
        //Qery to get all admin
        $sql = "SELECT * FROM tbl_admin";
        //execute the query
        $res = mysqli_query($conn, $sql);

        //check if the query is executed

        if ($res == TRUE) {
          //count rows to check if we have data inside the database
          $count = mysqli_num_rows($res); //Function to get all the rows

          $sn = 1; //create a variable and assign the value

          //check the numbers of rows
          if ($count > 0) {
            //we have database
            while ($rows = mysqli_fetch_assoc($res)) {
              //to get all data from database
              //will run as long as we have database
              //get individual database
              $id = $rows['id'];
              $full_name = $rows['full_name'];
              $username = $rows['username'];

              //display the values in our mysql_list_tables
        ?>

              <tr>
                <td><?php echo $sn++; ?></td>
                <td><?php echo $full_name; ?></td>
                <td><?php echo $username; ?></td>
                <td>
                  <a href="<?php echo SITEURL; ?>chpassword.php?id= <?php echo $id; ?>" class="btn-primary">Password</a>
                  <a href="<?php echo SITEURL; ?>update-admin.php?id= <?php echo $id; ?>" class="btn-secondary">Update</a>
                  <a href="<?php echo SITEURL; ?>useable/delete-admin.php?id= <?php echo $id; ?>" class="btn-danger">Delete</a>
                </td>
              </tr>

        <?php
            }
          } else {
            //we don't have any data inside the database
          }
        }
        ?>





      </table>






    </div>

  </div>
</body>

<!--Menu Section ends-->


<?php include('useable/footer.php'); ?>