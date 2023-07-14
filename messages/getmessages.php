<?php
include "../connect.php";

$friendsid  = filterRequest('friendsid');


getAllData('messages'," message_friendsid = '$friendsid'");


/* 
 homepage:
 fetch these : 
 friendsid & friendsusername & friendsimage & last message and its time

 chatroom:
  fetch messages :
  orderby : descending
  on the right : user's messages,
  on the left  : friend's messages

*/