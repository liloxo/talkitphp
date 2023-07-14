<?php 
include "../connect.php";

$id        = filterRequest('id');
$imagename = filterRequest('file');


$stmt = $con->prepare("SELECT * FROM users WHERE id = ? AND image = ? ");
$stmt->execute(array($id,$imagename));
$count = $stmt->rowCount();
result($count);
if($count >0){
    $data = array('image' => null );
    updateData('users',$data,"id = '$id' AND image = '$imagename'",false);
    deleteFile('../upload',$imagename);
}
    

