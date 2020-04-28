<?php

require 'config/config.php';
require 'includes/form_handlers/register_handler.php';
require 'includes/form_handlers/login_handler.php';

?>
<DOCTYPE html>
<html>
<head>
    <title>Social Website</title>
    <link rel="stylesheet" type="text/css" href="assets/css/register.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="assets/js/register.js"></script>
</head>
<body>

<?php 

if(isset($_POST["reg_btn"])){
    echo '
    <script>

    $(document).ready(function(){
        $("#first").hide();
        $("#second").show();
    });

    </script>
    ';
}


?>

<div class="form-wrapper" >
    
    <div class="login-box">
        <div class="login-header">
            <h1>Code feed</h1>
            Login or Signup below!
        </div>
        <div id="first">
            <form action = "register.php" method="POST">
                <input type="email" name="log_email" placeholder="Email Address" value="
                <?php if(isset($_SESSION["log_email"])){
                        echo $_SESSION["log_email"];
                }?>" required/>
                <br/>
                <input type="password" name="log_password" placeholder="Password"/>
                <br/>
                <?php 
                if(in_array("Email or password was incorrect<br>",$error_array)){
                    echo "Email or password was incorrect <br/>";
                }
                ?>
                <input type="submit" name="login_button" value="Login"/>
               
                <br/>
                <a href="#" id="signup" class="signup">Need an account? Register here!</a>
            </form>
        </div>
        
        <div id="second">
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
                <br/>
                <a href="#" id="signin" class="signin">Already have an account? Sign In here!</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>