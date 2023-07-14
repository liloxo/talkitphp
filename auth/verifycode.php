<?php

include "../connect.php";

$email      = filterRequest('email');
$verifycode = filterRequest('verifycode');

$stmt = $con->prepare("SELECT * FROM users WHERE email = '$email' AND verifycode = '$verifycode' ") ; 
 
$stmt->execute() ; 

$count = $stmt->rowCount() ; 

if ($count > 0) {
 
    $data = array("approve" => "1") ; 

    updateData("users" , $data , "email = '$email'");

}else {
 printFailure("verifycode not Correct") ; 

}


