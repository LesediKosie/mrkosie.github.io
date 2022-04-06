<?php include('useable/menu.php'); ?>
<div class="menu-content">
    <div class="wrapper">
        <h1>Update order</h1>


        <br>
        <br>
        <?php
        //check if id is set or not
        if (isset($_GET['id'])) {
            //Get the Order Details
            $id = $_GET['id'];

            //get details based on id
            //sql= query to get order details
            $sql = "SELECT * FROM tbl_order WHERE id=$id";
            $res = mysqli_query($conn, $sql);

            //count rows
            $count = mysqli_num_rows($res);
            if ($count == 1) {
                //details availabl
                $row = mysqli_fetch_assoc($res);


                $food = $row['food'];
                $price = $row['price'];
                $qty = $row['qty'];
                $status = $row['status'];
                $customer_name = $row['customer_name'];
                $customer_contact = $row['customer_contact'];
                $customer_email = $row['customer_email'];
                $customer_address = $row['customer_address'];
            } else {
                // details not available
                //redirect to M order
                header('location:' . SITEURL . 'M-order.php');
            }
        } else {
            //redirect to M-order
            header('location:' . SITEURL . 'M-order.php');
        }
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Food Name</td>
                    <td><b><?php echo $food; ?></b></td>
                </tr>
                <tr>
                    <td>Qty</td>
                    <td>
                        <input type="number" name="qty" value="<?php echo $qty; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Price</td>
                    <td>
                        <b>R<?php echo $price; ?></b>
                    </td>
                </tr>

                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option <?php if ($status == "Ordered") {
                                        echo "selected";
                                    } ?> value="Ordered" class="ordered">Ordered</option>
                            <option <?php if ($status == "Out for delivery") {
                                        echo "selected";
                                    } ?> value="Out for delivery" class="on-delivery">Out for delivery</option>
                            <option <?php if ($status == "Delivered") {
                                        echo "selected";
                                    } ?> value="Delivered" class="success">Delivered</option>
                            <option <?php if ($status == "Cancelled") {
                                        echo "selected";
                                    } ?> value="Cancelled" class="error">Cancelled</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Customer Name</td>
                    <td>
                        <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer contact</td>
                    <td>
                        <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer Email</td>
                    <td>
                        <input type="email" name="customer_email" value="<?php echo $customer_email; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer Address</td>
                    <td>
                        <textarea name="customer_address" cols="30" rows="5"><?php echo $customer_address; ?></textarea>
                    </td>
                </tr>


                <tr>

                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                    </td>
                </tr>



            </table>
        </form>

        <?php
        //check if button is clicked
        if (isset($_POST['submit'])) {
            //echo "clicked"; die();
            //get all values from form
            $id = mysqli_real_escape_string($conn, $_POST['id']);
            $food = mysqli_real_escape_string($conn, $_POST['food']);
            $price = mysqli_real_escape_string($conn, $_POST['price']);
            $qty = mysqli_real_escape_string($conn, $_POST['qty']);
            $total = mysqli_real_escape_string($conn, $price * $qty);
            $status = mysqli_real_escape_string($conn, $_POST['status']);
            $customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
            $customer_contact = mysqli_real_escape_string($conn,$_POST['customer_contact']);
            $customer_email = mysqli_real_escape_string($conn, $_POST['customer_email']);
            $customer_address = mysqli_real_escape_string($conn, $_POST['customer_address']);

            //upload the values
            $sql2 = "UPDATE tbl_order SET
            qty= $qty,
            Total=$total,
            status='$status',
            customer_name='$customer_name',
            customer_contact='$customer_contact',
            customer_email='$customer_email',
            customer_address='$customer_address'
            WHERE id='$id'
            ";

            //execute query
            $res2 = mysqli_query($conn, $sql2);

            //check order if updated of not
            if ($res2 == TRUE) {
                //updated
                $_SESSION['update']  = "<div class='success'>Order updated successfully</div>";
                //redirect
                header('location:' . SITEURL . 'M-order.php');
            } else {

                //failed to update
                $_SESSION['update']  = "<div class='error'> Failed to update order</div>";
                //redirect
                header('location:' . SITEURL . 'M-order.php');
            }

            //redirect
        }
        ?>


    </div>
</div>
<?php include('useable/footer.php'); ?>