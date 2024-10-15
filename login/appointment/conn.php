<?php

$con=mysqli_connect("localhost" , "root" , "", "appont");

    if(!$con){
        die('Connection Failed !' .mysqli_connect_error());
    }
?>  