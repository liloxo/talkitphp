<?php 

include "../connect.php" ;

$email  = filterRequest("email") ; 
$verifycode = filterRequest("verifycode") ; 


$stmt = $con->prepare("SELECT * FROM users WHERE email = '$email' AND verifycode = '$verifycode' ") ; 
 
$stmt->execute() ; 

$count = $stmt->rowCount() ; 

result($count) ;