<?php
session_start();
$username = $_SESSION['username'];

$timeElap = $_POST['timeElap'];

$dbhost = "localhost"; // default server name
$dbuser = "root"; //
$dbpass = "root";
$db = "battleships";

$conn = new mysqli($dbhost,$dbuser,$dbpass,$db);

$sql = "UPDATE players SET matrix = '$json' WHERE user = '{$_SESSION['username']}'";

$result = mysqli_query($conn,"UPDATE players SET time_played = time_played + '$timeElap', games_played = games_played + 1 WHERE user = '$username'");

$conn->close();

?>
