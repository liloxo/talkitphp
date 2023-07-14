<?php
include "../connect.php";

$email = filterRequest("email");

$verifycode   = rand(10000, 99999);

$stmt = $con->prepare("SELECT * FROM users WHERE email = ? ");
$stmt->execute(array($email));
$count = $stmt->rowCount();
result($count);

if ($count > 0) {
    $data = array("verifycode" => $verifycode);
    updateData("users", $data, "email = '$email'", false);
   // sendEmail($email, "TalkIt Verifycode", "Verify Code $verifycode");
}