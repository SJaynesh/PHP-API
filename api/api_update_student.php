<?php
header("Access-Control-Allow-Methods: PUT,PATCH");
header("Content-Type: application/json");

include "../config/config.php";

$config = new Config();

if ($_SERVER['REQUEST_METHOD'] == 'PUT' || $_SERVER['REQUEST_METHOD'] == 'PATCH') {

    $input = file_get_contents('php://input'); // return string
    parse_str($input, $_UPDATE);

    $name = $_UPDATE['name'];
    $age = $_UPDATE['age'];
    $course = $_UPDATE['course'];
    $id = $_UPDATE['id'];

    $res = $config->updateStudent($name, $age, $course, $id);

    if ($res) {
        $arr['data'] = "Record Updated Successfully...";
    } else {
        $arr['data'] = "Record Updation Failed...";
    }

} else {
    $arr['err'] = "Only PUT and PATCH HTTP request methods are allowed...";
}
echo json_encode($arr);
?>