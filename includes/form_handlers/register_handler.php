<?php
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
        $username = strtolower($fname . "_" . $lname);
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
                $profile_pic = '../../../Social-Site/assets/images/profile_pics/defaults/head_deep_blue.png';
            break;
            case 2:
                $profile_pic = "../../../Social-Site/assets/images/profile_pics/defaults/head_amethyst.png";
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