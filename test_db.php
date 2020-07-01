<?php
if(conn()){
    echo "yes";
}else{
    echo "no";
}


function conn(){
    $conn = new mysqli('db4free.net:3306/assignment0','walauaknight','shit5095','assignment0')or die($conn->error);
    return $conn;
}