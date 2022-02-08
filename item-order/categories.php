<?php include('partials-front/menu.php'); ?>



    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Categories</h2>

            <?php

                
                //sql Query
                $sql = "SELECT * FROM tbl_category WHERE active='yes'";

                //Execute the query
                $res = mysqli_query($conn, $sql);

                //Count rows
                $count = mysqli_num_rows($res);

                //check whether categories are available or not

                if($count >0)
                {
                    //Categories Available
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
                                    //Image is not available
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
                    //categories not available
                    echo "<div class='error'>Category not Found.</div>";
                }


            ?>


       

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


<?php include('partials-front/footer.php'); ?>