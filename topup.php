<?php
require 'db.php';
$conn=conn();
$tp_val = (int)$conn->real_escape_string(htmlentities($_POST['postTp']));
$name = $conn->real_escape_string(htmlentities($_POST['postName']));
$current_val = (int)$conn->real_escape_string(htmlentities($_POST['postCurrentVal']));
//$tp_val = 30;
//$name = 'qweqwe';
if(topup($tp_val,$name,$current_val) == "a" && syncDb($tp_val,$name) == "a"){
    headCount($tp_val);
    echo "1";
}else{
    echo "0";
}

function topup($tp_val,$name,$current_val){
    $conn=conn();
    $tp_val2 = $tp_val+$current_val;
    $sql = "UPDATE `users` SET `credit`= '$tp_val2' WHERE `name` = '$name'";
    $topup_query = $conn->query($sql);
    return (($conn->affected_rows)==1)?"a":"b";
}

function syncDb($tp_val,$name){
    $conn=conn();
    //UPDATE `transaction1` SET `beforePayCredit(RM)`= `beforePayCredit(RM)` + 999 ,`afterPayCredit(RM)`=`afterPayCredit(RM)` + 999
    // WHERE `expired` = 0 AND `user_stop` = 0
    $sql = "UPDATE `transaction1` SET `beforePayCredit(RM)`= `beforePayCredit(RM)` + $tp_val ,`afterPayCredit(RM)`=`afterPayCredit(RM)` + $tp_val 
            WHERE `name` = '$name' AND `expired` = 0 AND `user_stop` = 0 ";
    return ($conn->query($sql))?"a":"b";
}

function headCount($tp_val){
    $conn = conn();
    //UPDATE `topupcount` SET `headcount`= `headcount` + 1 WHERE `category` = 'RM30'
    if($tp_val == 30){
        $sql = "UPDATE `topupcount` SET `headcount`= `headcount` + 1 WHERE `category` = 'RM30'";
    }elseif ($tp_val == 20){
        $sql = "UPDATE `topupcount` SET `headcount`= `headcount` + 1 WHERE `category` = 'RM20'";
    }else{
        $sql = "UPDATE `topupcount` SET `headcount`= `headcount` + 1 WHERE `category` = 'RM10'";
    }
    $conn->query($sql)or die($conn->error);
}