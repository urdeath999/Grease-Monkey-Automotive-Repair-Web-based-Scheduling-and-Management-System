<?php
session_start();
session_destroy(); 
header("Location: users.php"); 
exit();
?>
