<?php


session_start();

$username = $_SESSION["username"];
$lobby_id = $_SESSION["lobby_id"];
$opp_ident = $_SESSION["opp_ident"];


$dbhost = "localhost"; // default server name
$dbuser = "root"; //
$dbpass = "root";
$db = "battleships";


$conn = new mysqli($dbhost,$dbuser,$dbpass,$db);

$need = mysqli_query($conn,"DELETE FROM lobby WHERE lobby_id = '$lobby_id'");


$conn->close();


?>
