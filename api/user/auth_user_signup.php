<?php

header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json");

include "../../config/config.php";

$config = new Config();

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    

    $res = $config->signUpUser($name, $email, $password);

    if ($res) {
        $arr['data'] = "User Registed Successfully...";
    } else {
        $arr['data'] = "User Registion Faild...";
    }

} else {
    $arr['err'] = "Only POST HTTP request method is allowed...";
}

echo json_encode($arr);



?>