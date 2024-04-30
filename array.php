<?php

$arr = array("id" => 101, "name" => "Harsh", "age" => 20, "college" => "ABC");

$a = [10, 20, 30, 40, 50];

foreach ($a as $val) {
    echo "$val <br>";
}

echo "<hr><br>";

$arr['city'] = "Surat";

foreach ($arr as $key => $val) {
    echo "$key : $val <br>";
}

?>