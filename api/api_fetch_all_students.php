<?php

header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json");


include "../config/config.php";

$config = new Config();

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $res = $config->fetchStudentsData();

    $all_record = []; // array
    while ($result = mysqli_fetch_assoc($res)) {
        array_push($all_record, $result);
    }

    $arr['data'] = $all_record;

} else {
    $arr['err'] = "Only GET HTTP request method is allowed...";
}

echo json_encode($arr);

?>