<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');;
include_once '../config/database.php';
include_once '../objects/user.php';
 
$database = new Database();
$db = $database->getConnection();
$user = new User($db);
$user->username = $_GET['username'];
$user->password = base64_encode($_GET['password']);
$user->created = date('Y-m-d H:i:s');
if($user->signup()){
    $user_arr=array(
        "status" => true,
        "message" => "Успешно",
        "data" => [
            "id" => $user->id,
            "username" => $user->username,
            "password" => $user->password,
        ]
    );
}
else{
    $user_arr=array(
        "status" => false,
        "message" => "Что-то пошло не так", 
        "data" => []
    );
}
print_r(json_encode($user_arr));
?>