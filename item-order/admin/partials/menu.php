<?php 

    include('config/constants.php');
    include('login-check.php');

?>




<html>
    <head>
        <title>Medicure website- Admin pannel</title>

        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        <!--menu section starts-->
        <div class="menu">
           <div class="wrapper">
           <ul >
               <li><a href="index.php"> Home </a> </li>
               <li><a href="manage-admin.php"> Admin </a> </li>
               <li><a href="manage-category.php"> category </a> </li>
               <li><a href="manage-item.php"> Item </a> </li>
               <li><a href="manage-order.php"> Order </a> </li>
               <li><a href="logout.php"> Logout </a> </li>
           </ul>
           </div>
        </div>
        <!--menu section ends-->