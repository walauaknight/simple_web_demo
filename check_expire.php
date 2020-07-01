<?php
//UPDATE `transaction1` SET`expired`='0' WHERE NOW()<`end`
require 'db.php';
echo check_expire();
function check_expire(){
   $conn = conn();
   $sql = "UPDATE `transaction1` SET`expired`='1' WHERE NOW()>`end` AND `user_stop` = '0'";
   if($conn->query($sql)){
       return "a";
   }else{
       return "b";
   }
}
/*
<?php
include 'db.php';
include 'check_expire.php';
check_expire();
?>
*/