<?php include('useable2/menu.php'); ?>

<?php
if (isset($_GET['food_id'])) {
    //Get Selected food ID and details of selected food
    $food_id = $_GET['food_id'];


    //get the detials of the selected food
    $sql = "SELECT * FROM tbl_food WHERE id=$food_id";

    //execute query
    $res = mysqli_query($conn, $sql);
    //count the row
    $count = mysqli_num_rows($res);
    //check if data is available
    if ($count == 1) {
        //get data
        $row = mysqli_fetch_assoc($res);

        $title = $row['title'];
        $price = $row['price'];
        $image_name = $row['image_name'];
    } else {
        //food not available
        //redirect
        header('location:' . SITEURL);
    }
} else {
    //redirect to home page
    header('location:' . SITEURL);
}
?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search">
    <div class="container">

        <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

        <form action="" method="POST" class="order">
            <fieldset>
                <legend>Selected Food</legend>

                <div class="food-menu-img">
                    <?php
                    // check if the image is available or not
                    if ($image_name == "") {
                        //image is not available
                        echo "<div class='error'>Image  not available</div>";
                    } else {
                        //image is available
                    ?>
                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" class="img-responsive img-curve">
                    <?php

                    }
                    ?>

                </div>

                <div class="food-menu-desc">
                    <h3><?php echo $title; ?></h3>
                    <input type="hidden" name="food" value="<?php echo $title; ?>">
                    <p class="food-price">R<?php echo $price; ?></p>
                    <input type="hidden" name="price" value="<?php echo $price; ?>">

                    <div class="order-label">Quantity</div>
                    <input type="number" name="qty" class="input-responsive" value="1" required>


                </div>

            </fieldset>

            <fieldset>
                <legend>Delivery Details</legend>
                <div class="order-label">Full Name</div>
                <input type="text" name="full-name" placeholder="E.g. Lesedi Kosie" class="input-responsive" required>

                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" placeholder="E.g. 0722xxxxxx" class="input-responsive" required>

                <div class="order-label">Email</div><input type="email" placeholder="E.g. lesedi@gmail.com" name="email" class="input-responsive" required>

                <div class="order-label">Address</div>
                <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
            </fieldset>

        </form>

        <?php
        //check if detail button is selected
        if (isset($_POST['submit'])) {
            //get all details from the database

            $food = mysqli_real_escape_string($conn, $_POST['food']);
            $price = mysqli_real_escape_string($conn, $_POST['price']);
            $qty = mysqli_real_escape_string($conn, $_POST['qty']);

            $total = $price * $qty; //total price

            $order_date = mysqli_real_escape_string($conn, date("Y-m-d, h:m:sa"));

            $status = mysqli_real_escape_string($conn, "Ordered"); //Ordered, on delivery, delivered
            $customer_name = mysqli_real_escape_string($conn, $_POST['full-name']);
            $customer_contact = mysqli_real_escape_string($conn, $_POST['contact']);
            $customer_email = mysqli_real_escape_string($conn,$_POST['email']);
            $customer_address = mysqli_real_escape_string($conn, $_POST['address']);

            //save data into database
            //create sql to dave date
            $sql2 = "INSERT INTO tbl_order SET
             food=  '$food',
             price = $price,
             qty = $qty,
             total = $total,
             order_date = '$order_date',
             status = '$status',
             customer_name = '$customer_name',
             customer_contact = '$customer_contact',
             customer_email = '$customer_email',
             customer_address = '$customer_address'


            ";
            //echo $sql2;die();

            //execute query
            $res2 = mysqli_query($conn, $sql2);

            //check if data is saved
            if ($res2 == TRUE) {
                //MEssage
                $_SESSION['order'] = "<div class='success text-center'>Order Successfully Placed</div>";
                //redirect
                header('location:' . SITEURL);
            } else {
                //MEssage
                $_SESSION['order'] = "<div class='error text-center'>Failed to place an order</div>";
                //redirect
                header('location:' . SITEURL);
            }
        }
        ?>

    </div>
</section>













<!-- fOOD sEARCH Section Ends Here -->



<?php include('useable2/footer.php'); ?>

</body>

</html>