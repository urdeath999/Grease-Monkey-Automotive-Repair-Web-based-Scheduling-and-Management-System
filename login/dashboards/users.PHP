<?php
session_start ();
 require 'connect.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dashh.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymouse">
    <title>Dashboard</title>
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
                        <span class="sidebar--item">notification</span>
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
        <div class="main--content">
            <div class="overview">
                <div class="title">
            
                </div>
                
            </div>
            <div class="doctors">
                <div class="title">
                    <div class="doctors--right--btns">
                        </select>
                    </div>
                </div>
                <div class="doctors--cards">
                    <a href="#" class="doctor--card">
                        <div class="img--box--cover">
                            <div class="img--box">
                                <img src="m1.png" alt="">
                            </div>
                        </div>
                        <p class="free">Free</p>
                    </a>
                    <a href="#" class="doctor--card">
                        <div class="img--box--cover">
                            <div class="img--box">
                                <img src="m2.png" alt="">
                            </div>
                        </div>
                        <p class="scheduled">Scheduled</p>
                    </a>
                    <a href="#" class="doctor--card">
                        <div class="img--box--cover">
                            <div class="img--box">
                                <img src="m3.png" alt="">
                            </div>
                        </div>
                        <p class="scheduled">Scheduled</p>
                    </a>
                    <a href="#" class="doctor--card">
                        <div class="img--box--cover">
                            <div class="img--box">
                                <img src="assets/images/doctor4.jpg" alt="">
                            </div>
                        </div>
                        <p class="free">Free</p>
                    </a>
             
                </div>
            </div>


    <div class="recent--patients">
        <div class="title">
            <h2 class="section--title">Users</h2>
        </div>
        <div class="container">
        
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>Users 
                                <a href="apps.php" class="btn btn-primary float-end"> Add User</a>
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
                                    
                                        <th>Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                        $query = "SELECT * FROM users";
                                        $query_run = mysqli_query($conn,$query);

                                        if(mysqli_num_rows($query_run) > 0){
                                            foreach($query_run as $user){
                                              
                                                ?>
                                                <tr>
                                                    <td> <?=$user ['id']; ?> </td>
                                                    <td><?=$user ['fullName']; ?></td>
                                                    <td><?=$user ['email']; ?></td>
                                                    <td><?=$user ['contact']; ?></td>
                                                   

                                                    <td>
                                                    <a href="dash.php" class="btn btn-success btn-sm"> Confirm </a>
                                                    <a href="" class="btn btn-warning btn-sm"> Pending </a>
                                                    <form action="dashad.php" method="post" class="d-inline">
                                                        <button type="submit" name="delete_user" value="<?= $user['id'];?>" class="btn btn-danger btn-sm"> Delete </button>
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


        </div>
  </div>
</div>
</section>
<script src="board.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
   
</body>
</html>