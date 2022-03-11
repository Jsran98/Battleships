<?php

$dbhost = "localhost"; 
$dbuser = "root"; 
$dbpass = "root"; // for mamp
//for Windows pass = ""
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

/*
$sql = "INSERT INTO players (email,user,pass,won_games,time_played,games_played,matrix,numShips) 
VALUES ('dummy@fresnostate.edu','dummy','password',0,0,0,'$insertval',0);";  // do not forget the ; after each block for the multiquery
*/

mysqli_query($conn, "INSERT INTO players (email,user,pass,won_games,time_played,games_played,matrix,numShips) 
VALUES ('dummy@fresnostate.edu','dummy','password',0,0,0,'$insertval',0);");
echo "user 1 Data Inserted";

mysqli_query($conn, "INSERT INTO players (email,user,pass,won_games,time_played,games_played,matrix,numShips) 
VALUES ('jagdeepsran98@fresnostate.edu','cactusjag','password',7,7,7,'$insertval',0);");
echo "user 2 Data Inserted";

mysqli_query($conn, "INSERT INTO players (email,user,pass,won_games,time_played,games_played,matrix,numShips) 
VALUES ('dylanmessenger@fresnostate.edu','crimsonfire','password',3,20,3,'$insertval',0);");
echo "user 3 Data Inserted";

mysqli_query($conn, "INSERT INTO players (email,user,pass,won_games,time_played,games_played,matrix,numShips) 
VALUES ('harrrypotter@hogwarts.edu','wizard','password',20,500,30,'$insertval',0);");
echo "user 4 Data Inserted";

mysqli_query($conn, "INSERT INTO players (email,user,pass,won_games,time_played,games_played,matrix,numShips) 
VALUES ('thechosenone@jedi.org','darthvader','password',66,1000,81,'$insertval',0);");
echo "user 5 Data Inserted";

mysqli_query($conn, "INSERT INTO players (email,user,pass,won_games,time_played,games_played,matrix,numShips) 
VALUES ('songoku@kamehouse.dbz','goku','password',9009,9009,9009,'$insertval',0);");
echo "user 6 Data Inserted";




$conn->close();

?>
