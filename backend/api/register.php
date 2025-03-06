<?php
include("../config/db.php"); //connect to db

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"]==="POST"){
    $data = json_decode(file_get_contents("php://input"), true);
    $username = $data["username"];
    $email = $data["email"];
    $password = password_hash($data["password"], PASSWORD_DEFAULT);

    try {
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
        $stmt-> bindParam(":username", $username);
        $stmt -> bindParam(":email", $email);
        $stmt-> bindParam(":password", $password);
        $stmt->execute();

        echo json_encode(['message' => "user registered successfully"]);
    } catch (PDOException $e) {
        echo json_encode(["error" => $e->getMessage()]);
    }

}




?>