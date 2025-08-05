<?php
$host= "localhost";
$user = "root";
$pass ="";
$db = "practisdb";

$conn = mysqli_connect($host, $user, $pass, $db);
if (mysqli_connect_errno()) {
    echo "connection failed". mysqli_connect_error();
    exit();
}

?>