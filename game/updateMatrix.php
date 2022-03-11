<?php

session_start();

$json = $_POST['jsonData'];

$dbhost = "localhost"; // default server name
$dbuser = "root"; //
$dbpass = "root";
$db = "battleships";

$conn = new mysqli($dbhost,$dbuser,$dbpass,$db);

$sql = "UPDATE players SET matrix = '$json' WHERE user = '{$_SESSION['username']}'";

$result = mysqli_query($conn,$sql);

$sql2 = "UPDATE players SET numShips = '5' WHERE user = '{$_SESSION['username']}'";

$result2 = mysqli_query($conn,$sql2);


$conn->close();


?>
