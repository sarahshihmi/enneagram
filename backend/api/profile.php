<?php

include('../middleware/auth.php');

echo json_encode([
    "message"=> "You are authorized.",
    "user" => [
        "id" => $decoded->user_id,
        "username" => $decoded->username,
        "email"=> $decoded->email
    ]
]);

?>