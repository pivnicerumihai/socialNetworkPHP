<?php
require "config/config.php";



if(isset($_SESSION['username'])){
    $userLoggedIn = $_SESSION['username'];
    $user_details_query =mysqli_query($con,"SELECT * FROM users WHERE username='$userLoggedIn'");
    $user = mysqli_fetch_array($user_details_query);    
}
else{
   header('Location:register.php');
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Welcome to Code Feed</title>

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Bootstrap -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<!-- Stylesheet -->
<link rel="stylesheet" href="assets/css/styles.css"/> 
<!-- Font Awesome -->
<script src="https://kit.fontawesome.com/b40597e3ea.js" crossorigin="anonymous"></script>

</head>
<body>  
    <div class="top_bar">
        <div class="logo">
            <a href="index.php">Code feed</a>
        </div>
        <nav>
            <a href="<?php echo $userLoggedIn; ?>">
        <?php  echo $user["first_name"] ?>
            </a>
            <a href="#">
        <i class="fas fa-home fa-2x"></i>
            </a>
        <a href="#">
        <i class="fas fa-envelope-open-text fa-2x"></i>
        </a>
        <a href="#">
        <i class="far fa-bell fa-2x"></i>
        </a>        
        <a href="#">
        <i class="fas fa-people-arrows fa-2x"></i>
        </a>    
        <a href="#">
        <i class="fas fa-cogs fa-2x"></i>
        </a>
        <a href="#">
        <i  class="fas fa-sign-out-alt fa-2x"></i>
        </a>
        </nav>
    </div>
    <div class="wrapper"> 
