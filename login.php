<?php
require 'db.php';
$conn=conn();
$pass = $conn->real_escape_string(htmlentities($_POST['postPass']));
$email = $conn->real_escape_string(htmlentities($_POST['postEmail']));
//$email = 'ghjghj@gmail.com';
//$pass = 'ghjghj';
if(check_login($email,$pass) == false){
    //send back the email
    echo "0";
}else{
    echo check_login($email,$pass);
    update_logIn($email, $pass);
}

function check_login($email,$pass){
    $conn=conn();
    $results=array();
    $email=$conn->real_escape_string($email);
    $login_query=$conn->query("SELECT COUNT(`no.`),`name`,`credit` AS `count`,`no.`,`credit` FROM `users` WHERE `email`='$email' AND `pass`='$pass' AND `loggedInNow` = '0'")or die($conn->error);
    $query_result=$login_query->fetch_assoc();
    //print_r($login_query);
    //var_dump($login_query);
    //var_dump($query_result);
    $results[]=$query_result['name'];
    $results[]=$query_result['credit'];
    //var_dump($results);
    $results_json = json_encode($results);
    return (((int)$query_result['COUNT(`no.`)'] == 1))?$results_json:false;
}

function update_logIn($email, $pass){
    $conn=conn();
    //UPDATE `users` SET `loggedInNow`=  WHERE 1
    $sql = "UPDATE `users` SET `loggedInNow`= 1 WHERE `email`='$email' AND `pass`='$pass'";
    $conn->query($sql);
}
?>