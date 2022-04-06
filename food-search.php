<?php include('useable2/menu.php'); ?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <?php
        $search = mysqli_real_escape_string($conn, $_POST['search']);
        ?>

        <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->

<?php
//getting food search database
$search = mysqli_real_escape_string($conn, $_POST['search']);
//SQL Query
//search = 'burger' "; Drop database and name
//"SELECT * FROM tbl_food WHERE title LIKE '%burger%'  OR description LIKE '%burger%'";
$sql2 = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";
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

</section>
<!-- fOOD Menu Section Ends Here -->



<?php include('useable2/footer.php'); ?>
</body>

</html>