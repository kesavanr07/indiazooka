<?php

    
if($_SERVER['HTTPS']!="on") {
    $redirect= "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    header("Location:$redirect");
}

if($_SERVER['HTTP_HOST'] === 'localhost') {
    $servername = "localhost";
    $username   = "root";
    $password   = "";
    $dbname     = "indiazoo_blog";
} else {
    $servername = "localhost";
    $username   = "indiazoo";
    $password   = "yikYX7)@83rW4I";
    $dbname     = "indiazoo_blog";    
}

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>