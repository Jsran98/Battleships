<?php

session_start();

$username = $_SESSION['username'];

$dbhost = "localhost"; // default server name
$dbuser = "root"; //
$dbpass = "root";
$db = "battleships";

$conn = new mysqli($dbhost,$dbuser,$dbpass,$db);

$req = mysqli_query($conn,"SELECT matrix FROM players WHERE user = '$username'");

$val = mysqli_fetch_array($req);

echo ($val['matrix']); // dont have this as json_encode



$conn->close();





?>
