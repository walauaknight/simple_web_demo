<?php
require 'db.php';
$tp_val = (int)$_POST['postTp'];
$name = $_POST['postName'];
$current_val = (int)$_POST['postCredit'];
echo record_topup($tp_val,$name,$current_val);

function record_topup($tp_val,$name,$current_val){
    $conn=conn();
    $tp_val2 = $tp_val+$current_val;
    //INSERT INTO `topuprecord`(`name`, `topup_amount`, `datetime`, `credit_after_topup`) VALUES ()
    $sql = "INSERT INTO `topuprecord`(`name`, `topup_amount`, `datetime`, `credit_after_topup`)
            VALUES ('$name', '$tp_val', NOW(), '$tp_val2')";
    return ($conn->query($sql))?"a":"b";
}