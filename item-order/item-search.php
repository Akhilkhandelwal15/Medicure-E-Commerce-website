<?php include('partials-front/menu.php'); ?>

    <!-- item sEARCH Section Starts Here -->
    <section class="item-search text-center">
        <div class="container">

        <?php

            //Get the search keyword
            $search = $_POST['search'];

        ?>
            
            <h2>Products on Your Search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

        </div>
    </section>
    <!-- item sEARCH Section Ends Here -->



    <!-- item MEnu Section Starts Here -->
    <section class="item-menu">
        <div class="container">
            <h2 class="text-center">Order Products</h2>

            <?php

                //Get the search keyword
                $search = $_POST['search'];

                
                $sql = "SELECT * FROM tbl_item WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

                //Execute the query
                $res = mysqli_query($conn, $sql);

                //Count Rows
                $count = mysqli_num_rows($res);

                //check whether item is available or not
                if($count>0)
                {
                    //item available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Get the datails
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
                        ?>
                            <div class="item-menu-box">
                                <div class="item-menu-img">
                                    <?php
                                        //Check whether Image name is available or not
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
                                    <?php echo $description; ?>
                                </p>
                                <br>

                                <a href="#" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>

                        <?php
                    }
                }
                else
                {
                    //item not available
                    echo "<div class='error'>item not Found.</div>";
                }



            ?>

            <div class="clearfix"></div>

        </div>

    </section>
    <!-- item Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>