<?php
require 'db.php';
$conn=conn();

$period = $conn->real_escape_string(htmlentities($_POST['postPeriod']));
$carPlate = strtoupper($conn->real_escape_string(htmlentities($_POST['postcarPlate'])));
$addr = $conn->real_escape_string(htmlentities($_POST['postAddr']));
$name = $conn->real_escape_string(htmlentities($_POST['postName']));
$credit = (int)$conn->real_escape_string(htmlentities($_POST['postCredit']));

$price = get_price($period);
$duration = get_duration_str($period);
$durationInt = (float)get_duration_num($period);
if($price != false && $duration != false){
    if(check_onGoingSvc($name) == "can" && check_onGoingCar($carPlate) == "can") {
        if (record($name, $carPlate, $addr, $duration, $price, $credit, $durationInt) == "a") {
            update_credit($name, $credit, $price);
            updateTotalSpent($name, $price);
            echo "a";
        } else {
            echo "b";
        }
    }else{
        echo "c";
    }
}else{
    echo "b";
}

function record($name,$carPlate,$addr,$duration,$price, $credit, $durationInt){
    /*
    INSERT INTO `transaction1`(`name`, `carplate`, `street`, `start`, `period`, `end`, `extendOn`, `paid_amount(RM)`, `expired`, `user_stop`, `beforePayCredit(RM)`, `afterPayCredit(RM)`)
            VALUES ('qweqwe','WWW1','taman.jb.skudai', NOW(), 0.5, DATE_ADD(NOW(), INTERVAL 30 MINUTE), NOW(), 999,0, 0, 999, 999)
        */
    $credit2 = $credit - $price;
    $conn=conn();
    $sql = "INSERT INTO `transaction1`(`name`, `carplate`, `street`, `start`, `period`, `end`, `extendOn`, `paid_amount(RM)`, `expired`, `user_stop`, `beforePayCredit(RM)`, `afterPayCredit(RM)`,  `startDate`, `startTime`)
            VALUES ('$name','$carPlate','$addr', NOW(), '$durationInt', DATE_ADD(NOW(), INTERVAL $duration), NOW(), $price, 0, 0, $credit, $credit2, NOW(), NOW());
    ";
    $conn->query($sql)or die($conn->error);
    return ($conn->affected_rows == 1)?"a":"b";
}

    //function generate_receipt(){

//}

function check_onGoingSvc($name){
    ///*AND `carplate` = '$carPlate'*/
    $conn=conn();
    $sql = "SELECT * FROM `transaction1` WHERE `name` = '$name' AND `user_stop` = '0' AND `expired` = '0'";
    $conn->query($sql)or die($conn->error);
    return ($conn->affected_rows == 1)?"cannot":"can";
}

function check_onGoingCar($carPlate){
    $conn=conn();
    $sql = "SELECT * FROM `transaction1` WHERE `carplate` = '$carPlate' AND `user_stop` = '0' AND `expired` = '0'";
    $conn->query($sql)or die($conn->error);
    return ($conn->affected_rows == 1)?"cannot":"can";
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
