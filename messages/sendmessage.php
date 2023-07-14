<?php
include "../connect.php";

$sender     = filterRequest('sender');
$receiver   = filterRequest('receiver');
$text       = filterRequest('text');
$friendsid  = filterRequest('friendsid');

$data = array(
    "message_sender" => $sender,
    "message_receiver" =>  $receiver,
    "message_text"    => $text,
    "message_friendsid" => $friendsid ,
);


insertData('messages',$data);



