<?php include('partials/menu.php'); ?>

<?php
    //check whether id is set or not
    if(isset($_GET['id']))
    {
        //get all the details
        $id = $_GET['id'];

        //create sql query to get all other details
        $sql2 = "SELECT * FROM tbl_item WHERE id=$id";

        //Execute the query

        $res2 = mysqli_query($conn, $sql2);
         
        //Get all the data
        //item
        $row2 = mysqli_fetch_assoc($res2);
        $title = $row2['title'];
        $description = $row2['description'];
        $price = $row2['price'];
        $current_image = $row2['image_name'];
        $current_category = $row2['category_id'];
        $featured = $row2['featured'];
        $active = $row2['active'];

       
    }
    else
    {
        //redirect to manage item
        header('location:'.SITEURL.'admin/manage-item.php');
    }
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update item </h1>
        <br> <br>

        <form action="" method="POST" enctype="multipart/form-data">

        <table class="tbl-30">
            <tr>
                <td>Title:</td>
                <td>
                    <input type="text" name="title" value="<?php echo $title; ?>">
                </td>
            </tr>

            <tr>
                <td>Description:</td>
                <td>
                    <textarea name="description" cols="30" rows="5" value="<?php echo $description; ?>"> 
                    </textarea>
                </td>
            </tr>

            <tr>
                <td>Price:</td>
                <td>
                    <input type="number" name="price" value="<?php echo $price; ?>" >
                </td>
            </tr>

            <tr>
                <td>Current Image:</td>
                <td>
                    <?php
                        if($current_image == "")
                        {
                            //image not available
                            echo "<div class=error'>Image not Available. </div>";
                        }
                        else
                        {
                            //image Available
                            ?>
                            <img src="<?php echo SITEURL; ?>images/item/<?php echo $current_image; ?>" width="150px">
                            <?php
                        }
                    ?>
                           

                </td>
            </tr>

            <tr>
                <td>Select New Image::</td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>


            <tr>
                <td>Category:</td>
                <td>
                    <select name="category">
                    <?php
                       //Query to get active categories
                       $sql = "SELECT * FROM tbl_category WHERE active='yes'";

                       //Execute the query
                       $res = mysqli_query($conn, $sql);

                       //Count Rows

                       $count = mysqli_num_rows($res);

                       //check whether the category is available or not
                       if($count>0)
                       {
                           //category available
                           while($row=mysqli_fetch_assoc($res))
                           {
                               $category_title = $row['title'];
                               $category_id = $row['id'];

                               //echo "<option value='$category_id'>$category_title</option>";

                               ?>
                               <option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                               <?php
                           }
                       }
                       else
                       {
                           //category not available
                           echo "<option value='0'>Category Not Available</option>";
                       }



                    ?>                 
                    </select>
                </td>
            </tr>

            <tr>
                <td>Featured:</td>
                <td>
                    <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes
                    <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No"> No
                </td>
            </tr>

            <tr>
                <td>Active:</td>
                <td>
                    <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes
                    <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="active" value="No"> No
                </td>
            </tr>

            <tr>
                <td>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                    <input type="submit" name="submit" value="Update item" class="btn-secondary">
                </td>          
            </tr>

        </table>

        </form>

<?php
           
           
   // check whether the submit button is clicked or not
   if(isset($_POST['submit']))  
   {
        //echo "Button clicked";
        //Get all the values from form to update
        $id = $_POST['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $current_image = $_POST['current_image'];
        $category = $_POST['category'];
        $featured = $_POST['featured'];
        $active = $_POST['active'];

        //2. updating new image if selected
        //Check whether image is selected or not
        if(isset($_FILES['image']['name']))
        {
            //Get the image details
            $image_name = $_FILES['image']['name']; //New image name

            //check whether the image is available or not
            if($image_name!="")
            {
            //Image Available
            //A.Upload the new image
            //Auto rename our image
            //Get the extension of our image(jpg, png, gif, etc) e.g. "specialitem1.jpg"
            $ext = end(explode('.', $image_name));

            //Rename the image
            $image_name = "item-Name-".rand(0000, 9999).'.'.$ext; //e.g. item_category_834.jpg //rand will generate randon number



        
            $src_path = $_FILES['image']['tmp_name'];
            $dest_path = "../images/item/".$image_name;

            //Finally upload the image
            $upload = move_uploaded_file($src_path, $dest_path);

            //check whether whether image is uploaded or not
            //And if image is not uploaded then we will stop the process and redirect with error message
            if($upload==false)
            {
                //Set message
                $_SESSION['upload'] = "<div class='error>Failed to upload the image. </div>";
                //Redirect to Manage item page
                header('location:'.SITEURL.'admin/manage-item.php');
                // Stop the process
                die();
            }

            //B. Remove the current image if available
            if($current_image!="")
            {

                    $remove_path = "../images/item/".$current_image;
                    $remove = unlink($remove_path);

                    //check whether the image is removed or not
                    //and if failed to remove then display message and stop the process
                if($remove==false)
                {
                    //Failed to remove image
                    $_SESSION['remove-failed'] = "<div class='error'>Failed to remove current Image.</div>";
                    header('location:'.SITEURL.'admin/manage-item.php');
                    die(); //Stop the process
                }

            }
                
            }
            else
            {
                $image_name = $current_image;
            }
        }
        else
        {
            $image_name = $current_image;
        }

        //3.Update the database

        //create a sql query to update admin
        $sql3 = "UPDATE tbl_item SET
        title ='$title',
        description = '$description',
        price = $price,
        image_name = '$image_name',
        category_id = '$category',
        featured = '$featured',
        active = '$active'
        WHERE id=$id
        ";

        //Execute the query
        $res3 = mysqli_query($conn, $sql3);

        //Redirect to manage category with message

        //Check whether the query executed successfully or not
        if($res3==true)
        {
            //Query Executed and item updated
            $_SESSION['update'] = "<div class='success'>item updated successfully.</div>";
            //Redirect to manage Admin page
            header('location:'.SITEURL.'admin/manage-item.php');
        }
        else
        {
            //Failed to update category
            $_SESSION['update'] = "<div class='success'Failed to update item.</div>";
            //Redirect to manage Admin page
            header('location:'.SITEURL.'admin/manage-item.php');
        }
    } 
    

?>

    </div>
</div>



<?php include('partials/footer.php'); ?>
