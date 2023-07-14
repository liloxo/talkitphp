<?php
include "../connect.php";

$iduser = filterRequest('usertwo');

getData('friends'," usertwo = '$iduser' AND approve = 0 ");
