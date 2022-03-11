<?php

if($_POST){

    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $dbhost = "localhost"; // default server name
    $dbuser = "root"; //
    $dbpass = "root";
    $db = "battleships";
    
    $matrix = [0,0,0,0,0,0,0,0,0,0,
           0,0,0,0,0,0,0,0,0,0,
           0,0,0,0,0,0,0,0,0,0,
           0,0,0,0,0,0,0,0,0,0,
           0,0,0,0,0,0,0,0,0,0,
           0,0,0,0,0,0,0,0,0,0,
           0,0,0,0,0,0,0,0,0,0,
           0,0,0,0,0,0,0,0,0,0,
           0,0,0,0,0,0,0,0,0,0,
           0,0,0,0,0,0,0,0,0,0];

    $insertval = json_encode($matrix);
    
    
    $conn = new mysqli($dbhost,$dbuser,$dbpass,$db);
    
    $sql = "INSERT INTO players (email,user,pass,won_games,time_played,games_played,matrix,numShips) 
    VALUES ('$email','$username','$password',0,0,0,'$insertval',0);";  // do not forget the ; after each block for the multiquery
    
    mysqli_query($conn, $sql);
    

    header('location:index.php');
    
    
    $conn->close();
    
    }



?>
