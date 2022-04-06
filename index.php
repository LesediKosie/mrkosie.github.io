<?php include('useable2/menu.php'); ?>
<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <form action="<?php SITEURL; ?>food-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for Food.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->
<?php
if (isset($_SESSION['order']))
{
    echo $_SESSION['order']; //displaying session
    unset($_SESSION['order']); //removing Session message
}
?>

<!-- Categories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>

        <?php
        //Create sql query to display categories from database
        $sql = "SELECT * FROM tbl_category WHERE active ='Yes' AND featured ='Yes' LIMIT 3";

        //execute the query
        $res = mysqli_query($conn, $sql);

        //count rows to check  if category is available or not
        $count = mysqli_num_rows($res);

        //
        if ($count > 0) {
            //Category is available
            while ($row = mysqli_fetch_assoc($res)) {
                //get The values like Id, Title  and Image
                $id = $row['id'];
                $title = $row['title'];
                $image_name = $row['image_name'];
        ?>

                <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                    <div class="box-3 float-container">
                        <?php
                        //check if image is available
                        if ($image_name == "") {
                            //display Message
                            echo "<div class='error'>Image not Available</div>";
                        } else {
                            //image name is available
                        ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" class="img-responsive img-curve">

                        <?php
                        }
                        ?>


                        <h3 class="float-text text-white"><?php echo "$title" ?></h3>
                    </div>
                </a>
        <?php
            }
        } else {
            //categories are not available
            echo "<div class='error'>Category is not added</div>";
        }

        ?>






        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php
        //getting food from database
        //SQL Query
        $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";
        //Execute query
        $res2 = mysqli_query($conn, $sql2);
        $count2 = mysqli_num_rows($res2);

        //check if food is available or not
        if ($count2 > 0) {
            //then Food Available
            while ($row = mysqli_fetch_assoc($res2)) {
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

    <p class="text-center">
        <a href="<?php echo SITEURL; ?>foods.php">See All Foods</a>
    </p>
</section>
<!-- fOOD Menu Section Ends Here -->

<?php include('useable2/footer.php'); ?>