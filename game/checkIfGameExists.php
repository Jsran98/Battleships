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

$need = mysqli_query($conn,"SELECT * FROM lobby WHERE lobby_id = '$lobby_id'");


if((mysqli_num_rows($need) > 0)){ // game does exist
    echo '1';
}
else{ // if game does not exist
    echo '0';
}

$conn->close();



?>