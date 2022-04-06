<?php include('useable2/menu.php'); ?>
<?php
//check if id is passed or not
if (isset($_GET['category_id'])) {
    //category id is set, get id
    $category_id = $_GET['category_id'];
    //get category title baed on category
    $sql2 = "SELECT title FROM tbl_category WHERE id=$category_id";
    //execute query
    $res2 = mysqli_query($conn, $sql2);

    //create value from database
    $row = mysqli_fetch_assoc($res2);
    //get Title
    $category_title = $row['title'];
} else {
    //category not passed
    //redirect to Home page
    header('location:' . SITEURL);
}
?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php
        //createa sql quwey to get foods based on category
        //SQL Query
        $sql = "SELECT * FROM tbl_food WHERE category_id=$category_id";
        //Execute query
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);

        //check if food is available or not
        if ($count > 0) {
            //then Food Available
            while ($row = mysqli_fetch_assoc($res)) {
                //get all the values
                $id = $row['id'];
                $title = $row['title'];
                $price = $row['price'];
                $description = $row['description'];
                $image_name = $row['image_name'];
        ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php
                        //check if image is available or not
                        if ($image_name == "") {
                            //image not available
                            echo "<div class='error'>Image not available</div>";
                        } else {
                            //image available
                        ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" class="img-responsive img-curve">
                        <?php
                        }
                        ?>

                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $title ?></h4>
                        <p class="food-price">R<?php echo $price ?></p>
                        <p class="food-detail">
                            <?php echo $description ?>
                        </p>
                        <br>

                        <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                    </div>
                </div>
        <?php
            }
        } else {
            //food not available
            echo "<div class='error'>Food not available</div>";
        }
        ?>



        <div class="clearfix"></div>



    </div>

</section>
<!-- fOOD Menu Section Ends Here -->


<?php include('useable2/footer.php'); ?>

</body>

</html>