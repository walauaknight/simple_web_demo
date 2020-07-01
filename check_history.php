<?php
require 'db.php';
$name = $_POST['postName'];
//$name = 'qweqwe';
$result = get_history($name);
echo $result;

function get_history($name){
    $conn=conn();
    //SELECT `carplate`, `street`, `start`, `period`, `end` FROM `transaction1` WHERE `name` = 'qweqwe' AND `expired` = '0'
    $sql = "SELECT `carplate`, `street`, `start`, `period`, `end`, `expired`,`user_stop` FROM `transaction1` WHERE `name` = '$name'";
    $query_result=$conn->query($sql)or die($conn->error);
    $assoc = array();
    while($result = $query_result->fetch_assoc()){
        $result['expired'] = yes_no($result['expired']);
        $result['user_stop'] = yes_no($result['user_stop']);
        $assoc[] = $result;
    }
    $assoc = json_encode($assoc);
    return $assoc;
}

function yes_no($expire){
    if($expire == 1){
        return "Yes";
    }else{
        return "No";
    }
}