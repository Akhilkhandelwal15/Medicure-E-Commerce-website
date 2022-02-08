<?php include('partials/menu.php'); ?>


        <!--main content section starts-->
        <div class="main-content">
        <div class="wrapper">
           <h1>Manage admin</h1><br> 



           <?php
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];  //Displaying session message
                    unset($_SESSION['add']); //Removing session message
                }
                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];  //Displaying session message
                    unset($_SESSION['delete']); //Removing session message
                }
                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];  //Displaying session message
                    unset($_SESSION['update']); //Removing session message
                }
                if(isset($_SESSION['user-not-found']))
                {
                    echo $_SESSION['user-not-found'];  //Displaying session message
                    unset($_SESSION['user-not-found']); //Removing session message
                }
                if(isset($_SESSION['pwd-not-match']))
                {
                    echo $_SESSION['pwd-not-match'];  //Displaying session message
                    unset($_SESSION['pwd-not-match']); //Removing session message
                }
                if(isset($_SESSION['change-pwd']))
                {
                    echo $_SESSION['change-pwd'];  //Displaying session message
                    unset($_SESSION['change-pwd']); //Removing session message
                }

            ?>

            <br> <br> <br>




           <!-- button to add admin-->
           <a href="add-admin.php" class="btn-primary"> Add Admin </a> <br> <br> <br>
           <table class="tbl-full">
                <tr>
                    <th> S.N. </th>
                    <th> Full name </th>
                    <th> Username </th>
                    <th> Actions </th>
                </tr>


            
            <?php
                //Query to get all admin
                 $sql = "SELECT * FROM tbl_admin";
                 //Execute the query
                 $res = mysqli_query($conn, $sql);

                 //Check whether the query is executed or not
                 if($res==TRUE)
                 {
                     // Count Rows to check whether we have data in database or not
                     $count= mysqli_num_rows($res); //function to get all the rows from database

                     $sn=1; //create a variable and Assign the value

                     if($count>0)
                     {
                         // We have data in database
                         while($rows=mysqli_fetch_assoc($res))
                         {
                             //using while loop to get all the data from database
                             //And while loop will run as long as we have data in database

                             //get individual data
                             $id=$rows['id'];
                             $full_name=$rows['full_name'];
                             $username=$rows['username'];

                             //Display the values in our table
                             ?>

                            <tr>
                                <td><?php echo $sn++; ?>. </td>
                                <td><?php echo $full_name; ?></td>
                                <td><?php echo $username; ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo  $id; ?>" class="btn-primary">Change Password </a>
                                <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo  $id; ?>" class="btn-secondary"> Update Admin </a>
                                <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo  $id; ?>" class="btn-danger"> Delete Admin </a>
                            </td>
                            </tr>


                        <?php
                         }
                     }
  
                     else
                     {
                         //we do not have data in database
                     }

                 }
            ?>
                

            </table>

           
           </div>
        </div>
        <!--main containt section ends-->


<?php include('partials/footer.php') ?>