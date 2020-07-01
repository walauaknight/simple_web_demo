<?php
require 'db.php';
$name = $_POST['postName'];
//$name = 'qweqwe';
echo update_detail($name);

function update_detail($name){
    //SELECT * FROM `transaction1` WHERE `name` = 'qweqwe' AND `expired` = '0'
    $conn = conn();
    $sql = "SELECT * FROM `transaction1` WHERE `name` = '$name' AND `expired` = '0'";
    $query_result = $conn->query($sql);
    $assoc = $query_result->fetch_assoc();
    $assoc = json_encode($assoc);
    return $assoc;
}