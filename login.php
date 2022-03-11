<?php
session_start();

if($_POST){

$username = $_POST['username'];
$password = $_POST['password'];

$dbhost = "localhost"; // default server name
$dbuser = "root"; //
$dbpass = "root";
$db = "battleships";

$conn = new mysqli($dbhost,$dbuser,$dbpass,$db);

$sql = "SELECT * FROM `players` WHERE user = '$username' AND pass = '$password'";

$result = mysqli_query($conn,$sql);

if((mysqli_num_rows($result) > 0)){
    $_SESSION['username'] = $username;
    header('location:index.php');
}
else{
    
    echo "Login failed: wrong username or password";

    header('location:login_page.php');
}

$conn->close();

}

?>