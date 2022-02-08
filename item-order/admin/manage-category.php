<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1> Manage category </h1><br> <br>

            <?php
                if(isset($_SESSION['add'])) //cheking whether the session is set or not
                {
                    echo $_SESSION['add'];  //Displaying session message
                    unset($_SESSION['add']); //Removing session message
                }

                if(isset($_SESSION['remove'])) //cheking whether the session is set or not
                {
                    echo $_SESSION['remove'];  //Displaying session message
                    unset($_SESSION['remove']); //Removing session message
                }
                if(isset($_SESSION['delete'])) //cheking whether the session is set or not
                {
                    echo $_SESSION['delete'];  //Displaying session message
                    unset($_SESSION['delete']); //Removing session message
                }
                if(isset($_SESSION['no-category-found'])) //cheking whether the session is set or not
                {
                    echo $_SESSION['no-category-found'];  //Displaying session message
                    unset($_SESSION['no-category-found']); //Removing session message
                }
                if(isset($_SESSION['update'])) //cheking whether the session is set or not
                {
                    echo $_SESSION['update'];  //Displaying session message
                    unset($_SESSION['update']); //Removing session message
                }
                if(isset($_SESSION['upload'])) //cheking whether the session is set or not
                {
                    echo $_SESSION['upload'];  //Displaying session message
                    unset($_SESSION['upload']); //Removing session message
                }
                if(isset($_SESSION['failed-remove'])) //cheking whether the session is set or not
                {
                    echo $_SESSION['failed-remove'];  //Displaying session message
                    unset($_SESSION['failed-remove']); //Removing session message
                }

            ?>
            <br> <br>

           <!-- button to add admin-->
           <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary"> Add Category </a> <br> <br> <br>
           <table class="tbl-full">
                <tr>
                    <th> S.N. </th>
                    <th> Title </th>
                    <th> Image </th>
                    <th> featured </th>
                    <th> Active </th>
                    <th> Actions </th>
                </tr>

                <?php 

                    //query to get all categories from database
                    $sql = "SELECT * FROM tbl_category";

                    //Execute query
                    $res = mysqli_query($conn, $sql);

                    //Count rows
                    $count = mysqli_num_rows($res);

                    //create serial number variable and assign values as 1
                    $sn=1;

                    //Check whether we have data in database or not
                    

                    if($count>0)
                    {
                        //we have data in database
                        //get the data and display the data
                        //This while loop will continue as long as we have data in database
                        while($row=mysqli_fetch_assoc($res))
                        {
                            $id = $row['id'];
                            $title = $row['title'];
                            $image_name = $row['image_name'];
                            $featured = $row['featured'];
                            $active = $row['active'];

                        ?>   
                        
                        <tr>
                            <td> <?php echo $sn++; ?>.</td>
                            <td> <?php echo $title; ?></td>
                            <td> 
                                <?php
                                     //check whether image name is available or not
                                     if($image_name!="")
                                     {
                                         //Display the image

                                        ?>

                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="100px">

                                        <?php
                                     } 
                                     else
                                     {
                                        //Display the message
                                        echo "<div class='error'>Image not added.</div>";
                                     }

                                
                                ?>
                            </td>
                            <td> <?php echo $featured; ?></td>
                            <td> <?php echo $active; ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary"> Update Category </a>
                                <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger"> Delete category </a>
                            </td>
                        </tr>
                          

 

                        <?php
                        }
                    }
                    else
                    {
                        //we do not have data in database
                        //We will display the message inside table
                        //breaking the php by and again starting the php 

                        ?>

                        <tr>
                            <td colspan="6"><div class="error"> No category Added. </div></td>
                        </tr>

                        <?php
                    }
                
                
                ?>
                


            </table>

        </div>
    </div>

<?php include('partials/footer.php') ?>