<?php

session_start();

$username = $_SESSION["username"];

$dbhost = "localhost"; // default server name
$dbuser = "root"; //
$dbpass = "root";
$db = "battleships";


$conn = new mysqli($dbhost,$dbuser,$dbpass,$db);

$need = mysqli_query($conn,"SELECT * FROM `lobby` WHERE p1 = '$username' OR p2 = '$username'");

if((mysqli_num_rows($need) > 0)){ // found
    $need = mysqli_query($conn,"DELETE FROM lobby WHERE p1 = '$username' OR p2 = '$username'");
    echo '1';
}


$conn->close();




?>


