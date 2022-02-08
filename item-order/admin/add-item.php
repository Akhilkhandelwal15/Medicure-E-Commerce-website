<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1> Add item </h1>

        <br> <br>

        <?php
            if(isset($_SESSION['upload'])) //cheking whether the session is set or not
            {
                echo $_SESSION['upload'];  //Displaying session message
                unset($_SESSION['upload']); //Removing session message
            }
        ?>


        <br> <br>

        <!-- Add category form starts -->
        <form action="" method="POST" enctype="multipart/form-data">
        <table class="tbl-30">
            <tr>
                <td>Title:</td>
                <td><input type="text" name="title" placeholder="category title"></td>
            </tr>

            <tr>
                <td>Description:</td>
                <td>
                    <textarea name="description" cols="30" rows="5" placeholder="Description of item">
                    </textarea>
                </td>
            </tr>

            <tr>
                <td>Price:</td>
                <td><input type="number" name="price" placeholder="Enter price"></td>
            </tr>

            <tr>
                <td>Select Image:</td>
                <td><input type="file" name="image"></td>
            </tr>

            <tr>
                <td>Category:</td>
                <td>
                    <select name="category">
                        <?php
                            
                            //1.create sql to get all active categories from database
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                            // Executing query
                            $res = mysqli_query($conn, $sql);

                            //Count rows to check whether we have categories or not
                            $count = mysqli_num_rows($res);

                            //If count is greater than 0 we have categories else we do not have categories
                            if($count>0)
                            {
                                // We have categories
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    //get the details of categories
                                    $id = $row['id'];
                                    $title = $row['title'];

                                    ?>
                                    <option value="<?php echo $id; ?>"><?php echo $title; ?> </option>
                                    <?php
                                }

                            }
                            else
                            {
                                //We do not have category
                                ?>
                                <option value="0">No Category Found</option>
                                <?php
                            }
                            //2. Display on dropdown

                        ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td>featured:</td>
                <td>
                    <input type="radio" name="featured" value="Yes"> Yes
                    <input type="radio" name="featured" value="No"> No
                </td>
            </tr>

            <tr>
                <td>Active:</td>
                <td>
                    <input type="radio" name="active" value="Yes">Yes
                    <input type="radio" name="active" value="No">No
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add item" class="btn-secondary">
                </td>
            </tr>

        </table>
    </form>

    <?php 
        //Check whether button is clicked or not
        if(isset($_POST['submit']))
        {
            // Add the item in database
            //echo "clicked";

            //1. Get the data from form
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];

            //check whether radio button for featured and active are checked or not
            if(isset($_POST['featured']))
            {
                //Get the value from form
                $featured = $_POST['featured'];
            }
            else
            {
                //Set the default value
                $featured = "No";
            }

            
            if(isset($_POST['active']))
            {
                $active = $_POST['active'];
            }
            else
            {
                //setting default value
                $active = "No";
            }

            //2.Upload the image if selected

            

            //check whether the image is selected or not and set the value for image name accordingly

            if(isset($_FILES['image']['name']))
            {
                //Get the details of the selected image
                //upload the image
                $image_name = $_FILES['image']['name'];

                
                //check whether the image is selected or not and upload image only if selected
                if($image_name!="")
                {
                    //image is selected
                    //A. rename the image
                    //Get the extension of the selected image
                    $ext = end(explode('.', $image_name));

                    $image_name = "item-Name".rand(0000, 9999).'.'.$ext; //e.g. item_category_834.jpg

                    //B. upload the image
                    //get the src pathand destination path

                    //source path is thwe current location of the image
                    $src = $_FILES['image']['tmp_name'];

                    //Destination path is the path for the image to be uploaded
                    $dst = "../images/item/".$image_name;

                    //Finally upload the image
                    $upload = move_uploaded_file($src, $dst);

                    //check whether whether image is uploaded or not
                    //And if image is not uploaded then we will stop the process and redirect with error message
                    if($upload==false)
                    {
                        //Set message
                        $_SESSION['upload'] = "<div class='error>Failed to upload the image. </div>";
                        //Redirect to add category page
                        header('location:'.SITEURL.'admin/add-item.php');
                        // Stop the process
                        die();
                    }

                }

           
            }

        
            else
            {
                $image_name = ""; //Setting default value as blank
            }

            //3.Insert into dstabase

            //create a sql query to save or add item

            $sql2= "INSERT INTO tbl_item SET
            title='$title',
            description='$description',
            price= $price,
            image_name='$image_name',
            category_id = $category,
            featured='$featured',
            active='$active'
        ";

            //4.Executing query and saving data into database

            $res2 = mysqli_query($conn, $sql2);

            if($res2 == true)
            {
                //Data Inserted
                //echo "Data Inserted";
                //create a session variable to display message
                $_SESSION['add'] = "<div class='success'>item added successfully. </div>";
                //Redirect page to manage admin
                header("location:".SITEURL.'admin/manage-item.php');
            }

            else
            {
                // Failed to insert Data
                //echo "Failed to Insert Data";
                //create a session variable to display message
                $_SESSION['add'] = "<div class='error'>Failed to add item. </div>";
                //Redirect page to add admin
                header("location:".SITEURL.'admin/add-item.php');
            }


        
        }  

    ?>

        <!-- Add category form ends -->
    </div>
</div>


<?php include('partials/footer.php'); ?>