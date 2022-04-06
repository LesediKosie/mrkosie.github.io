<?php include('useable2/menu.php'); ?>




<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>

        <?php
        //Create sql query to display categories from database
        $sql = "SELECT * FROM tbl_category WHERE active ='Yes'";

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




<?php include('useable2/footer.php'); ?>

</body>

</html>