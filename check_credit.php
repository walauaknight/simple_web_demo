<?php
require 'db.php';
$name = $_POST['postName'];
//$name = 'testtest';
//var_dump(check_credit($name));
if(check_credit($name) == false){
    echo "a";
}else{
    echo check_credit($name);
}
function check_credit($name){
    $conn=conn();
    $sql = "SELECT `credit` FROM `users` WHERE `name` = '$name'";
    $check_query = $conn->query($sql);
    $query_result = $check_query->fetch_assoc();
    return ($conn->affected_rows ==1)?$query_result['credit']:false;
}