<?php
session_start();

include("../config/db.php");
include("../config/jwt.php");

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

if($_SERVER["REQUEST_METHOD"]==="POST"){
    $data= json_decode(file_get_contents("php://input"), true);
    $email = $data["email"];
    $password = $data["password"];

    try {
        //prepare and execute sql query
        $stmt = $conn->prepare("SELECT id, username, password, email FROM users WHERE email = :email");
        $stmt -> bindParam(":email", $email);
        $stmt->execute();

        //create and grab the user info from the database
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        //verify password
        if ($user && password_verify($password, $user["password"])) {

            $token = generateJWT($user["id"], $user['username'], $user['email']);

            echo json_encode([
                'message' => 'logged in successfully',
                'token' => $token,
                'user' => [
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'email' => $email

                ],
            ]);

        } else {
            echo json_encode(['error' => 'Incorrect email or password']);
        }

    } catch (PDOException $e){
        echo json_encode(["error" => $e->getMessage()]);
    }
}




?>