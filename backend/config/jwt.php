<?php
require "../vendor/autoload.php";
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$secret_key = "typeshit";

function generateJWT($user_id, $username, $email) {
    global $secret_key;

    $payload = [
        "iat" => time(), //issued at
        "exp" => time() + (60*60), //expiry 1 hr
        "user_id" =>  $user_id,
        "username" => $username,
        "email" => $email
    ];

    return JWT::encode($payload, $secret_key, "HS256");
}

function verifyJWT($jwt) {
    global $secret_key;
    try {
        return JWT::decode($jwt, new Key($secret_key, "HS256"));
    } catch (Exception $e) {
        return null;
    }
}

?>
