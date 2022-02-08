<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1> <br>


            <?php
                if(isset($_SESSION['add'])) //cheking whether the session is set or not
                {
                    echo $_SESSION['add'];  //Displaying session message
                    unset($_SESSION['add']); //Removing session message
                }
            ?>

    <!-- form creation -->
    <form action="" method="Post">
        <table class="tbl-30">
            <tr>
                <td>Full Name:</td>
                <td><input type="text" name="full_name" placeholder="Enter your name"></td>
            </tr>

            <tr>
                <td>Username:</td>
                <td><input type="text" name="username" placeholder="your username"></td>
            </tr>

            <tr>
                <td>Password:</td>
                <td><input type="password" name="password" placeholder="your password"></td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                </td>
            </tr>

        </table>
    </form>
    </div>

</div>




<?php include('partials/footer.php') ?>

<?php 

    // Check whether the submit button is clicked or not

    if(isset($_POST['submit']))
    {
        // Button clicked
        //echo "Button clicked";

        //1. Get data from form

        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); 

        //2. sql query to save data into database
        $sql= "INSERT INTO tbl_admin SET
            full_name='$full_name',
            username='$username',
            password='$password'
        ";

        //3.Executing query and saving data into database

        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        

        if($res==TRUE)
        {
            //Data Inserted
            //echo "Data Inserted";
            $_SESSION['add'] = "Admin added successfully";
            //Redirect page to manage admin
            header("location:".SITEURL.'admin/manage-admin.php');
        }

        else
        {
            // Failed to insert Data
            //echo "Failed to Insert Data";
            $_SESSION['add'] = "Failed to add Admin";
            //Redirect page to add admin
            header("location:".SITEURL.'admin/add-admin.php');
        }
    }

?>