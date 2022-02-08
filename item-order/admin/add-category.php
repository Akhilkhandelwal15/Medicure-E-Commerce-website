<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1> Add category </h1>

        <br> <br>

        <?php
                if(isset($_SESSION['add'])) //cheking whether the session is set or not
                {
                    echo $_SESSION['add'];  //Displaying session message
                    unset($_SESSION['add']); //Removing session message
                }
                if(isset($_SESSION['upload'])) 
                {
                    echo $_SESSION['upload'];  
                    unset($_SESSION['upload']); 
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
                <td>Select Image:</td>
                <td><input type="file" name="image"></td>
            </tr>

            <tr>
                <td>Featured:</td>
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
                    <input type="submit" name="submit" value="Add category" class="btn-secondary">
                </td>
            </tr>

        </table>
    </form>

        <!-- Add category form ends -->
    <?php

    //check whether the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        // Button clicked
        //echo "Button clicked";

        //1. Get data from form

        $title = $_POST['title'];
        //For Radio input, we need to check whether the button is selected or not
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
            $active = "No";
        }


        if(isset($_FILES['image']['name']))
        {
            //upload the image
            // To upload the image we need image name, source path and destination path
            $image_name = $_FILES['image']['name'];

            //upload  the image only if image is selected
            if($image_name != "")
            {

            
            //Auto rename our image
            //Get the extension of our image
            $ext = end(explode('.', $image_name));

            //Rename the image
            $image_name = "item_category_".rand(000, 999).'.'.$ext; //e.g. item_category_834.jpg 
                                                                    //rand will generate randon number






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
                header('location:'.SITEURL.'admin/add-category.php');
                // Stop the process
                die();
            }

            }
        

        }
        else
        {
            //Don't upload image and set the image_name value as blank
            $image_name="";
        }

        


        //2. sql query to save data into database
        $sql= "INSERT INTO tbl_category SET
            title='$title',
            image_name='$image_name',
            featured='$featured',
            active='$active'
        ";

        //3.Executing query and saving data into database

        $res = mysqli_query($conn, $sql);

        //4. Check whether the (query is executed) data is inserted or not and display appropriate message

        if($res==true)
        {
            //Data Inserted
            //echo "Data Inserted";
            //create a session variable to display message
            $_SESSION['add'] = "<div class='success'>Category added successfully. </div>";
            //Redirect page to manage admin
            header("location:".SITEURL.'admin/manage-category.php');
        }

        else
        {
            // Failed to insert Data
            //echo "Failed to Insert Data";
            //create a session variable to display message
            $_SESSION['add'] = "<div class='error'>Failed to add category. </div>";
            //Redirect page to add admin
            header("location:".SITEURL.'admin/add-category.php');
        }
    }


        ?>
    </div>
</div>



<?php include('partials/footer.php'); ?>