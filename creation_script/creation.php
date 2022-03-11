<?php

$dbhost = "localhost"; // default server name
$dbuser = "root"; //
$dbpass = "root";
$db = "battleships";


// Create connection
$conn = new mysqli($dbhost,$dbuser,$dbpass);


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error ."<br>");
} 
echo "Connected successfully <br>";


// Creation of the database
$sql = "CREATE DATABASE $db";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully<br>";
} else {
    echo "Error creating database: " . $conn->error ."<br>";
}

// close the connection
$conn->close();


// Create connection
$conn = new mysqli($dbhost,$dbuser,$dbpass,$db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "CREATE TABLE players (
    id INT(6) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, 
    email VARCHAR(100) NOT NULL UNIQUE,
    user VARCHAR(30) NOT NULL UNIQUE, 
    pass VARCHAR(30) NOT NULL,
    won_games INT(6) UNSIGNED,
    time_played INT(6) UNSIGNED,
    games_played INT(6) UNSIGNED,
    matrix VARCHAR(500) NOT NULL,
    numShips INT(6) UNSIGNED
    )";


if ($conn->query($sql) === TRUE) {
    echo "Table player created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error ."<br>";
}
$conn->close();


// Create connection
$conn = new mysqli($dbhost,$dbuser,$dbpass,$db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


$sql = "CREATE TABLE lobby (
    lobby_id INT(6) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, 
    currStatus VARCHAR(30) NOT NULL,
    p1 VARCHAR(30) NOT NULL, 
    p2 VARCHAR(30) NOT NULL,
    currTurn VARCHAR(30) NOT NULL
    )";

if ($conn->query($sql) === TRUE) {
    echo "Table lobby created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error ."<br>";
}
$conn->close();
?>
