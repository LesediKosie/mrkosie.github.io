<?php include('useable/menu.php'); ?>

<div class="menu-content">
    <div class="wrapper">
        <h1>Manage Order</h1>

        <br>
        <br>
        <?php
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update']; //displaying session
            unset($_SESSION['update']); //removing Session message
        }
        ?>
        <br>
        <br>
        <table class="tbl-full">
            <tr>
                <th>S.N.</th>

                <th>Food</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Order_date</th>
                <th>Status</th>
                <th>Customer_name</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
            <?php
            //Query to get all admin
            $sql = "SELECT * FROM tbl_order";
            //execute the query
            $res = mysqli_query($conn, $sql);

            //count rows
            $count = mysqli_num_rows($res);

            $sn = 1; //create a serial number and set it as 1


            if ($count > 0) {
                //order available
                while ($row = mysqli_fetch_assoc($res)) {
                    //Het All order details
                    $id = $row['id'];
                    $food = $row['food'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $total = $row['Total'];
                    $date = $row['order_date'];
                    $status = $row['status'];
                    $name = $row['customer_name'];
                    $contact = $row['customer_contact'];
                    $email = $row['customer_email'];
                    $address = $row['customer_address'];
            ?>

                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $food; ?></td>
                        <td><?php echo $price; ?></td>
                        <td><?php echo $qty; ?></td>
                        <td>R<?php echo $total; ?></td>
                        <td><?php echo $date; ?></td>
                        <td class="ordered"><?php echo $status; ?></td>
                        <td><?php echo $name; ?></td>
                        <td><?php echo $contact; ?></td>
                        <td><?php echo $email; ?></td>
                        <td><?php echo $address; ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>update-order.php?id= <?php echo $id; ?>" class="btn-secondary">Update</a>
                        </td>
                    </tr>
            <?php



                }
            } else {
                //not available
                echo "<tr><td colspan='12' class='error'>No Order Available</td></tr>";
            }
            ?>

        </table>
    </div>

</div>

<?php include('useable/footer.php'); ?>