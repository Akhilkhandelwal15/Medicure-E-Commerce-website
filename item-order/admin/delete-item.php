<?php

    //include constants page
    include('config/constants.php');

    //echo "Delete item Page";

    if(isset($_GET['id']) && isset($_GET['image_name']))
    {
        //process to delete
        //echo "process to delete";

        //1.Get Id and Image name
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //Remove the physical image file if available
        if($image_name != "")
        {
            //Image is available so remove it
            $path = "../images/item/".$image_name;
            //Remove the image
            $remove = unlink($path);
            //If failed to remove image then add an error message and stop the process
            if($remove==false)
            {
                //Set the session message 
                $_SESSION['upload'] = "<div class='error'>Failed to remove item image.</div>";
                //Redirect to manage item page
                header('location:'.SITEURL.'admin/manage-item.php');
                //Stop the process
                die();
            }

        }

        //3.Delete data from database
        //create a sql query 
        $sql = "DELETE FROM tbl_item WHERE id=$id";

        //Execute the query
        $res = mysqli_query($conn, $sql);

        //Check whether the data is delete from database or not
        if($res==true)
        {
            //Set success message and Redirect
            $_SESSION['delete'] = "<div class='success'>item deleted successfully.</div>";
            //Redirect to manage category
            header('location:'.SITEURL.'admin/manage-item.php');
        }
        else
        {
            //Set fail message and redirect
            $_SESSION['delete'] = "<div class='error'>Failed to delete item.</div>";
            //Redirect to manage category
            header('location:'.SITEURL.'admin/manage-item.php');
        }

    }
    else
    {
        //Redirect to manage item page
        //echo "Redirect";
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access. </div>";
        header('location:'.SITEURL.'admin/manage-item.php');
    }

?>