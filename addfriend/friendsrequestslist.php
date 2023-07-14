<?php
include "../connect.php";

$iduser = filterRequest('usertwo');

getAllData('friendsview'," usertwo_id = '$iduser' AND approve = 0 ");
