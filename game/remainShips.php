<?php

session_start();


$dbhost = "localhost"; // default server name
$dbuser = "root"; //
$dbpass = "root";
$db = "battleships";

$numships = $_POST['numShips'];

$conn = new mysqli($dbhost,$dbuser,$dbpass,$db);

$sql2 = "UPDATE players SET numShips = '$numships' WHERE user = '{$_SESSION['username']}'";

$result2 = mysqli_query($conn,$sql2);

echo $numships;


$conn->close();


?>

