<?php
require 'db.php';
$name = $_POST['postName'];
//$name = 'qweqwe';
$result = get_paid_svc($name);
echo $result;

function get_paid_svc($name){
    $conn=conn();
    //SELECT `carplate`, `street`, `start`, `period`, `end` FROM `transaction1` WHERE `name` = 'qweqwe' AND `expired` = '0'
    $sql = "SELECT `carplate`, `street`, `start`, `period`, `end` FROM `transaction1` WHERE `name` = '$name' AND `expired` = '0' AND `user_stop` = '0'";
    $query_result=$conn->query($sql)or die($conn->error);
    $assoc = array();
    while($result = $query_result->fetch_assoc()){
        $assoc[] = $result;
    }
    $assoc = json_encode($assoc);
    return $assoc;
}