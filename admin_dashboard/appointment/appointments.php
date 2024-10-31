<?php

require 'connect.php';

?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
  <section class="header">
        <div class="logo">
            <i class="ri-menu-line icon icon-0 menu"></i>
            <h2>GREASE<span>MONKEY</span></h2>
        </div>
        <div class="search--notification--profile">
            <div class="search">
                <input type="text" placeholder="Search Scdule..">
                <button><i class="ri-search-2-line"></i></button>
            </div>
            <div class="notification--profile">
                <div class="picon bell">
                    <i class="ri-notification-2-line"></i>
                </div>
                <div class="picon chat">
                    <i class="ri-mail-line"></i>
                </div>
                <div class="picon profile">
                    <img src="logo.jpg" alt="">
                </div>
            </div>
        </div>
    </section>
    <section class="main">
    <?php include('mess.php'); ?>
        <div class="sidebar">
            <ul class="sidebar--items">
                <li>
                    <a href="dash.php" id="active--link">
                        <span class="icon icon-1"><i class="ri-layout-grid-line"></i></span>
                        <span class="sidebar--item">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="appointments.php">
                        <span class="icon icon-2"><i class="ri-calendar-2-line"></i></span>
                        <span class="sidebar--item">Appointment</span>
                    </a>
                </li>
                <li>
                    <a href="users.php">
                        <span class="icon icon-3"><i class="ri-user-2-line"></i></span>
                        <span class="sidebar--item" style="white-space: nowrap;">Users</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon icon-4"><i class="ri-notification-2-line"></i></span>
                        <span class="sidebar--item">Notification</span>
                    </a>
                </li>
            </ul>
            <ul class="sidebar--bottom-items">
                <li>
                    <a href="#">
                        <span class="icon icon-7"><i class="ri-settings-3-line"></i></span>
                        <span class="sidebar--item">Settings</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon icon-8"><i class="ri-logout-box-r-line"></i></span>
                        <span class="sidebar--item">Logout</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>Appointment Details
                                <a href="apps.php" class="btn btn-primary float-end"> Add Appointment </a>
                            </h3>
                        </div>
                        <div class="card-body">
                             <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Number</th>
                                        <th>Date</th>
                                        <th>Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                        $query = "SELECT * FROM appoints";
                                        $query_run = mysqli_query($con,$query);

                                        if(mysqli_num_rows($query_run) > 0){
                                            foreach($query_run as $name){
                                              
                                                ?>
                                                <tr>
                                                    <td> <?=$name ['id']; ?> </td>
                                                    <td><?=$name ['name']; ?></td>
                                                    <td><?=$name ['email']; ?></td>
                                                    <td><?=$name ['number']; ?></td>
                                                    <td><?=$name ['date']; ?></td>
                                                    <td>
                                                    <a href="" class="btn btn-success btn-sm"> Confirm </a>
                                                    <a href="" class="btn btn-warning btn-sm"> Pending </a>
                                                    <form action="dbcon.php" method="post" class="d-inline">
                                                        <button type="submit" name="cancel_client" value="<?= $name['id'];?>" class="btn btn-danger btn-sm"> Cancel </button>
                                                    </form>
                                            </td>

                                                 </tr>
                                                 <?php
                                            }

                                        }
                                        else {
                                            echo "<h3> No Record Found </h3>";
                                        }
                                    ?>

                                    
                                </tbody>
                             </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>
<html>