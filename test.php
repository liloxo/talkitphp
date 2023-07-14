<?php

include "connect.php";

$id    = filterRequest('id');

getAllData('users'," id = ?  ", array($id));

