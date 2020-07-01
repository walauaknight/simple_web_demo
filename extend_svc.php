<?php
require 'db.php';
$name = $_POST['postName'];
$carplate = $_POST['postcarPlate'];
$duration = $_POST['postDuration'];
$credit = $_POST['postCredit'];
//$name = 'qweqwe';
//$carplate = 'WWW1';
//$duration = 99;
$duration1 = get_duration_str($duration);
$duration2 = (float)get_duration_num($duration);
$price = get_price($duration);

if($price != false && $duration != false){

    if(extend($duration1,$name,$carplate,$price,$duration2) == "a"){
        update_credit($name,$credit,$price);
        updateTotalSpent($name, $price);
        echo "a";
    }else{
        echo "b";
    }
}else{
    echo "b";
}

function extend($duration1,$name,$carplate,$price,$duration2){
    $conn = conn();
    //UPDATE `transaction1`
    //            SET `period`= `period` + 0.5, `end`=DATE_ADD(`end`, INTERVAL 1 HOUR),`paid_amount(RM)`=`paid_amount(RM)` + 2, `afterPayCredit(RM)` = `afterPayCredit(RM)` - 2
    //            WHERE `name` = 'qweqwe'
    //            AND `carplate` = 'WWW1'
    $sql =" UPDATE `transaction1` 
            SET `period`= `period` + $duration2, `end`=DATE_ADD(`end`, INTERVAL $duration1),`extendOn` = NOW(),`paid_amount(RM)`=`paid_amount(RM)` + $price, `afterPayCredit(RM)` = `afterPayCredit(RM)` - $price 
            WHERE `name` = '$name' 
            AND `carplate` = '$carplate'
            AND `expired` = 0
            AND `user_stop` = 0";
    $conn->query($sql) or die($conn->error);
    return ($conn->affected_rows == 1)?"a":"b";
}

function get_duration_str($period){
    if($period == 33){
        return "30 MINUTE";
    }elseif ($period == 1){
        return "1 HOUR";
    }elseif ($period == 2){
        return "2 HOUR";
    }elseif ($period == 3){
        return "3 HOUR";
    }elseif ($period == 99){
        return "24 HOUR";
    }else{
        return false;
    }
}

function get_price($period){
    if($period == 33){
        return 1;
    }elseif ($period == 1){
        return 2;
    }elseif ($period == 2){
        return 3;
    }elseif ($period == 3){
        return 4;
    }elseif ($period == 99){
        return 10;
    }else{
        return false;
    }
}

function get_duration_num($period){
    if($period == 33){
        return 0.5;
    }elseif ($period == 1){
        return 1.0;
    }elseif ($period == 2){
        return 2.0;
    }elseif ($period == 3){
        return 3.0;
    }elseif ($period == 99){
        return 24.0;
    }else{
        return false;
    }
}

function update_credit($name,$credit,$price){
    $conn = conn();
    $new_credit = $credit - $price;
    $sql = "UPDATE `users` SET `credit`='$new_credit' WHERE `name` ='$name'";
    $conn->query($sql)or die($conn->error);
    //return (($conn->affected_rows)==1)?"a":"b";
}

function updateTotalSpent($name, $price){
    $conn = conn();
    $sql = "UPDATE `users` SET `totalSpent`= `totalSpent` + $price WHERE `name` ='$name'";
    $conn->query($sql)or die($conn->error);
}