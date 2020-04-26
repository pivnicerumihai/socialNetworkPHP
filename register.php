<?php
$con = mysqli_connect("localhost","root","mitzap9080","social");

if(mysqli_connect_errno()){
    echo "Failed to Connect ".mysqli_connect_errno();
}

$fname = "";
$lname = "";
$em = "";
$em2 = "";
$password = "";
$password2 = "";
$date = ""; 
$error_array = "";

if(isset($_POST("reg_btn"))){

    //firstname
    $fname = strip_tags($_POST["reg_fname"]); //Remove HTML Tags
    $fname = str_replace(' ','',$fname); //Remove Spaces
    $fname = ucfirst(strtolower($fname)); //Convert to lowercase and Capitalize first letter

    //lastname
    $lname = strip_tags($_POST["reg_lname"]); //Remove HTML Tags
    $lname = str_replace(' ','',$lname); //Remove Spaces
    $lname = ucfirst(strtolower($lname)); //Convert to lowercase and Capitalize first letter

    //Email
    $em = strip_tags($_POST["reg_email"]); //Remove HTML Tags
    $em = str_replace(' ','',$em); //Remove Spaces
    $em = ucfirst(strtolower($em)); //Convert to lowercase and Capitalize first letter

    //Email 2
    $em2 = strip_tags($_POST["reg_email2"]); //Remove HTML Tags
    $em2 = str_replace(' ','',$em2); //Remove Spaces
    $em2 = ucfirst(strtolower($em2)); //Convert to lowercase and Capitalize first letter

     //Password
     $password = strip_tags($_POST["reg_password"]); //Remove HTML Tags

      //Email
    $password2 = strip_tags($_POST["reg_password2"]); //Remove HTML Tags

    $date = date("d-m-Y"); // Get current date

}
?>
<DOCTYPE html>
<html>
<head>
<title>Social Website</title>
</head>
<body>

<form action="register.php" method="POST">
    <input type="text" name="reg_fname" placeholder="First Name" required>
    <br/>
    <input type="text" name="reg_lname" placeholder="Last Name" required>
    <br/>
    <input type="email" name="reg_email" placeholder="Email address" required>
    <br/>
    <input type="email" name="reg_email2" placeholder="Confirm Email Address" required>
    <br/>
    <input type="password" name="reg_password" placeholder="Password" required>
    <br/>
    <input type="password" name="reg_password2" placeholder="Confirm Password" required>
    <br/>
    <input type="submit" name="reg_btn" value="Register" />
</form>

</body>
</html>