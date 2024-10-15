<?php 
session_start ();
include 'connect.php';



if(isset($_POST['signUp'])){
    $fullName=$_POST['fName'];
    $email=$_POST['email'];
    $contact=$_POST['contact'];
    $password=$_POST['password'];
    $password=md5($password);

     $checkEmail="SELECT * From users where email='$email'";
     $result=$conn->query($checkEmail);
     if($result->num_rows>0){
        echo "Email Address Already Exists !";
     }
     else{
        $insertQuery="INSERT INTO users(fullName,email,contact,password)
                       VALUES ('$fullName','$email','$contact','$password')";
            if($conn->query($insertQuery)==TRUE){
                header("location: index.php");
            }
            else{
                echo "Error:".$conn->error;
            }
     }
   

}

if(isset($_POST['signIn'])){
   $email=$_POST['email'];
   $password=$_POST['password'];
   $password=md5($password) ;
   
   $sql="SELECT * FROM users WHERE email='$email' and password='$password'";
   $result=$conn->query($sql);
   if($result->num_rows>0){
    session_start();
    $row=$result->fetch_assoc();
    $_SESSION['email']=$row['email'];
    header("Location: grease.php");
    exit();
   }
   else{
    echo "Not Found, Incorrect Email or Password";
   }

}

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