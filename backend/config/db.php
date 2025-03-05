<?php
$host = 'localhost'; // this is the server
$dbname = "therapy_chat_db"; // this is the DB
$username = "root"; // this is the default username in xampp
$password = ""; // this is the usual in xampp

try{
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password); //pdo is a php data object thats specifically for databases.
    $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // this is the canary. the :: accesses the pdo properties of the pdo. attr is error handling, exception is the throw error action.
    echo "sucessfully connected to DB";
} catch (PDOException $e) { //pdoexception is a specialized class for error handling. if something goes wrong in try block, PDOEx is created and e is automatically created with the details
    echo "connection failed: ". $e->getMessage(); // . is equivilent to a "+", think concatenation. getMessage() is a function we're running on e, and it gives us the message.
}


?>