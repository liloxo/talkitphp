<?php
include "../connect.php";

$friendsid = filterRequest('friendsid');

deleteData('friends'," friends_id = '$friendsid' ");