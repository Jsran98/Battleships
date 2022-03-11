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

$need = mysqli_query($conn,"SELECT currStatus FROM `lobby` WHERE lobby_id = '$lobby_id'");

$val = mysqli_fetch_array($need); 

$req = mysqli_query($conn, "SELECT $opp_ident FROM lobby WHERE lobby_id = '$lobby_id'");

$val2 = mysqli_fetch_array($req);
$opp_name = $val2[$opp_ident];

if($val['currStatus'] == "nil"){
    echo '1';
}
else if($val['currStatus'] == "active"){
    echo $opp_name;
}

$conn->close();

?>
