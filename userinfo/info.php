<?php

include "../connect.php";

$id    = filterRequest('id');

getData('users',"id = '$id' ");




