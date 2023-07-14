<?php
include "../connect.php";

$friendsid = filterRequest('friendsid');

$data = array("approve" => 1);
updateData('friends',$data, " friends_id = '$friendsid' " );
