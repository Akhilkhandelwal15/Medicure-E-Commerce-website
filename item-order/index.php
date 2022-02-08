<?php include('partials-front/menu.php'); ?>

    <!-- item sEARCH Section Starts Here -->
    <section class="item-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>item-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Products..." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- item sEARCH Section Ends Here -->

    <?php
        if(isset($_SESSION['order']))//set the session message
        {
            echo $_SESSION['order'];//display
            unset($_SESSION['order']);//Remove
        }
    ?>

    <!-- Categories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Categories</h2>

            <?php
                
                //create the query
                $sql = "SELECT * FROM tbl_category WHERE active='yes' AND featured='yes' LIMIT 6";
                //Execute the query
                $res = mysqli_query($conn, $sql);
                //Count rows to check whether the category is available or not
                $count = mysqli_num_rows($res);

                if($count>0)
                {
                    //category is available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Get the values like id, title, image_name
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>
                        <a href="<?php echo SITEURL; ?>category-items.php?category_id=<?php echo $id ?>">
                            <div class="box-3 float-container">
                            <?php
                                //Check whether Image is available or not
                                if($image_name=="")
                                {
                                    //Display message
                                    echo "<div class='error'>Image not available</div>";
                                }
                                else
                                {
                                    //Image available
                                    ?>
                                        <img src="<?php echo SITEURL; ?>/images/category/<?php echo $image_name; ?>"alt="Masks" class="img-responsive img-curve">                                
                                    <?php
                                }

                            ?>
                            

                            <h3 class="float-text text-color"><?php echo $title; ?></h3>
                            </div>
                        </a>

                        <?php
                    }
                }
                else
                {
                    //categories is not available
                    echo "<div class='error'>Category not Added</div>";
                }

            ?>

            

            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- item MEnu Section Starts Here -->
    <section class="item-menu">
        <div class="container">
            <h2 class="text-center">Order Products</h2>

            <?php

                
                $sql2 = "SELECT * FROM tbl_item WHERE active = 'Yes' AND featured='Yes' LIMIT 6";

                //Execute the query
                $res2 = mysqli_query($conn, $sql2);

                //Count rows
                $count2 = mysqli_num_rows($res2);

                //Check whether the item is available or not
                if($count2>0)
                {
                    //item available
                    while($row=mysqli_fetch_assoc($res2))
                    {
                        //Get the values like id, title, image_name
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
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
                                            <img src="<?php echo SITEURL; ?>/images/item/<?php echo $image_name; ?>" alt="N-95 Mask" class="img-responsive img-curve">
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