<?php

header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json");

include "../../config/config.php";

$config = new Config();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $res = $config->signInUser($email, $password);

    if ($res) {
        $arr['data'] = "User Signed Successfully...";
    } else {
        $arr['data'] = "User Signtion Faield...";
    }

} else {
    $arr['err'] = "Only POST HTTP request method is allowed...";
}

echo json_encode($arr);
?>