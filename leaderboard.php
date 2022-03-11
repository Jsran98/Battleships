<?php
session_start();

$dbhost = "localhost"; // default server name
$dbuser = "root"; //
$dbpass = "root";
$db = "battleships";

$conn = new mysqli($dbhost,$dbuser,$dbpass,$db);
// Check connection

$result = mysqli_query($conn,"SELECT user, games_played,won_games,time_played FROM players");

echo "
<html>
<head>
<meta charset='UTF-8'>
<link rel = 'stylesheet' href='leaderboard.css'>
</head>
<body>
<div id = 'tableDiv'>
<div id = 'sort-options'>
<button id = 'byWon' onclick = 'byWon()'>Sort By Won</button>
<button id = 'byPlay' onclick = 'byPlay()'>Sort By Played</button>
<button id = 'byTime' onclick = 'byTime()'>Sort By Time</button>
<button id = 'return' onclick = 'goBack()'>Back to Menu</button>
</div>
<div id = 'insert'>
";

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
echo "</table>
</div>
";

echo "
</div>
<script src = './leaderboard.js'></script>
</body>
</html>
";


$conn->close();
?>

