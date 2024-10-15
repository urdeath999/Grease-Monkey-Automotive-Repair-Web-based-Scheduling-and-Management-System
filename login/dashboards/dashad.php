<?php
session_start ();
require 'connect.php';
include 'register.php';


if (isset($_POST['delete_user'])) {
    
    
    $user = mysqli_real_escape_string($conn, $_POST['delete_user']);
    
    $query = "DELETE FROM users WHERE id= '$user'";
    $query_run = mysqli_query($conn, $query);

    if($query_run){
        $_SESSION ['message'] = 'Success!';
        header ('Location: users.php');
        exit(0);

    }
    else {
        $_SESSION ['message'] = 'Already Book!';
        header ('Location: users.php');
        exit(0);
    }
}

?>