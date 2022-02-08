<?php include('partials/menu.php'); ?>

<div class="main-content">
        <div class="wrapper">
           <h1>Change Password</h1>
           <br> <br>

           <?php
                if(isset($_GET['id']))
                {
                    $id=$_GET['id'];
                }
           ?>

           <form action="" method="post" >

           <table class="tbl-30">
           <tr>
                <td>Current Password:</td>
                <td>
                    <input type="password" name="current_password" placeholder="Current password">
                </td>
            </tr>

            <tr>
                <td>New Password:</td>
                <td>       
                    <input type="password" name="new_password" placeholder="New password">
                </td>
            </tr>
            <tr>
                <td>confirm Password:</td>
                <td>
                    <input type="password" name="confirm_password" placeholder="confirm password">
                </td>
            </tr>

            <tr>
                <td colspan="2"> 
                <input type="hidden" name="id" value="<?php echo $id; ?>">      
                    <input type="submit" name="submit" value="Change password" class="btn-secondary">
                </td>
            </tr>

           </table>

           </form>
        </div>
</div>

<?php
//item

    //check whether the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        //echo "Button clicked";
        //Get all the data from form
        $id = $_POST['id'];
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);

        //check whether the user with current ID and current password Exists or not
        $sql= "SELECT * FROM tbl_admin WHERE id=$id AND PASSWORD='$current_password'";

        //Execute the query
        $res = mysqli_query($conn, $sql);

        if($res==true)
        {
            //check whether the data is available or not
            $count=mysqli_num_rows($res);
            if($count==1)
            {
                //user Exists and password can be changed
                //echo "user found";
                //Check whether the new password and confirm password match or not
                if($new_password==$confirm_password)
                {
                    //update the password
                    //echo "password match";
                    $sql2 = "UPDATE tbl_admin SET
                    password='$new_password'
                    WHERE id=$id
                    ";

                    //Execute the query
                    $res2 = mysqli_query($conn, $sql2);

                    if($res2==true)
                    {
                        // Display the message                         
                        //Redirect to manage admin page with error message
                        $_SESSION['change-pwd'] = "<div class='success'>Password changed successfully</div>";
                        //Redirect the user
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                    else
                    {
                        // Display the error message
                        //Redirect to manage admin page with error message
                        $_SESSION['change-pwd'] = "<div class='success'> Failed to change password.</div>";
                        //Redirect the user
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }

                    //Check whether the query executed or not
                }
                else
                {
                    //Redirect to manage admin page with error message
                    $_SESSION['pwd-not-match'] = "<div class='error'>Password did not match</div>";
                     //Redirect the user
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
            else
            {
                //user does not exists set manage and redirect
                $_SESSION['user-not-found'] = "<div class='error'>User not found.</div>";

                //Redirect the user
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
        }

    }

?>



<?php include('partials/footer.php'); ?>