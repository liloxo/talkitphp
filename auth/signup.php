<?php

include "../connect.php";

$username   = filterRequest('username');
$email      = filterRequest('email');
$password   = sha1($_POST['password']);
$verfiycode = rand(10000 , 99999);

$stmt = $con->prepare(" SELECT * FROM `users` WHERE `email`= ? ");
$stmt->execute(array($email));

$count = $stmt->rowCount();


if($count > 0){
   printFailure('email already in use');
}else{
   $data = array(
      "username" => $username,
      "password" =>  $password,
      "email"    => $email,
      "verifycode" => $verfiycode ,
   );
   //sendEmail($email , "TalkIt Verifycode" , "Verfiy Code $verfiycode") ;
   insertData('users',$data);
}