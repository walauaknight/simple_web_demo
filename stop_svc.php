<?php
require 'db.php';
$name = $_POST['postName'];
$carplate = $_POST['postcarPlate'];
//$name = 'qweqwe';
//$carplate = 'WWW1';
if(stop_svc($name,$carplate) == "a"){
    echo "a";
}else{
    echo "b";
}

function stop_svc($name,$carplate){
    //UPDATE `transaction1` SET `user_stop`=[value-10] WHERE 1
    $conn = conn();
    $sql = "UPDATE `transaction1` SET `user_stop`= '1' WHERE `name` = '$name' AND `carplate` = '$carplate'";
    $conn->query($sql) or die($conn->error);
    return ($conn->affected_rows == 1)?"a":"b";
}