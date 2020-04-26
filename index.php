<?php
opcache_reset();
$con = mysqli_connect("localhost","root","mitzap9080","social");

if(mysqli_connect_errno()){
    echo "Failed to Connect ".mysqli_connect_errno();
}

$query = mysqli_query($con, "INSERT INTO test VALUES(NULL,'Lori')");

?>

<!DOCTYPE html>
<html>
<head>
<title>Social Website</title>
</head>
<body>
<p>testing</p>
</body>
</html>