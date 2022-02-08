<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category </h1>
        <br> <br>

        <?php
//item
              //check whether the id is set or not
              if(isset($_GET['id']))
              {
                //Get the id and all other details
                //echo "Getting the data";
                $id = $_GET['id'];

                //create sql query to get all other details
                $sql = "SELECT * FROM tbl_category WHERE id=$id";

                //Execute the query

                $res = mysqli_query($conn, $sql);

                //count the rows to check whether the id is valid or not
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    //Get all the data
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                }
                else
                {
                    //Redirect to manage category with session message
                    $_SESSION['no-category-found'] = "<div class='error'>Category not Found</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
              }
              else
              {
                //Redirect to manage category
                header('location:'.SITEURL.'admin/manage-category.php');
              }

        ?>

        <form action="" method="POST" enctype="multipart/form-data">

        <table class="tbl-30">
            <tr>
                <td>Title:</td>
                <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
            </tr>

            <tr>
                <td>Current Image:</td>
                <td>
                    <?php

                    if($current_image != "")
                    {
                        //Display the image
                        ?>
                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px">
                        <?php
                    }
                    else
                    {
                        //Display message
                        echo "<div class='error'>Image Not added.</div>";
                    }


                    ?>
                </td>
            </tr>

            <tr>
                <td>New Image:</td>
                <td><input type="file" name="image"></td>
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
                    <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes">Yes
                    <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="active" value="No">No
                </td>
            </tr>

            <tr>
                <td>
                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="submit" name="submit" value="Update category" class="btn-secondary">
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
        $current_image = $_POST['current_image'];
        $featured = $_POST['featured'];
        $active = $_POST['active'];

        //2. updating new image if selected
        //Check whether image is selected or not
        if(isset($_FILES['image']['name']))
        {
            //Get the image details
            $image_name = $_FILES['image']['name'];

            //check whether the image is available or not
            if($image_name != "")
            {
            //Image Available
            //A.Upload the new image
            //Auto rename our image
            //Get the extension of our image(jpg, png, gif, etc) e.g. "specialitem1.jpg"
            $ext = end(explode('.', $image_name));

            //Rename the image
            $image_name = "item_category_".rand(000, 999).'.'.$ext; //e.g. item_category_834.jpg //rand will generate randon number






            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../images/category/".$image_name;

            //Finally upload the image
            $upload = move_uploaded_file($source_path,$destination_path);

            //check whether whether image is uploaded or not
            //And if image is not uploaded then we will stop the process and redirect with error message
            if($upload==false)
            {
                //Set message
                $_SESSION['upload'] = "<div class='error>Failed to upload the image. </div>";
                //Redirect to add category page
                header('location:'.SITEURL.'admin/manage-category.php');
                // Stop the process
                die();
            }

                //B. Remove the current image if available
                if($current_image!="")
                {

                $remove_path = "../images/category/".$current_image;
                $remove = unlink($remove_path);

                //check whether the image is removed or not
                //and if failed to remove then display message and stop the process
                if($remove==false)
                {
                    //Failed to remove image
                    $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current Image</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
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
        $sql2= "UPDATE tbl_category SET
        title ='$title',
        image_name = '$image_name',
        featured = '$featured',
        active = '$active'
        WHERE id=$id
        ";

        //Execute the query
        $res2 = mysqli_query($conn, $sql2);

        //Redirect to manage category with message

        //Check whether the query executed successfully or not
        if($res2==true)
        {
            //Query Executed and category updated
            $_SESSION['update'] = "<div class='success'>Category updated successfully.</div>";
            //Redirect to manage Admin page
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else
        {
            //Failed to update category
            $_SESSION['update'] = "<div class='success'Failed to update Category.</div>";
            //Redirect to manage Admin page
            header('location:'.SITEURL.'admin/manage-category.php');
        }
    } 

        ?>

    </div>
</div>


<?php include('partials/footer.php'); ?>