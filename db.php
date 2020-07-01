<?php
/*
function conn(){
    $conn = new mysqli('db4free.net:3306/assignment0','walauaknight','shit5095','assignment0')or die($conn->error);
    return $conn;
}
*/
function conn(){
    $conn = new mysqli('localhost','root','','assignment0')or die($conn->error);
    return $conn;
}

?>