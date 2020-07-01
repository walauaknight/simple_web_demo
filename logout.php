<?php
require 'db.php';
$name = $_POST['postName'];
//$name = 'demotest';
update_logOut($name);

function update_logOut($name){
    $conn=conn();
    //UPDATE `users` SET `loggedInNow`=  WHERE 1
    $sql = "UPDATE `users` SET `loggedInNow`= 0 WHERE `name`='$name'";
    //return $conn->query($sql)?"a":"b";
    $conn->query($sql);
}