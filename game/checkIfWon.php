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

$req = mysqli_query($conn, "SELECT $opp_ident FROM lobby WHERE lobby_id = '$lobby_id'");

$val2 = mysqli_fetch_array($req);
$opp_name = $val2[$opp_ident];
$req2 = mysqli_query($conn,"SELECT matrix FROM players WHERE user = '$opp_name'");
$val3 = mysqli_fetch_array($req2);
$opp_matrix = json_decode($val3['matrix']);

$won = 0;


if(in_array('1',$opp_matrix)){
    $won = 0;
    echo $won;
}
else{
    $won = 1;
    echo $won;
}

?>
