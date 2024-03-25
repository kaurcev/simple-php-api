<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
include_once '../config/database.php';
include_once '../objects/user.php';
 
$database = new Database();
$db = $database->getConnection();
$user = new User($db);
$user->username = isset($_GET['username']) ? $_GET['username'] : die();
$user->password = base64_encode(isset($_GET['password']) ? $_GET['password'] : die());
$stmt = $user->login();
if($stmt->rowCount() > 0){
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $user_arr=array(
        "status" => true,
        "message" => "Okay",
        "data" => $row
    );
}
else{
    $user_arr=array(
        "status" => false,
        "message" => "Not okay",
        "data" => []
    );
}
print_r(json_encode($user_arr));
?>