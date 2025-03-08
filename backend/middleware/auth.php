<?php 
include ('../config/jwt.php');

header('Content-Type: application/json');

//get auth header
$headers = apache_request_headers();
$authHeader = isset($headers["Authorization"]) ? $headers["Authorization"]: "";

if (!$authHeader ||!preg_match('/Bearer\s(\S+)/', $authHeader, $matches) ) {
    echo json_encode(["error"=> "Unauthorized - missing token" ]);
    http_response_code(401);
    exit();
}

$jwt = $matches[1];
$decoded = verifyJWT($jwt);

if(!$decoded) {
    echo json_encode(["error" => "unauthorized - invalid token"]);
    http_response_code(401);
    exit();
}


?>
