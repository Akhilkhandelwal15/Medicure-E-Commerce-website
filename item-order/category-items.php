<?php include('partials-front/menu.php'); ?>

<?php
    //Check whether id is passes or not
    if(isset($_GET['category_id']))
    {
        //Category id is set and get the id
        $category_id = $_GET['category_id'];

        //Get the category title based on category id
        $sql = "SELECT title FROM tbl_category WHERE id=$category_id";

        //Execute the query
        $res = mysqli_query($conn, $sql);

        //Get the value from database
        $row = mysqli_fetch_assoc($res);
        //Get the title
        $category_title = $row['title'];
    }
    else
    {
        //Category not passed
        //Redirect to home page
        header('location:'.SITEURL);
    }
?>

    <!-- item sEARCH Section Starts Here -->
    <section class="item-search text-center">
        <div class="container">
            
            <h2>Products on Search<a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>
    <!-- item sEARCH Section Ends Here -->



    <!-- item MEnu Section Starts Here -->
    <section class="item-menu">
        <div class="container">
            <h2 class="text-center">Order Products</h2>

            <?php

                //Create sql query to get item based onselected category
                $sql2 = "SELECT * FROM tbl_item WHERE category_id=$category_id";

                //Execute the query
                $res2 = mysqli_query($conn, $sql2);
                //Count rows to check whether the item is available or not
                $count2 = mysqli_num_rows($res2);

                //Check whether item is available or not
                if($count2>0)
                {
                    //items available
                    while($row2=mysqli_fetch_assoc($res2))
                    {
                        //Get the values like id, title, image_name
                        $id = $row2['id'];
                        $title = $row2['title'];
                        $price = $row2['price'];
                        $description = $row2['description'];
                        $image_name = $row2['image_name'];
                        ?>
                        <div class="item-menu-box">
                            <div class="item-menu-img">
                                <?php
                                    //Check whether Image is Available or not
                                    if($image_name=="")
                                    {
                                        //Image not available
                                        echo "<div class='error'>Image not Available</div>";
                                    }
                                    else
                                    {
                                        //Image available
                                        ?>
                                            <img src="<?php echo SITEURL; ?>/images/item/<?php echo $image_name; ?>" alt="N-95 mask" class="img-responsive img-curve">
                                        <?php
                                    }

                                ?>

                            </div>

                            <div class="item-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="item-price">₹<?php echo $price; ?>/-</p>
                                <p class="item-detail">
                                    <?php echo $description;  ?>
                                </p>
                                <br>

                                <a href="<?php echo SITEURL; ?>order.php?item_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>



                        <?php
                    }
                }
                else
                {
                    //item not available
                    echo "<div class='error'>item not Available.</div>";
                }

            ?>

            <div class="clearfix"></div>

        </div>

    </section>
    <!-- item Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>