<?php 
include "../connect.php";

$id        = filterRequest('id');

$stmt = $con->prepare("SELECT * FROM users WHERE id = ? ");
$stmt->execute(array($id));
$count = $stmt->rowCount();
result($count);

if ($count > 0) {
    $imagename = imageUpload('file');
    $data = array('image' => $imagename );
    updateData("users", $data, "id = '$id'", false);
}


