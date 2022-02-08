<?php

    //Include constant.php for SITEURL
    include('config/constants.php');
    //1. Display the session
    session_destroy(); //unsets $_SESSION['user]

    //2. Redirect to login page
    header('location:'.SITEURL.'admin/login.php');
?>