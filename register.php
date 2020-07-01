<?php
require 'db.php';
$conn=conn();
$name = $conn->real_escape_string(htmlentities($_POST['postName']));
$email = $conn->real_escape_string(htmlentities($_POST['postEmail']));
$pass = $conn->real_escape_string(htmlentities($_POST['postPass']));
$tel = $conn->real_escape_string(htmlentities($_POST['postTel']));
if(validate($email)==true){
    echo "0";
}else{
    echo insert_sql($name,$email,$pass,$tel);
}

function insert_sql($name,$email,$pass,$tel){
    $conn=conn();
    $sql = "INSERT INTO `users`(`name`, `email`, `pass`, `tel`, `credit`, `loggedInNow`, `totalSpent`) VALUES ('$name','$email','$pass','$tel','0', 0, 0)";
    if($conn->query($sql)or die($conn->error)){
        return "abc";
    }else{
        return false;
    }

}

function validate($email){
    $conn=conn();
    $query=$conn->query("SELECT `no.` FROM `users` WHERE `email` = '$email'");
    //var_dump($query);
    return ($query->num_rows===1)?true:false;
}
