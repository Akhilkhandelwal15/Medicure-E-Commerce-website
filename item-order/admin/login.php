 <?php  include('config/constants.php'); ?> 



<html>
    <head>
        <title>Login- Admin Panel</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
    <section class="header">
            <video autoplay loop class="video-background" muted plays-inline>
                <source src="bgvideo.mp4" type="video/mp4">

            </video>
        <div class="login" >

            <h1 class="text-center">Login</h1><br><br>

            <?php
                if(isset($_SESSION['login']))
                  {
                      echo $_SESSION['login'];
                      unset($_SESSION['login']);
                  }
                if(isset($_SESSION['no-login-message']))
                  {
                        echo $_SESSION['no-login-message'];
                        unset($_SESSION['no-login-message']);
                  } 
            ?>
            <br><br>
            <!-- login form starts here -->
            <form action="" method="POST" class="text-center" >
            Username:<br>
            <input type="text" name="username" placeholder="Enter username"> <br> <br>
            Password:<br>
            <input type="password" name="password" placeholder="Enter password"> <br> <br>

            <input type="submit" name="submit" value="Login" class="btn-primary">
            </form><br>

            <!-- login form ends here -->

            <p class="text-center"> Medicure </p>
        </div>
        </section>
    </body>
</html>

<?php

          //check whether the submit button is clicked or not
          if(isset($_POST['submit']))
          {
              //process for login
              //1. Get the data login form
              $username = $_POST['username'];
              $password = md5($_POST['password']);

              //2.sql to check whether whether user with username and password exists or not 
              $sql= "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

              //3.Execute the query
              $res= mysqli_query($conn, $sql);

              //4. count rows to check whether the user exists or not 
              $count= mysqli_num_rows($res);

              if($count==1)
              {
                  //user Available and login success
                  $_SESSION['login'] = "<div class='success'>Login successful.</div>";
                  $_SESSION['user'] = $username; // To check whether user is loogged in or not and logout will unset it
                  
                  //Redirect to home page or dashboard
                  header('location:'.SITEURL.'admin/');
              }
              else
              {
                  //user not available and login failed
                  $_SESSION['login'] = "<div class='error text-center'>username or password did not match </div>";
                  //Redirect to home page or dashboard
                  header('location:'.SITEURL.'admin/login.php');

              }
          }



?>