<?php
require 'db.php';
$name = $_POST['postName'];
$carPlate = strtoupper($_POST['postcarPlate']);
//$name = 'qweqwe';
//$carPlate = 'WWW4';
echo get_time($name,$carPlate);

function get_time($name,$carPlate){
    //SELECT `start`, `end` FROM `transaction1` WHERE `name` = 'qweqwe' AND `carplate` = 'WWW4' AND `expired` = '0'
    $conn=conn();
    $sql = "SELECT `start`, `end` FROM `transaction1` WHERE `name` = '$name' AND `carplate` = '$carPlate' AND `expired` = '0' ";
    $query_result = $conn->query($sql);
    $assoc = $query_result->fetch_assoc();
    $assoc = json_encode($assoc);
    //var_dump($assoc);
    return $assoc;
}