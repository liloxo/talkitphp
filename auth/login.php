<?php

include "../connect.php";

$email    = filterRequest('email');
$password = sha1($_POST['password']);

getData('users'," email = ? AND password = ? ", array($email,$password));

