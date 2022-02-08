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



    <!-- item MEnu Section Starts Here -->
    <section class="item-menu">
        <div class="container">
            <h2 class="text-center">Order Products</h2>

            <?php

                $sql = "SELECT * FROM tbl_item WHERE active='yes'";

                //Execute the query
                $res = mysqli_query($conn, $sql);
                //Count rows to check whether the item is available or not
                $count = mysqli_num_rows($res);

                if($count>0)
                {
                    //items available
                    while($row=mysqli_fetch_assoc($res))
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