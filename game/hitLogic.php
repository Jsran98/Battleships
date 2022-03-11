<?php
session_start();

$username = $_SESSION["username"];
$lobby_id = $_SESSION["lobby_id"];
$cell_id = $_POST['cell_id'];
$crossShot = $_POST['crossShot'];
$opp_ident = $_SESSION["opp_ident"];


$dbhost = "localhost"; // default server name
$dbuser = "root"; //
$dbpass = "root";
$db = "battleships";


$conn = new mysqli($dbhost,$dbuser,$dbpass,$db);

$need = mysqli_query($conn,"SELECT currTurn FROM `lobby` WHERE lobby_id = '$lobby_id'");

$val = mysqli_fetch_array($need); 

if($username == $val['currTurn']){ //Allow Move 

    $req = mysqli_query($conn, "SELECT $opp_ident FROM lobby WHERE lobby_id = '$lobby_id'");

    $val2 = mysqli_fetch_array($req);

    $opp_name = $val2[$opp_ident];

    $req2 = mysqli_query($conn,"SELECT matrix FROM players WHERE user = '$opp_name'");

    $val3 = mysqli_fetch_array($req2);

    $opp_matrix = json_decode($val3['matrix']);

    if ($crossShot == 0){
        if(($opp_matrix[$cell_id]) == 0){
            $opp_matrix[$cell_id] = 3;
            $jsonmatrix = json_encode($opp_matrix);
            $matrixupdate = mysqli_query($conn, "UPDATE players SET matrix = '$jsonmatrix' WHERE user = '$opp_name'");
            echo "miss";
            $changeTurn = mysqli_query($conn, "UPDATE lobby SET currTurn = '$opp_name' WHERE lobby_id = '$lobby_id'");
        }
        else if(($opp_matrix[$cell_id]) == 1){
            $opp_matrix[$cell_id] = 2;
            $jsonmatrix = json_encode($opp_matrix);
            $matrixupdate = mysqli_query($conn, "UPDATE players SET matrix = '$jsonmatrix' WHERE user = '$opp_name'");
            echo "hit";
            $changeTurn = mysqli_query($conn, "UPDATE lobby SET currTurn = '$opp_name' WHERE lobby_id = '$lobby_id'");
        }
    }
    else if($crossShot == 1){
        $tokenArr = [];
        $middle = $cell_id;
        if($cell_id - 10 < 0){
            $up = null;
        }
        else{
            $up = $cell_id-10;
        }
        if($cell_id + 10 > 99){
            $down = null;
        }
        else{
            $down = $cell_id + 10;
        }
        if(($cell_id-1) < 0 || ($cell_id-1) == 9 || ($cell_id-1) == 19 || ($cell_id-1) == 29 || ($cell_id-1) == 39 || 
            ($cell_id-1) == 49 || ($cell_id-1) == 59 || ($cell_id-1) == 69 || ($cell_id-1) == 79 || 
            ($cell_id-1) == 89 || ($cell_id-1) == 99){
            
            $left = null;
        }
        else{
            $left = $cell_id - 1;
        }


        if(($cell_id+1) == 10 || ($cell_id+1) == 20 || ($cell_id+1) == 30 || ($cell_id+1) == 40 || 
                ($cell_id+1) == 50 || ($cell_id+1) == 60 || ($cell_id+1) == 70 || ($cell_id+1) == 80 || 
                ($cell_id+1) == 90 || ($cell_id+1) > 99){
            $right = null;
                
        }
        else{
            $right = $cell_id+1;
        }


        $crossArr = [$middle,$up,$down,$left,$right];

        for($x=0; $x < count($crossArr); $x++){
            if($crossArr[$x] == null){
                array_push($tokenArr, "invalid");
            }
            else{
                if(($opp_matrix[$crossArr[$x]]) == 0){
                    $opp_matrix[$crossArr[$x]] = 3;   
                    array_push($tokenArr, "miss");
                }
                else if(($opp_matrix[$crossArr[$x]]) == 1){
                    $opp_matrix[$crossArr[$x]] = 2;
                    array_push($tokenArr, "hit");
                }
                
                else if(($opp_matrix[$crossArr[$x]]) == 2){
                    array_push($tokenArr, "invalid");
                }
                else if(($opp_matrix[$crossArr[$x]]) == 3){
                    array_push($tokenArr, "invalid");
                }
                
            }
        }

        //echo json_encode($tokenArr);

        $jsonmatrix = json_encode($opp_matrix);
        $matrixupdate = mysqli_query($conn, "UPDATE players SET matrix = '$jsonmatrix' WHERE user = '$opp_name'");
        echo json_encode($tokenArr);
        //echo $crossShot;
        $changeTurn = mysqli_query($conn, "UPDATE lobby SET currTurn = '$opp_name' WHERE lobby_id = '$lobby_id'");
        /*
        if(($opp_matrix[$cell_id]) == 0){
            


        }
        else if(($opp_matrix[$cell_id]) == 1){
            
        }
        */
    }

}
else {
    echo "invalid";
}

//echo $val['currTurn'];




$conn->close();
?>
