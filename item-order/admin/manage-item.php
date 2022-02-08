<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1> Manage item </h1><br> <br>


           <!-- button to add admin-->
           <a href="<?php echo SITEURL; ?>admin/add-item.php" class="btn-primary"> Add item </a> <br> <br> <br>
           <?php
                if(isset($_SESSION['add'])) //cheking whether the session is set or not
                {
                    echo $_SESSION['add'];  //Displaying session message
                    unset($_SESSION['add']); //Removing session message
                }
                if(isset($_SESSION['delete'])) //cheking whether the session is set or not
                {
                    echo $_SESSION['delete'];  //Displaying session message
                    unset($_SESSION['delete']); //Removing session message
                }
                if(isset($_SESSION['upload'])) //cheking whether the session is set or not
                {
                    echo $_SESSION['upload'];  //Displaying session message
                    unset($_SESSION['upload']); //Removing session message
                }
                if(isset($_SESSION['unauthorize'])) //cheking whether the session is set or not
                {
                    echo $_SESSION['unauthorize'];  //Displaying session message
                    unset($_SESSION['unauthorize']); //Removing session message
                }
                if(isset($_SESSION['update'])) //cheking whether the session is set or not
                {
                    echo $_SESSION['update'];  //Displaying session message
                    unset($_SESSION['update']); //Removing session message
                }
            ?>
           
           <table class="tbl-full">
                <tr>
                    <th> S.N. </th>
                    <th> Title </th>
                    <th> Price </th>
                    <th> Image </th>
                    <th> Featured </th>
                    <th> Active </th>
                    <th> Actions </th>
                </tr>

                <?php 
                    //create sql query to get all the item
                    //item
                    $sql = "SELECT * FROM tbl_item";

                    //Execute the query
                    $res = mysqli_query($conn, $sql);

                    //count rows to check whether we have items or not

                    $count = mysqli_num_rows($res);

                    //create serial number variable and set default value as 1

                    $sn=1;

                    if($count>0)
                    {
                        //we have items in database
                        //Get the items from database and Display
                        while($row=mysqli_fetch_assoc($res))
                        {
                            //get the values from individual columns
                            $id = $row['id'];
                            $title = $row['title'];
                            $price = $row['price'];
                            $image_name = $row['image_name'];
                            $featured = $row['featured'];
                            $active = $row['active'];

                            ?>
                                <tr>
                                    <td><?php echo $sn++; ?>.</td>
                                    <td><?php echo $title; ?></td>
                                    <td>₹<?php echo $price; ?></td>
                                    <td>
                                        <?php
                                        //check whether we have image or not
                                        if($image_name=="")
                                        {
                                            //We do not have image, Display error message
                                            echo "<div class='error'>Image not Added.</div>";
                                        }
                                        else
                                        {
                                            //We have Image, Display Image
                                            ?>
                                            <img src="<?php echo SITEURL; ?>images/item/<?php echo $image_name ?>" width="100px">
                                            <?php
                                        }

                                        ?>
                                    </td>
                                    <td><?php echo $featured; ?></td>
                                    <td><?php echo $active; ?></td>
                                    
                                    <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-item.php?id=<?php echo $id; ?>" class="btn-secondary"> Update item </a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-item.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger"> Delete item </a>
                                    </td>
                                </tr>
                            
                            <?php
                            
                        }
                    }
                    else
                    {
                        //item not added in database
                        echo "<tr><td colspan='7' class='error'> item not Added Yet.</td> </tr>";
                    }

                
                ?>
                

                
                
            </table>

        </div>
    </div>

<?php include('partials/footer.php') ?>