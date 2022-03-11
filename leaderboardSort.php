<?php

$dbhost = "localhost"; // default server name
$dbuser = "root"; //
$dbpass = "root";
$db = "battleships";

$receive = $_POST['indicate'];

$conn = new mysqli($dbhost,$dbuser,$dbpass,$db);
// Check connection
if($receive == "play"){
    $result = mysqli_query($conn,"SELECT user, games_played,won_games,time_played FROM `players` ORDER BY `players`.`games_played` DESC ");
}
else if($receive == "won"){
    $result = mysqli_query($conn,"SELECT user, games_played,won_games,time_played FROM `players` ORDER BY `players`.`won_games` DESC ");
}
else if($receive == "time"){
    $result = mysqli_query($conn,"SELECT user, games_played,won_games,time_played FROM `players` ORDER BY `players`.`time_played` DESC ");
}   

echo "<table id = 'leadtable'>
<tr>
<th>User</th>
<th>Games Played</th>
<th>Games Won</th>
<th>Time Played</th>
</tr>";

while($row = mysqli_fetch_array($result))
{
$init = $row['time_played'];
$hours = floor($init / 3600);
$minutes = floor(($init / 60) % 60);
$seconds = $init % 60;
echo "<tr>";
echo "<td>" . $row['user'] . "</td>";
echo "<td>" . $row['games_played'] . "</td>";
echo "<td>" . $row['won_games'] . "</td>";
//echo "<td>" . $row['time_played'] . "</td>";
echo "<td> $hours:$minutes:$seconds </td>";
echo "</tr>";
}
echo "</table>";


$conn->close();

?>
