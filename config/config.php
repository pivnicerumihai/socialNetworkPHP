<?php

ob_start();
opcache_reset();
session_start();

$timezone = date_default_timezone_set("Europe/London");

$con = mysqli_connect("localhost","root","mitzap9080","social");

if(mysqli_connect_errno()){
    echo "Failed to Connect ".mysqli_connect_errno();
}
?>