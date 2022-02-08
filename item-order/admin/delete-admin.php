<?php
    
include('config/constants.php');
//1.get the id of Admin to be deleted

$id = $_GET['id'];

//2.Create sql query to delete admin

$sql= "DELETE FROM tbl_admin WHERE id=$id";

//EXECUTE the  query

$res = mysqli_query($conn, $sql);

//check whether query executed successfully or not

if($res==true)
{
    //Query executed successfully and Admin deleted
    //echo "Admin Deleted";
    //Create Session variable to Display message
    $_SESSION['delete']="<div class= 'success' > Admin Deleted Successfully. </div>";
    //Redirect to manage admin page
    header('location:'.SITEURL.'admin/manage-admin.php');
}
else
{
    //Failed to delete Admin
    //echo "Failed to Delete Admin";
    $_SESSION['delete'] = "<div class='error'>Failed to Delete Admin. Try again later. </div>";
    header('location:'.SITEURL.'admin/manage-admin.php');
}

//3. Redirect to manage admin page with the message (success/error)




?>