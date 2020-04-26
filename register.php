<?php
opcache_reset();

session_start();

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
$error_array = array();

if(isset($_POST['reg_btn'])){

    //firstname
    $fname = strip_tags($_POST["reg_fname"]); //Remove HTML Tags
    $fname = str_replace(' ','',$fname); //Remove Spaces
    $fname = ucfirst(strtolower($fname)); //Convert to lowercase and Capitalize first letter
    $_SESSION['reg_fname'] = $fname;

    //lastname
    $lname = strip_tags($_POST["reg_lname"]); //Remove HTML Tags
    $lname = str_replace(' ','',$lname); //Remove Spaces
    $lname = ucfirst(strtolower($lname)); //Convert to lowercase and Capitalize first letter
    $_SESSION['reg_lname'] = $lname;

    //Email
    $em = strip_tags($_POST["reg_email"]); //Remove HTML Tags
    $em = str_replace(' ','',$em); //Remove Spaces
    $em = ucfirst(strtolower($em)); //Convert to lowercase and Capitalize first letter
    $_SESSION["reg_email"] = $em;

    //Email 2
    $em2 = strip_tags($_POST["reg_email2"]); //Remove HTML Tags
    $em2 = str_replace(' ','',$em2); //Remove Spaces
    $em2 = ucfirst(strtolower($em2)); //Convert to lowercase and Capitalize first letter
    $_SESSION["reg_email2"] = $em2;

     //Password
     $password = strip_tags($_POST["reg_password"]); //Remove HTML Tags

      //Email
    $password2 = strip_tags($_POST["reg_password2"]); //Remove HTML Tags

    $date = date("Y-m-d"); // Get current date

    if($em == $em2){
        if(filter_var($em, FILTER_VALIDATE_EMAIL)){

            $em = filter_var($em,FILTER_VALIDATE_EMAIL);
            //Check if e-mail already exists
            $e_check = mysqli_query($con,"SELECT email FROM users WHERE email='$em'");

            $num_rows = mysqli_num_rows($e_check);

            if($num_rows > 0){
                array_push($error_array,"Email already in use<br/>");    
            }
        }
        else{
            array_push($error_array,"Invalid email format<br/>");
        }
    }
    else{
        array_push($error_array,"Emails don't match<br/>");
    }

    if(strlen($fname) > 25 || strlen($fname) < 2){
    array_push($error_array,"Your first name must be between 2 and 25 characters<br/>");
};
    if(strlen($lname) > 25 || strlen($lname) < 2){
    array_push($error_array,"Your last name must be between 2 and 25 characters long<br/>");
    }
    if($password != $password2){
    array_push($error_array,"Your passwords do not match<br/>");
    }
    else {
        if(preg_match('/[^A-Za-z0-9]/',$password)){
            array_push($error_array,"Your password can only contain english characters and numbers<br/>");
        }
    }
    if(strlen($password) > 30 || strlen($password) < 5)
    {

        array_push($error_array,"Your password must be between 5 and 30 characters<br/>");
    }

    if(empty($error_array)){
        $password = md5($password);
        $username = strtolower($fname . "_" . "lname");
        $check_username_query = mysqli_query($con,"SELECT username FROM users WHERE username = '$username'");
        $i = 0;
        while(mysqli_num_rows($check_username_query) != 0){
            $i ++;
            $username = $username . "_" . $i;
            $check_username_query = mysqli_query($con,"SELECT username FROM users WHERE username = '$username'");
        }
        $random = rand(1,2);
        switch($random){
            case 1:
                $profile_pic = "E:\Apps\WAMP\apache2\htdocs\Social-Site\assets\images\profile_pics\defaults\head_deep_blue.png";
            break;
            case 2:
                $profile_pic = "E:\Apps\WAMP\apache2\htdocs\Social-Site\assets\images\profile_pics\defaults\head_carrot.png";
            break;

        }
        $query = mysqli_query($con, "INSERT INTO users VALUES(NULL,'$fname','$lname','$username','$em','$password','$date','$profile_pic','0','0','no',',')");
        array_push($error_array,"<span style='color: #14C800 '>Account successfully created. You can now log in!</span>");

        //Session Clear Variables

        $_SESSION['reg_fname'] = "";
        $_SESSION['reg_lname'] = "";
        $_SESSION['reg_email'] = "";
        $_SESSION['reg_email2'] = "";
    }
}
?>
<DOCTYPE html>
<html>
<head>
<title>Social Website</title>
</head>
<body>

<form action="register.php" method="POST">
    <input type="text" name="reg_fname" placeholder="First Name" value= '<?php if(isset($_SESSION['reg_fname'])){
        echo $_SESSION['reg_fname'];
    }?>' required>
    <br/>
    <?php if(in_array("Your first name must be between 2 and 25 characters<br/>",$error_array)) echo "Your first name must be between 2 and 25 characters<br/>";?>
    <input type="text" name="reg_lname" placeholder="Last Name"value= '<?php if(isset($_SESSION['reg_lname'])){
        echo $_SESSION['reg_lname'];
    }?>' required>
    <br/>
    <?php if(in_array("Your last name must be between 2 and 25 characters long<br/>",$error_array)) echo "Your last name must be between 2 and 25 characters long<br/>";?>   
    <input type="email" name="reg_email" placeholder="Email address" value = '<?php if(isset($_SESSION['reg_email'])){
        echo $_SESSION['reg_email'];
    }
    ?>' required>
    <br/>
    
    <input type="email" name="reg_email2" placeholder="Confirm Email Address" required>
    <br/>
    
    <?php if(in_array("Email already in use<br/>",$error_array)) echo "Email already in use<br/>";
     else if(in_array("Invalid email format<br/>",$error_array)) echo "Invalid email format<br/>";
     else if(in_array("Emails don't match<br/>",$error_array)) echo "Emails don't match<br/>"; ?>
    <input type="password" name="reg_password" placeholder="Password" required>
    <br/>
    <input type="password" name="reg_password2" placeholder="Confirm Password" required>
    <br/>
    <?php if(in_array("Your passwords do not match<br/>",$error_array)) echo "Your passwords do not match<br/>";
     else if(in_array("Your password can only contain english characters and numbers<br/>",$error_array)) echo "Your password can only contain english characters and numbers<br/>";
     else if(in_array("Your password must be between 5 and 30 characters<br/>",$error_array)) echo "Your password must be between 5 and 30 characters<br/>"; ?>
    <input type="submit" name="reg_btn" value="Register" />
    <br/>
    <?php if(in_array("<span style='color: #14C800 '>Account successfully created. You can now log in!</span>",$error_array)) echo "<span style='color: #14C800 '>Account successfully created. You can now log in!</span>"?>
</form>

</body>
</html>