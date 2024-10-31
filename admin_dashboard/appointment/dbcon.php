<?php 

session_start ();
require 'conn.php';

if (isset($_POST['cancel_client'])) {
    
    
    $name = mysqli_real_escape_string($con, $_POST['cancel_client']);
    
    $query = "DELETE FROM appoints WHERE id= '$name'";
    $query_run = mysqli_query($con, $query);

    if($query_run){
        $_SESSION ['message'] = 'Success!';
        header ('Location: apps.php');
        exit(0);

    }
    else {
        $_SESSION ['message'] = 'Already Book!';
        header ('Location: apps.php');
        exit(0);
    }
}



    if(isset($_POST ['appointment'])){
    $name = mysqli_real_escape_string ($con, $_POST['name']);
    $email = mysqli_real_escape_string ($con, $_POST['email']);
    $number = mysqli_real_escape_string ($con, $_POST['number']);
    $date = mysqli_real_escape_string ($con, $_POST['date']);
    }
    
    $query = "INSERT INTO appoints (name, email,number, date) VALUES('$name' , '$email' , '$number' , '$date')";

    $query_run = mysqli_query ($con, $query );
    if($query_run){
        $_SESSION ['message'] = 'Success!';
        header ('Location: apps.php');
        exit(0);

    }
    else {
        $_SESSION ['message'] = 'Already Book!';
        header ('Location: apps.php');
        exit(0);
    }

?>