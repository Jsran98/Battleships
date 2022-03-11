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

$req2 = mysqli_query($conn,"SELECT matrix FROM players WHERE user = '$username'");
$val3 = mysqli_fetch_array($req2);
$opp_matrix = json_decode($val3['matrix']);

$lost;


if(in_array('1',$opp_matrix)){
    $lost = 0;
    echo $lost;
}
else{
    $lost = 1;
    echo $lost;
}

$conn->close();

?>
 
