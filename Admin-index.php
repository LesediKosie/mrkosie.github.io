<?php include('useable/menu.php'); ?>



<!--Menu Section start-->
<div class="menu-content">
    <div class="wrapper">
        <h1>DASHBOARD</h1>

        <br>

        <?php
        if (isset($_SESSION['login'])) {
            echo $_SESSION['login']; //displaying session
            unset($_SESSION['login']); //removing Session message
        }
        ?>
        <br>

        <div class="col-4 text-center">
            <?php
            $sql = "SELECT * FROM tbl_category";
            //execute query
            $res = mysqli_query($conn, $sql);
            //count rows
            $count = mysqli_num_rows($res);
            ?>
            <h1><?php echo $count; ?></h1>
            <br> categories
        </div>

        <div class="col-4 text-center">
            <?php
            $sql2 = "SELECT * FROM tbl_food";
            //execute query
            $res2 = mysqli_query($conn, $sql2);
            //count rows
            $count2 = mysqli_num_rows($res2);
            ?>
            <h1><?php echo $count2; ?></h1>
            <br> Foods
        </div>

        <div class="col-4 text-center">
            <?php
            $sql3 = "SELECT * FROM tbl_order";
            //execute query
            $res3 = mysqli_query($conn, $sql3);
            //count rows
            $count3 = mysqli_num_rows($res3);
            ?>
            <h1><?php echo $count3; ?></h1>
            <br> Total Orders
        </div>

        <div class="col-4 text-center">
            <?php
            //create sql to get total revenue
            $sql4 = "SELECT SUM(Total) AS Total FROM tbl_order WHERE status='Delivered' ";
            //execute query
            $res4 = mysqli_query($conn, $sql4);

            //get value
            $row4 = mysqli_fetch_assoc($res4);

            //get the total
            $total_revenue = $row4['Total'];


            //count rows
            //$count4 = mysqli_num_rows($res4);


            ?>
            <h1>
                R<?php echo $total_revenue; ?>
            </h1>
            <br> Revenue generated
        </div>

        <div class="clearfix"></div>



    </div>

</div>


<!--Menu Section ends-->
<?php include('useable/footer.php'); ?>