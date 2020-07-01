<?php
require 'db.php';
$name = $_POST['postName'];
//$name = 'qweqwe';
$result = get_topUphistory($name);
echo $result;


function get_topUphistory($name){
    $conn=conn();
    //SELECT `carplate`, `street`, `start`, `period`, `end` FROM `transaction1` WHERE `name` = 'qweqwe' AND `expired` = '0'
    $sql = "SELECT `topup_amount`, `datetime`, `credit_after_topup` FROM `topuprecord` WHERE `name` = '$name'";
    $query_result=$conn->query($sql)or die($conn->error);
    $assoc = array();
    while($result = $query_result->fetch_assoc()){
        $assoc[] = $result;
    }
    $assoc = json_encode($assoc);
    return $assoc;
}