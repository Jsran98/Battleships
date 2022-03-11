<?php
session_start();

$username = $_SESSION['username'];

$dbhost = "localhost"; // default server name
$dbuser = "root"; //
$dbpass = "root";
$db = "battleships";

$conn = new mysqli($dbhost,$dbuser,$dbpass,$db);

$need = mysqli_query($conn,"SELECT * FROM `lobby` WHERE currStatus = 'nil'");

$check = mysqli_query($conn,"SELECT * FROM `lobby` WHERE p1 = '$username' OR p2 = '$username'");



if((mysqli_num_rows($need) == 0)){ //not found
    if(mysqli_num_rows($check) > 0){
        return;
    }   
    else{
        $sql = "INSERT INTO lobby (currStatus,p1,p2,currTurn) 
        VALUES ('nil','$username','nil','nil');";  // do not forget the ; after each block for the multiquery
        mysqli_query($conn, $sql);
        $_SESSION["opp_ident"] = "p2";

        $id = mysqli_query($conn,"SELECT * FROM `lobby` WHERE currStatus = 'nil' AND p1 = '$username'");
        $val = mysqli_fetch_array($id); 
        $_SESSION['lobby_id'] = $val["lobby_id"];
    }
}
else{ // found
    if(mysqli_num_rows($check) > 0){
        return;
    }
    else{
    $val = mysqli_fetch_array($need); 
    $_SESSION['lobby_id'] = $val["lobby_id"];
    $id = $_SESSION['lobby_id'];
    $p1 = $val["p1"];

    $p2assign = mysqli_query($conn, "UPDATE lobby SET p2 = '$username', currStatus ='active' , currTurn = '$p1'
                                WHERE lobby_id = '$id'");
    
    $_SESSION["opp_ident"] = "p1";

    }
}

$conn->close();

?>
