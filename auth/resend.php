<?php 

include "../connect.php"  ;

$email = filterRequest("email");

$verifycode = rand(10000 , 99999);

$data = array(
"verifycode" => $verifycode
) ; 

updateData("users" ,  $data  , "email = '$email'" ) ; 

//sendEmail($email , "TalkIt Verification Code" , "Verfiy Code $verifycode") ; 